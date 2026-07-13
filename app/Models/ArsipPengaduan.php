<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipPengaduan extends Model
{
    protected $table = 'arsip_pengaduans';

    protected $fillable = [
        'pengaduan_id',
        'nik',
        'nama',
        'telepon',
        'jenis_pengaduan',
        'alamat',
        'rt',
        'rw',
        'keterangan',
        'foto',
        'status',
        'catatan',
        'tanggal_tindak_lanjut'
    ];
}