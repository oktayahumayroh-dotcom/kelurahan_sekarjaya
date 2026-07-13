<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;

use App\Models\SuratDomisili;
use App\Models\SuratUsaha;
use App\Models\SuratTidakMampu;
use App\Models\SuratKelahiran;
use App\Models\Pengaduan;

class StatistikController extends Controller
{
    public function index()
    {
        // ======================
        // DATA STATISTIK UTAMA
        // ======================
        $penduduk = Statistic::where('key', 'penduduk')->first();
        $rt = Statistic::where('key', 'rt')->first();
        $rw = Statistic::where('key', 'rw')->first();

        // ======================
        // SURAT MASUK (TOTAL)
        // ======================
        $suratMasuk =
            SuratDomisili::count() +
            SuratUsaha::count() +
            SuratTidakMampu::count() +
            SuratKelahiran::count();

        // ======================
        // PENGADUAN
        // ======================
        $pengaduan = Pengaduan::count();

        // ======================
        // RETURN VIEW
        // ======================
        return view('statistik', [
            'penduduk' => $penduduk,
            'rt' => $rt,
            'rw' => $rw,
            'suratMasuk' => $suratMasuk,
            'pengaduan' => $pengaduan,
        ]);
    }
}