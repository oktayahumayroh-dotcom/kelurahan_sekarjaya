<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    // 🔥 LIST BERITA
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    // 🔥 FORM CREATE
    public function create()
    {
        return view('admin.berita.create');
    }

    // 🔥 STORE BERITA
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambarPath = null;

        // ✅ Upload gambar ke public/berita
        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

           $namaFile = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            // simpan ke public/berita
            $file->move(public_path('berita'), $namaFile);

            $gambarPath = 'berita/'.$namaFile;
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'gambar' => $gambarPath,
            'tanggal_upload' => now(),
        ]);

        return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan');
    }

    // 🔥 FORM EDIT
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // 🔥 UPDATE BERITA
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
        ];

        // ✅ kalau upload gambar baru
        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

           $namaFile = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();

            // simpan ke public/berita
            $file->move(public_path('berita'), $namaFile);

            $data['gambar'] = 'berita/'.$namaFile;
        }

        $berita->update($data);

        return redirect('/admin/berita')->with('success', 'Berita berhasil diupdate');
    }

    // 🔥 DELETE BERITA
    public function delete($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect('/admin/berita')->with('success', 'Berita berhasil dihapus');
    }
}