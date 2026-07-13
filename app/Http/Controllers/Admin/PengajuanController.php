<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratDomisili;
use App\Models\SuratUsaha;
use App\Models\SuratTidakMampu;
use App\Models\SuratKelahiran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class PengajuanController extends Controller
{
    // ================= HELPER =================
    private function getSurat($jenis, $id)
    {
        return match ($jenis) {
            'domisili' => SuratDomisili::findOrFail($id),
            'usaha' => SuratUsaha::findOrFail($id),
            'tidak_mampu' => SuratTidakMampu::findOrFail($id),
            'kelahiran' => SuratKelahiran::findOrFail($id),
            default => abort(404),
        };
    }

    // ================= INDEX =================
    public function index(Request $request)
    {
        
        
        $status = $request->status;
        $search = $request->search ?? $request->nama;

        $domisili = SuratDomisili::all()->map(fn($i) => tap($i, function ($x) {
            $x->jenis = 'domisili';
            $x->jenis_surat = 'Surat Keterangan Domisili';
        }));

        $usaha = SuratUsaha::all()->map(fn($i) => tap($i, function ($x) {
            $x->jenis = 'usaha';
            $x->jenis_surat = 'Surat Keterangan Usaha';
        }));

        $tidakMampu = SuratTidakMampu::all()->map(fn($i) => tap($i, function ($x) {
            $x->jenis = 'tidak_mampu';
            $x->jenis_surat = 'Surat Keterangan Tidak Mampu';
        }));

        $kelahiran = SuratKelahiran::all()->map(fn($i) => tap($i, function ($x) {
            $x->jenis = 'kelahiran';
            $x->jenis_surat = 'Surat Keterangan Kelahiran';
            $x->nik = $x->nik_ayah;
        }));

$data = $domisili
    ->concat($usaha)
    ->concat($tidakMampu)
    ->concat($kelahiran)
    ->filter(function ($item) {

        if (
            in_array($item->status_surat, ['selesai', 'ditolak']) &&
            \Carbon\Carbon::parse($item->updated_at)->lt(now()->subDays(7))
        ) {
            return false;
        }

        return true;
    })
    ->sortByDesc('created_at');

// ✅ PRIORITAS: dari NOTIF (LOCK 1 DATA)
if ($request->id && $request->jenis) {

    $data = $data->filter(fn($item) =>
        $item->id == $request->id && $item->jenis == $request->jenis
    );

} 
else {

    // 🔍 FILTER NORMAL (kalau bukan dari notif)
    if ($search) {
        $data = $data->filter(fn($item) =>
            strtolower($item->nama) === strtolower($search)
        );
    }

    if ($status && $status != 'all') {
        $data = $data->where('status_surat', $status);
    }

}
// ✅ WAJIB ADA INI
return view('admin.pengajuan', compact('data'));
}

    // ================= PROSES =================
    public function proses(Request $request, $jenis, $id)
    {
        $surat = $this->getSurat($jenis, $id);

        if (in_array($surat->status_surat, ['selesai', 'ditolak'])) {
            return back()->with('error', 'Status tidak bisa diubah');
        }

        $surat->status_surat = 'proses';

        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('ktp'), $filename);
            $surat->upload_ktp = 'ktp/'.$filename;
        }

        $surat->save();
        // 🔔 NOTIF


        return back()->with('success', 'Diproses');
    }

    // ================= TOLAK =================
    public function formTolak($jenis, $id)
    {
        $surat = $this->getSurat($jenis, $id);
        return view('admin.tolak', compact('surat', 'jenis'));
    }

    public function tolak(Request $request, $jenis, $id)
    {
        $request->validate([
            'catatan' => 'required'
        ]);

        $surat = $this->getSurat($jenis, $id);

        if ($surat->status_surat == 'selesai') {
            return back()->with('error', 'Sudah selesai');
        }

        $surat->status_surat = 'ditolak';
        $surat->catatan = $request->catatan;
        $surat->save();
        if ($surat->nomor_surat) {

    $tahun = date('Y', strtotime($surat->tanggal_surat));

    DB::table('riwayat_nomor_surats')->updateOrInsert(
        [
            'nomor_urut' => $surat->nomor_urut,
            'tahun' => $tahun,
        ],
        [
            'nomor_surat' => $surat->nomor_surat,
            'jenis' => $jenis,
            'nama' => $surat->nama,
            'status' => 'ditolak',
            'keterangan' => $request->catatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}

        return redirect()->route('admin.pengajuan')
            ->with('success', 'Ditolak');
    }

    // ================= EDIT =================
    public function edit($jenis, $id)
    {
        $surat = $this->getSurat($jenis, $id);
        return view('admin.edit_'.$jenis, compact('surat'));
    }

    // ================= UPDATE (FIX) =================
  public function update(Request $request, $jenis, $id)
{
    $surat = $this->getSurat($jenis, $id);

    if ($surat->status_surat == 'selesai') {
    return back()->with('error', 'Surat sudah selesai, tidak bisa diedit');
}

    // ✅ VALIDASI
  // ✅ VALIDASI (FIX)
$request->validate([
    'tanggal_surat' => 'required',
    'nomor_urut' => 'required|numeric'
]);

    // =============================
    // 🔥 FIELD UMUM (SEMUA JENIS)
    // =============================
    $commonFields = [
        'nik',
        'nama',
        'bin_binti',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status',
        'kewarganegaraan',
        'pekerjaan',
        'alamat',
        'no_wa'
    ];

    foreach ($commonFields as $field) {
        if ($request->has($field)) {
            $surat->$field = $request->$field;
        }
    }
if ($surat->status_surat != 'selesai') {

    if ($request->filled('nomor_urut')) {
        $surat->nomor_urut = $request->nomor_urut;
    }

    if ($request->filled('nomor_surat')) {
        $surat->nomor_surat = $request->nomor_surat;
    }

}
    // =============================
    // 🔥 KHUSUS USAHA
    // =============================
    if ($jenis == 'usaha') {
        $surat->jenis_usaha = $request->jenis_usaha ?? $surat->jenis_usaha;
        $surat->tempat_usaha = $request->tempat_usaha ?? $surat->tempat_usaha;
    }

    // =============================
    // 🔥 KHUSUS KELAHIRAN
    // =============================
    if ($jenis == 'kelahiran') {

        // DATA ANAK (sudah masuk common sebagian)
        $surat->bangsa = $request->bangsa ?? $surat->bangsa;

        // AYAH
        $surat->nama_ayah = $request->nama_ayah ?? $surat->nama_ayah;
        $surat->nik_ayah = $request->nik_ayah ?? $surat->nik_ayah;
        $surat->tempat_lahir_ayah = $request->tempat_lahir_ayah ?? $surat->tempat_lahir_ayah;
        $surat->tanggal_lahir_ayah = $request->tanggal_lahir_ayah ?? $surat->tanggal_lahir_ayah;
        $surat->pekerjaan_ayah = $request->pekerjaan_ayah ?? $surat->pekerjaan_ayah;
        $surat->alamat_ayah = $request->alamat_ayah ?? $surat->alamat_ayah;

        // IBU
        $surat->nama_ibu = $request->nama_ibu ?? $surat->nama_ibu;
        $surat->tempat_lahir_ibu = $request->tempat_lahir_ibu ?? $surat->tempat_lahir_ibu;
        $surat->tanggal_lahir_ibu = $request->tanggal_lahir_ibu ?? $surat->tanggal_lahir_ibu;
        $surat->pekerjaan_ibu = $request->pekerjaan_ibu ?? $surat->pekerjaan_ibu;
        $surat->alamat_ibu = $request->alamat_ibu ?? $surat->alamat_ibu;
    }

    // =============================
    // 🔥 FIELD TAMBAHAN
    // =============================
    $surat->tanggal_surat = $request->tanggal_surat;

    // upload KTP
    if ($request->hasFile('upload_ktp')) {
        $file = $request->file('upload_ktp');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('ktp'), $filename);
        $surat->upload_ktp = 'ktp/'.$filename;
    }

    // cek dulu sebelum simpan
$tahun = Carbon::parse($request->tanggal_surat)->year;

$cekDuplikat = DB::table('riwayat_nomor_surats')
    ->where('nomor_urut', $request->nomor_urut)
    ->where('tahun', $tahun)
    ->exists();

if ($cekDuplikat) {
    return back()
        ->with('error', 'Nomor urut sudah dipakai di tahun ini!')
        ->withInput();
}


    $surat->save();


    // =============================
    // 🔥 REDIRECT
    // =============================
    if ($request->action === 'generate') {
        return redirect()->route('admin.generate', [
            'jenis' => $jenis,
            'id' => $surat->id
        ]);
    }

    return back()->with('success', 'Data berhasil diperbarui');
}


    // ================= GENERATE =================
public function generate($jenis, $id) {
    $surat = $this->getSurat($jenis, $id);

    $surat->jenis = $jenis;

    return view('admin.generate_'.$jenis, compact('surat'));
}

public function generateNomor($jenis, $id)
{
    return DB::transaction(function () use ($jenis, $id) {

        $surat = $this->getSurat($jenis, $id);

        // kalau sudah ada nomor → stop
        if ($surat->nomor_surat) {
            return response()->json([
                'nomor_surat' => $surat->nomor_surat,
                'nomor_urut' => $surat->nomor_urut,
                'locked' => true
            ]);
        }

        $tahun = Carbon::parse($surat->tanggal_surat)->year;

        // 👉 ambil dari input manual (WAJIB ADA)
        $nomorUrut = $surat->nomor_urut;

        if (!$nomorUrut) {
            return response()->json([
                'message' => 'Nomor urut belum diisi'
            ], 422);
        }

        // 🔥 LOCK + CEK AMAN (anti tembus)
        $exists = DB::table('riwayat_nomor_surats')
    ->where('nomor_urut', $nomorUrut)
    ->where('tahun', $tahun)
    ->where(function ($q) use ($surat) {
        $q->whereNull('nomor_surat')
          ->orWhere('nomor_surat', '!=', $surat->nomor_surat);
    })
    ->lockForUpdate()
    ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Nomor urut sudah dipakai di tahun ini!',
                'duplikat' => true
            ], 422);
        }

        $nomorFormat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        $kode = match ($jenis) {
            'domisili' => 100,
            'usaha' => 500,
            'tidak_mampu' => 400,
            'kelahiran' => 100,
        };

        $romawi = 'LXIX';

        $nomorSurat = "$kode/$nomorFormat/$romawi/$tahun";

        // 🔥 PENTING: SIMPAN KE RIWAYAT (INI YANG NGUNCI SISTEM)
       

        // update surat utama
        $surat->nomor_surat = $nomorSurat;
        $surat->tahun = $tahun;
        $surat->save();

        return response()->json([
            'nomor_surat' => $nomorSurat,
            'nomor_urut' => $nomorUrut
        ]);
    });
}





    // ================= FINAL =================
    public function final(Request $request, $jenis, $id)
    {
        
        $request->validate([
            'jadwal_ambil' => 'required',
            'catatan' => 'required'
        ]);

        $surat = $this->getSurat($jenis, $id);

   // HAPUS VALIDASI INI
// biar generate bisa update walaupun sudah selesai

        $surat->jadwal_ambil = $request->jadwal_ambil;
        $surat->paper_size = $request->paper_size ?? 'F4';
        $surat->jam_ambil = $request->jam_ambil;
        $surat->catatan = $request->catatan;
        $surat->status_surat = 'selesai';

        $surat->save();

        // ==============================
// 🔥 KIRIM WA OTOMATIS
// ==============================
 // ==============================
// 🔥 KIRIM WA OTOMATIS
// ==============================
if ($surat->no_wa) {

    $no = preg_replace('/[^0-9]/', '', $surat->no_wa);

    if (str_starts_with($no, '0')) {
        $no = '62' . substr($no, 1);
    }

    try {
        $res = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN')
        ])->post('https://api.fonnte.com/send', [
            'target' => $no,
            'message' => "Yth. {$surat->nama},\n\nKami informasikan bahwa status pengajuan surat Anda telah selesai diproses.\n\nSilakan cek informasi persyaratan dan jadwal pengambilan surat melalui link berikut:\nhttps://website-kelurahan-hositng-production.up.railway.app/cek-status\n\nHarap datang sesuai jadwal yang telah ditentukan.\nTerima kasih."
        ]);

        // DEBUG PENTING
        logger()->info('FONNTE RESPONSE', [
            'response' => $res->json()
        ]);

    } catch (\Exception $e) {
        logger()->error('FONNTE ERROR', [
            'message' => $e->getMessage()
        ]);
    }
}        
        // 🔥 TAMBAHAN (DI SINI)
