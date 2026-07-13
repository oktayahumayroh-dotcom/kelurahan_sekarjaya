<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKelahiran;
use Carbon\Carbon;


class SuratKelahiranController extends Controller
{
    // ================= USER: FORM PENGAJUAN =================
    public function create()
    {
        return view('kelahiran.form'); // form untuk user
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // DATA ANAK
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'bangsa' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'alamat' => 'required|string',

            // AYAH
            'nama_ayah' => 'required|string|max:100',
            'nik_ayah'  => 'required|string|size:16',
            'tempat_lahir_ayah' => 'required|string|max:50',
            'tanggal_lahir_ayah' => 'required|date',
            'pekerjaan_ayah' => 'required|string|max:100',
            'alamat_ayah' => 'required|string',

            // IBU
            'nama_ibu' => 'required|string|max:100',
            'tempat_lahir_ibu' => 'required|string|max:50',
            'tanggal_lahir_ibu' => 'required|date',
            'pekerjaan_ibu' => 'required|string|max:100',
            'alamat_ibu' => 'required|string',
            'no_wa' => 'required|regex:/^08[0-9]{8,12}$/',
            'upload_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',                         
        ]);

            // 🔥 LIMIT NIK
$jumlah = SuratKelahiran::where('nik_ayah', $validated['nik_ayah'])
    ->whereDate('created_at', Carbon::today())
    ->count();

if ($jumlah >= 2) {
    return redirect()->back()->with('error', 'NIK ' . $validated['nik_ayah'] . ' sudah melakukan 2 kali pengajuan hari ini!');
}

       // Handle upload KTP
        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ktp'), $filename);
            $validated['upload_ktp'] = 'ktp/' . $filename;
        }


        // Tambahan field sistem (sama seperti surat lain)
        $validated['status_surat'] = 'pending';
        $validated['nomor_surat'] = null;
        $validated['tanggal_surat'] = now();
        $validated['jam_ambil'] = null;
        $validated['jadwal_ambil'] = null;
        $validated['catatan'] = null;

        $surat = SuratKelahiran::create($validated);

// 🔔 NOTIFIKASI ADMIN
\App\Models\Notifikasi::create([
    'title' => 'Pengajuan Baru',
    'message' => $surat->nama . ' mengajukan Surat Kelahiran pada ' . $surat->created_at->format('d M Y'),
    'type' => 'pengajuan',
    'surat_id' => $surat->id,
    'jenis_surat' => 'kelahiran',
    'is_read' => 0,
    'is_popup' => 1
]);

        

        return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');
    }
}