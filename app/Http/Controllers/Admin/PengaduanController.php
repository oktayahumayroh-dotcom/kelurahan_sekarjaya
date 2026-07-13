<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use App\Models\ArsipPengaduan;
use Illuminate\Support\Facades\Storage;
class PengaduanController extends Controller
{
    // 🔥 LIST DATA + FILTER + SEARCH
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pengaduan', compact('data'));
    }

    // 🔍 DETAIL
    public function detail($id)
    {
        $data = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.detail', compact('data'));
    }

    // 🔥 PENDING → PROSES
    public function proses($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status == 'pending') {
            $pengaduan->status = 'proses';
            $pengaduan->save();
        }

        return response()->json(['success' => true]);
    }

    // 📝 FORM TANGGAPI
    public function formTanggapi($id)
    {
        $data = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.tanggapi', compact('data'));
    }

    // 🔥 PROSES → SELESAI + AUTO ARSIP
    public function kirimTanggapan(Request $request, $id)
    {
        
        $request->validate([
            'catatan' => 'required',
            'tanggal_tindak_lanjut' => 'nullable|date'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // update data
        $pengaduan->catatan = $request->catatan;
        $pengaduan->tanggal_tindak_lanjut = $request->tanggal_tindak_lanjut;
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        // 🔥 AUTO MASUK ARSIP
        ArsipPengaduan::create([
            'pengaduan_id' => $pengaduan->id,
            'nik' => $pengaduan->nik,
            'nama' => $pengaduan->nama,
            'telepon' => $pengaduan->telepon,
            'jenis_pengaduan' => $pengaduan->jenis_pengaduan,
            'alamat' => $pengaduan->alamat,
            'rt' => $pengaduan->rt,
            'rw' => $pengaduan->rw,
            'keterangan' => $pengaduan->keterangan,
            'foto' => $pengaduan->foto,
            'status' => $pengaduan->status,
            'catatan' => $pengaduan->catatan,
            'tanggal_tindak_lanjut' => $pengaduan->tanggal_tindak_lanjut,
        ]);

        // 🔥 HAPUS DARI DATA AKTIF
       

        // 🔔 NOTIF
        Notifikasi::create([
            'title' => 'Pengaduan Selesai',
            'message' => $pengaduan->nama . ' - pengaduan telah ditindaklanjuti',
            'type' => 'pengaduan',
            'surat_id' => $pengaduan->id,
            'jenis_surat' => 'pengaduan',
            'is_read' => 0,
            'is_popup' => 0
        ]);

        return redirect()->route('admin.pengaduan')
            ->with('success', 'Pengaduan selesai & otomatis masuk arsip!');
    }

    // ❌ TOLAK
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->catatan = $request->catatan;
        $pengaduan->status = 'ditolak';
        $pengaduan->save();

        Notifikasi::create([
            'title' => 'Pengaduan Ditolak',
            'message' => $pengaduan->nama . ' - pengaduan ditolak',
            'type' => 'pengaduan',
            'surat_id' => $pengaduan->id,
            'jenis_surat' => 'pengaduan',
            'is_read' => 0,
            'is_popup' => 0
        ]);

        return redirect()->route('admin.pengaduan')
            ->with('success', 'Pengaduan berhasil ditolak!');
    }

    // 🔴 FORM TOLAK
    public function formTolak($id)
    {
        $data = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.tolak', compact('data'));
    }

    // 📦 VIEW ARSIP
    public function arsip()
    {
        $data = ArsipPengaduan::orderBy('created_at', 'desc')->get();
        return view('admin.arsip_pengaduan', compact('data'));
    }

public function hapus($id)
{
    $data = Pengaduan::findOrFail($id);

    if ($data->foto) {

        $path = public_path('pengaduan_foto/' . $data->foto);

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $data->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
}
}