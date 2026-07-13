<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // 🔥 BERANDA (LIST BERITA)
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('beranda', compact('berita'));
    }

    // 🔥 DETAIL BERITA
    public function show($slug)
    {
        // ambil berita utama
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // 🔥 ambil berita lain (buat slider bawah)
        $berita_lain = Berita::where('id', '!=', $berita->id)
                            ->latest()
                            ->take(5)
                            ->get();

        return view('detail_berita', compact('berita', 'berita_lain'));
    }
}