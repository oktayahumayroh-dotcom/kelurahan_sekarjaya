<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        // ======================
        // DATA STATISTIK SEMENTARA
        // (tanpa database)
        // ======================

        $penduduk = (object)[
            'value' => 0
        ];

        $rt = (object)[
            'value' => 0
        ];

        $rw = (object)[
            'value' => 0
        ];

        // ======================
        // TOTAL SURAT MASUK
        // ======================
        $suratMasuk = 0;

        // ======================
        // TOTAL PENGADUAN
        // ======================
        $pengaduan = 0;

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
