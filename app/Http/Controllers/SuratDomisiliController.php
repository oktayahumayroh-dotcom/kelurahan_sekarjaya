<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratDomisili;
use App\Models\SuratUsaha;
use App\Models\SuratTidakMampu;
use App\Models\SuratKelahiran;
use Carbon\Carbon;

class SuratDomisiliController extends Controller
{
    
    // ================= FORM DOMISILI =================
    public function create()
    {
        return view('domisili.form');
    }

// ================= SIMPAN DOMISILI =================
public function store(Request $request)
{
  
    
       $validated = $request->validate([

    'nik' => 'required|string|max:20',
    'nama' => 'required|string|max:100',
    'bin_binti' => 'nullable|string|max:100',
    'tempat_lahir' => 'required|string|max:50',
    'tanggal_lahir' => 'required|date',
    'jenis_kelamin' => 'required|string',
    'agama' => 'required|string',
    'status' => 'required|string',
    'kewarganegaraan' => 'required|string',
    'pekerjaan' => 'required|string',
    'alamat' => 'required|string',


'pengantar_rt_rw' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',

    'no_wa' => 'required|regex:/^08[0-9]{8,12}$/',

], [

    // KTP
    'upload_ktp.mimes' => 'Upload KTP harus format JPG, JPEG, PNG',
    'upload_ktp.max' => 'Ukuran file KTP maksimal 5MB',

    // Pengantar
    'pengantar_rt_rw.required' => 'Surat pengantar RT/RW wajib diupload',
    'pengantar_rt_rw.mimes' => 'Format surat pengantar harus JPG, JPEG, atau PNG',
    'pengantar_rt_rw.max' => 'Ukuran surat pengantar maksimal 5MB',

    // WA
    'no_wa.regex' => 'Nomor WhatsApp tidak valid',

]);
        // 🔥 BARU CEK LIMIT
    $jumlah = SuratDomisili::where('nik', $validated['nik'])
        ->whereDate('created_at', Carbon::today())
        ->count();

    if ($jumlah >= 2) {
        return redirect()->back()->with('error', 'NIK ini sudah melakukan 2 kali pengajuan hari ini!');
    }


    // ================= HANDLE UPLOAD FILE KTP =================
    if ($request->hasFile('upload_ktp')) {
        $file = $request->file('upload_ktp');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('ktp'), $filename); // simpan langsung ke public/ktp
        $validated['upload_ktp'] = 'ktp/' . $filename; // path relatif untuk blade
    }

    // ================= HANDLE UPLOAD PENGANTAR =================
if ($request->hasFile('pengantar_rt_rw')) {
    $file = $request->file('pengantar_rt_rw');
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('pengantar'), $filename);

    $validated['pengantar_rt_rw'] = 'pengantar/' . $filename;
}

    // STATUS DEFAULT
    $validated['status_surat'] = 'pending';

    $surat = SuratDomisili::create($validated);

// 🔔 NOTIF PENGAJUAN BARU
\App\Models\Notifikasi::create([
    'title' => 'Pengajuan Baru',
    'message' => $surat->nama . ' mengajukan Surat Keterangan Domisili pada ' . $surat->created_at->format('d M Y'),
    'type' => 'pengajuan',
    'surat_id' => $surat->id,
    'jenis_surat' => 'domisili',
    'is_read' => 0,
    'is_popup' => 1
]);

return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');

    
}
    // ================= FORM CEK STATUS =================
    public function formCek()
    {
        return view('cek_status');
    }

    // ================= CEK STATUS =================
  public function cekStatus(Request $request)
{
    $request->validate([
        'nik' => 'required|digits:16'
    ]);

    $domisili = SuratDomisili::where('nik', $request->nik)
        ->get()
        ->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Domisili';
            return $item;
        });

    $usaha = SuratUsaha::where('nik', $request->nik)
        ->get()
        ->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Usaha';
            return $item;
        });

    // 🔥 TAMBAHAN BARU
    $tidakMampu = SuratTidakMampu::where('nik', $request->nik)
        ->get()
        ->map(function ($item) {
            $item->jenis_surat = 'Surat Keterangan Tidak Mampu';
            return $item;
        });

        $kelahiran = SuratKelahiran::where('nik_ayah', $request->nik)
    ->get()
    ->map(function ($item) {
        $item->jenis_surat = 'Surat Keterangan Kelahiran';
        $item->nik = $item->nik_ayah; // pakai NIK ayah biar gabung
        return $item;
    });

    // 🔥 GABUNG SEMUA
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

    return view('hasil_status', compact('data'));
}

public function riwayat($nik)
{
    $domisili = \App\Models\SuratDomisili::where('nik', $nik)
        ->whereIn('status_surat', ['selesai', 'ditolak'])
        ->get();

    $usaha = \App\Models\SuratUsaha::where('nik', $nik)
        ->whereIn('status_surat', ['selesai', 'ditolak'])
        ->get();

    $tidakMampu = \App\Models\SuratTidakMampu::where('nik', $nik)
        ->whereIn('status_surat', ['selesai', 'ditolak'])
        ->get();

    $kelahiran = \App\Models\SuratKelahiran::where('nik_ayah', $nik)
        ->whereIn('status_surat', ['selesai', 'ditolak'])
        ->get();

    // gabung semua data
    $data = collect()
        ->merge($domisili)
        ->merge($usaha)
        ->merge($tidakMampu)
        ->merge($kelahiran)
        ->sortByDesc('created_at');

    return view('riwayat-surat', compact('data'));
}
}