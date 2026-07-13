<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    // 🔥 ambil semua notif
    public function index()
    {
        return response()->json(
            Notifikasi::latest()->limit(20)->get()
        );
    }

    // 🔥 tandai dibaca
    public function read($id)
    {
        Notifikasi::where('id', $id)->update([
            'is_read' => 1
        ]);

        return response()->json(['success' => true]);
    }

    // 🔥 hapus notif
    public function delete($id)
    {
        Notifikasi::where('id', $id)->delete();

        return response()->json(['success' => true]);
    }

public function show($id)
{
    $notif = Notifikasi::findOrFail($id);

    // tandai sudah dibaca
    $notif->is_read = 1;
    $notif->save();

    // 🔥 KHUSUS PENGADUAN
    if (strtolower($notif->jenis_surat) === 'pengaduan') {
        return redirect()->route('admin.pengaduan.detail', $notif->surat_id);
    }

    // 🔥 DEFAULT (SURAT)
    return redirect()->route('admin.pengajuan', [
        'id' => $notif->surat_id,
        'jenis' => $notif->jenis_surat
    ]);
}

// 🔥 halaman semua notifikasi
public function all()
{
    $allNotifs = Notifikasi::latest()->paginate(15);

    return view('admin.notifikasi.index', compact('allNotifs'));
}
// 🔥 hapus semua notif
public function deleteAll()
{
    Notifikasi::query()->delete();

    return response()->json([
        'success' => true
    ]);
}
}