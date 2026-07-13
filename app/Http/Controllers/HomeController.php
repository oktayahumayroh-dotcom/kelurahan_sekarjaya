<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // sementara tanpa database
        $penduduk = (object)[
            'value' => '0'
        ];

        $rt = (object)[
            'value' => '0'
        ];

        $rw = (object)[
            'value' => '0'
        ];

        $suratMasuk = 0;

        $berita = [];

        return view('beranda', compact(
            'penduduk',
            'rt',
            'rw',
            'suratMasuk',
            'berita'
        ));
    }
}
