<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    // FORM INPUT PENGADUAN
    public function create()
    {
        return view('pengaduan.form');
    }

    // SIMPAN PENGADUAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16',
            'nama' => 'required|string|max:100',
            'telepon' => 'required|string|max:15',
            'jenis_pengaduan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'keterangan' => 'required|string',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'lainnya' => 'nullable|string|max:255', // tetap untuk input "lainnya" tapi nanti cuma dipakai untuk jenis_pengaduan
        ]);

if ($request->hasFile('foto')) {
    $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
}

        // Gunakan jenis_pengaduan langsung, jika 'lainnya' pakai isi input lainnya
        $validated['jenis_pengaduan'] = $request->jenis_pengaduan === 'lainnya'
            ? $request->lainnya
            : $request->jenis_pengaduan;

        // Status default
        $validated['status'] = 'pending';
        $validated['catatan'] = null;

        // Hapus field lain yang nggak dipakai
        unset($validated['lainnya']);

        // Simpan ke database
        

        $pengaduan = Pengaduan::create($validated);

// 🔔 NOTIF PENGADUAN MASUK
\App\Models\Notifikasi::create([
    'title' => 'Pengaduan Baru',
    'message' => $pengaduan->nama . ' mengirim pengaduan',
    'type' => 'pengaduan',
    'surat_id' => $pengaduan->id,
    'jenis_surat' => 'pengaduan',
    'is_read' => 0,
    'is_popup' => 1
]);

return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }

    // FORM CEK STATUS PENGADUAN
    public function formCek()
    {
        return view('pengaduan.cek_status');
    }

    // CEK STATUS PENGADUAN
    public function cekStatus(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
        ]);

        $data = Pengaduan::where('nik', $request->nik)
            ->orderByDesc('created_at')
            ->get();

        return view('pengaduan.hasil_status', compact('data'));
    }
}