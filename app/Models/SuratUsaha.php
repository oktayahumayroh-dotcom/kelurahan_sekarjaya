<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratUsaha extends Model
{
    protected $table = 'surat_usaha';

protected $fillable = [
    'nik',
    'nama',
    'jenis_kelamin',
    'agama',
    'status',
    'kewarganegaraan',
    'pekerjaan',
    'alamat',
    'jenis_usaha',
    'tempat_usaha',
    'nomor_surat',
    'tahun',
    'nomor_urut',
    'tanggal_surat',
    'jadwal_ambil',
    'catatan',
    'status_surat',
    'tempat_lahir',
    'tanggal_lahir',
    'jam_ambil',
    'upload_ktp',
    'no_wa'
];
}
