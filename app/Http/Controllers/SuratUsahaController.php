<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratUsaha;
use App\Models\Notifikasi;
use Carbon\Carbon;

class SuratUsahaController extends Controller
{
    // FORM
    public function create()
    {
        return view('usaha.form');
    }

    // SIMPAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'status' => 'required|string',
            'kewarganegaraan' => 'required|string',
            'pekerjaan' => 'required|string',
            'alamat' => 'required|string',
            'jenis_usaha' => 'required|string|max:100',
            'tempat_usaha' => 'required|string|max:150',
            'upload_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'no_wa' => 'required|regex:/^08[0-9]{8,12}$/',
        ]);

        // limit harian
        $jumlah = SuratUsaha::where('nik', $validated['nik'])
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($jumlah >= 2) {
            return back()->with('error', 'Sudah 2 kali pengajuan hari ini');
        }

        // upload ktp
        if ($request->hasFile('upload_ktp')) {
            $file = $request->file('upload_ktp');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('ktp'), $filename);
            $validated['upload_ktp'] = 'ktp/'.$filename;
        }

        $validated['status_surat'] = 'pending';

        // SIMPAN SURAT
        $surat = SuratUsaha::create($validated);

        // NOTIFIKASI (INI YANG BENAR)
        Notifikasi::create([
            'title' => 'Pengajuan Baru',
            'message' => $surat->nama.' mengajukan Surat Usaha pada ' . $surat->created_at->format('d M Y'),
            'type' => 'pengajuan',
            'surat_id' => $surat->id,
            'jenis_surat' => 'usaha',
            'is_read' => 0,
            'is_popup' => 1
        ]);

        return back()->with('success', 'Berhasil');
    }
}