$pdf = Pdf::loadView('admin.pdf_surat_'.$jenis, compact('surat'));
$namaFile = 'surat_'.$jenis.'_'.$surat->id.'_'.time().'.pdf';
$pdf->save(public_path('file_arsip/' . $namaFile));

        $tahun = date('Y', strtotime($surat->tanggal_surat));

DB::table('riwayat_nomor_surats')->updateOrInsert(
    [
        'nomor_urut' => $surat->nomor_urut,
        'tahun' => $tahun,
    ],
    [
        'nomor_surat' => $surat->nomor_surat,
        'jenis' => $jenis,
        'nama' => $surat->nama,
        'status' => 'selesai',
        'keterangan' => 'Surat selesai diproses',
        'created_at' => now(),
        'updated_at' => now(),
    ]
);

        // 🔔 NOTIF
// 🔔 NOTIF (VERSI FIX)
Notifikasi::create([
    'title' => 'Surat Selesai',
    'message' => $surat->nama . ' - ' . ucfirst($jenis) . ' selesai diproses',
    'type' => 'pengajuan',
    'surat_id' => $surat->id,
    'jenis_surat' => $jenis,
    'is_read' => 0,
    'is_popup' => 0
]);

         DB::table('arsip_surat')->updateOrInsert(
    [
        'jenis' => $jenis,
        'nomor_surat' => $surat->nomor_surat,
    ],
    [
        'jenis_surat' => ucfirst($jenis),
        'nama' => $surat->nama,
        'nik' => $surat->nik ?? null,
        'nomor_urut' => $surat->nomor_urut,
        'tahun' => $surat->tahun,
        'tanggal_surat' => $surat->tanggal_surat ?? now(),
        'alamat' => $surat->alamat ?? null,
        'status_surat' => 'selesai',

         'file_pdf' => 'file_arsip/'.$namaFile,

        'updated_at' => now(),
        'created_at' => now(),
    ]

);


            // ==============================
    // 🔥 AUTO HAPUS FILE KTP
    // ==============================
