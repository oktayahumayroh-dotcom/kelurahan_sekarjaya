<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratTidakMampu;
use Carbon\Carbon;
use App\Models\Notifikasi;

class SuratTidakMampuController extends Controller
{
    public function create()
    {
        return view('tidak_mampu.form');
    }

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
           'upload_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'no_wa' => 'required|regex:/^08[0-9]{8,12}$/',
        ]);

        $jumlah = SuratTidakMampu::where('nik', $validated['nik'])
    ->whereDate('created_at', Carbon::today())
    ->count();

if ($jumlah >= 2) {
    return redirect()->back()->with('error', 'NIK ' . $validated['nik'] . ' sudah melakukan 2 kali pengajuan hari ini!');
}

        // Handle upload KTP
        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ktp'), $filename);
            $validated['upload_ktp'] = 'ktp/' . $filename;
        }

        // Tambahan field sistem
        $validated['status_surat'] = 'pending';
        $validated['nomor_surat'] = null;
        $validated['tanggal_surat'] = now();
        $validated['jam_ambil'] = null;
        $validated['jadwal_ambil'] = null;
        $validated['catatan'] = null;

$surat = SuratTidakMampu::create($validated);

// 🔔 NOTIFIKASI ADMIN
\App\Models\Notifikasi::create([
    'title' => 'Pengajuan Baru',
    'message' => $surat->nama . ' mengajukan Surat Tidak Mampu pada ' . $surat->created_at->format('d M Y'),
    'type' => 'pengajuan',
    'surat_id' => $surat->id,
    'jenis_surat' => 'tidak_mampu',
    'is_read' => 0,
    'is_popup' => 1
]);

return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');
    }
}