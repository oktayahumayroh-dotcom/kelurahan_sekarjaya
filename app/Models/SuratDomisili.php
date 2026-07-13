<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    protected $fillable = [
    'nik',
    'nama',
    'bin_binti',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'agama',
    'status',
    'kewarganegaraan',
    'pekerjaan',
    'alamat',
    'nomor_surat',
    'tahun',
    'nomor_urut',
    'tanggal_surat',
    'status_surat',
    'jadwal_ambil',
    'catatan',
    'jam_ambil',
    'paper_size',
    'upload_ktp',
    'pengantar_rt_rw',
    'no_wa'
];
}