if ($surat->upload_ktp) {

    $filePath = public_path(ltrim($surat->upload_ktp, '/'));

    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

        return redirect()->route('admin.pengajuan')
            ->with('success', 'Selesai');
    }

    // ================= HAPUS =================
    public function hapus($jenis, $id)
    {
        $this->getSurat($jenis, $id)->delete();

        return back()->with('success', 'Dihapus');
    }

   public function arsip(Request $request)
{
    // 🔥 AMBIL DARI TABEL ARSIP (BENER)
    $data = DB::table('arsip_surat')
        ->orderByDesc('created_at')
        ->get();

    // ================= FILTER DARI NOTIF =================
    if ($request->id && $request->jenis) {
        $data = $data->filter(fn($item) =>
            $item->id == $request->id && $item->jenis == $request->jenis
        );
    }

    // ================= FILTER =================
    if ($request->nomor_surat) {
        $data = $data->filter(fn($item) =>
            str_contains($item->nomor_surat, $request->nomor_surat)
        );
    }

if ($request->tahun) {
    $data = $data->filter(fn($item) =>
        \Carbon\Carbon::parse($item->created_at)->year == $request->tahun
    );
}

    if ($request->jenis) {
        $data = $data->filter(fn($item) =>
            $item->jenis == $request->jenis
        );
    }

    if ($request->search) {
        $data = $data->filter(fn($item) =>
            str_contains(strtolower($item->nama), strtolower($request->search))
        );
    }

    return view('admin.arsip', compact('data'));
}


    // ================= PDF =================
