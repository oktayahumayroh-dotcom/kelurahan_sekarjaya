<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatNomorSurat extends Model
{
    protected $table = 'riwayat_nomor_surats';

    protected $fillable = [
        'nomor_surat',
        'nomor_urut',
        'tahun',
        'jenis',
        'nama',
        'status',
        'keterangan'
    ];
}