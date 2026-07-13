<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Berita;

// 🔥 TAMBAHAN
use App\Models\SuratDomisili;
use App\Models\SuratUsaha;
use App\Models\SuratTidakMampu;
use App\Models\SuratKelahiran;

class HomeController extends Controller
{
    public function index()
    {
        // 🔥 SAMAIN PERSIS
        $penduduk = Statistic::where('key', 'penduduk')->first();
        $rt = Statistic::where('key', 'rt')->first();
        $rw = Statistic::where('key', 'rw')->first();

        $suratMasuk =
            SuratDomisili::count() +
            SuratUsaha::count() +
            SuratTidakMampu::count() +
            SuratKelahiran::count();

        $berita = Berita::latest()->get();

        return view('beranda', compact(
            'penduduk',
            'rt',
            'rw',
            'suratMasuk',
            'berita'
        ));
    }
}