public function pdf($jenis, $id)
{
    $surat = $this->getSurat($jenis, $id);

    $paper = strtolower($surat->paper_size ?? 'a4');

    $size = match ($paper) {
        'f4' => 'legal', // 🔥 INI LEBIH STABIL DI DOMPDF
        default => 'a4',
    };

    return Pdf::loadView('admin.pdf_surat_'.$jenis, compact('surat'))
        ->setPaper($size, 'portrait')
        ->stream('surat.pdf');
}

public function show($id)
{
    $notif = Notifikasi::findOrFail($id);

    $notif->update(['is_read' => 1]);

    // 🔥 KHUSUS PENGADUAN
    if ($notif->jenis_surat == 'pengaduan') {
        return redirect()->route('admin.pengaduan.detail', $notif->surat_id);
    }

    // 🔥 DEFAULT (SURAT)
    if (!$notif->surat_id || !$notif->jenis_surat) {
        return redirect('/admin/pengajuan');
    }

    return redirect()->route('admin.pengajuan', [
        'id' => $notif->surat_id,
        'jenis' => $notif->jenis_surat
    ]);
}

public function history(Request $request)
{
    $query = DB::table('riwayat_nomor_surats');

    // 🔍 SEARCH (nama, nomor surat, nomor urut)
    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('nomor_surat', 'like', "%$search%")
              ->orWhere('nomor_urut', 'like', "%$search%");
        });
    }

    // 🔽 STATUS
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // 🔽 JENIS
    if ($request->jenis) {
        $query->where('jenis', $request->jenis);
    }

    // 🔽 TAHUN
    if ($request->tahun) {
        $query->whereYear('created_at', $request->tahun);
    }

    // 🔽 TANGGAL RANGE
    if ($request->dari && $request->sampai) {
        $query->whereBetween('created_at', [
            $request->dari . ' 00:00:00',
            $request->sampai . ' 23:59:59'
        ]);
    } elseif ($request->dari) {
        $query->where('created_at', '>=', $request->dari . ' 00:00:00');
    } elseif ($request->sampai) {
        $query->where('created_at', '<=', $request->sampai . ' 23:59:59');
    }

    // 🔥 URUTKAN TERBARU
    $data = $query->orderByDesc('created_at')->get();

    return view('admin.history', compact('data'));
}

public function ambilNomorManual()
{
    return DB::transaction(function () {

        $tahun = now()->year;

        // 🔥 LOCK ROW TAHUN INI
        $data = DB::table('riwayat_nomor_surats')
            ->where('jenis', 'global')
            ->where('tahun', $tahun)
            ->lockForUpdate()
            ->first();

        if (!$data) {
            DB::table('riwayat_nomor_surats')->insert([
                'jenis' => 'global',
                'nomor_urut' => 0,
                'tahun' => $tahun,
                'status' => 'system',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $nomorTerakhir = 0;
        } else {
            $nomorTerakhir = $data->nomor_urut;
        }

        // 🔥 increment aman
        $nomorUrut = $nomorTerakhir + 1;

        DB::table('riwayat_nomor_surats')
            ->where('jenis', 'global')
            ->where('tahun', $tahun)
            ->update([
                'nomor_urut' => $nomorUrut,
                'updated_at' => now()
            ]);

        $nomorFormat = str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        return response()->json([
            'nomor_urut' => $nomorUrut,
            'nomor_format' => $nomorFormat
        ]);
    });
}

public function cekNomor(Request $request)
{
    $tahun = Carbon::parse($request->tanggal_surat)->year;

    $exists = DB::table('riwayat_nomor_surats')
        ->where('nomor_urut', $request->nomor_urut)
        ->where('tahun', $tahun)
        ->whereIn('status', ['selesai', 'ditolak']) // ✅ KUNCI FIX
        ->exists();

    return response()->json([
        'duplikat' => $exists
    ]);
}

}