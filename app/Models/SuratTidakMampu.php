<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTidakMampu extends Model
{
    use HasFactory;

    protected $table = 'surat_tidak_mampu';

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
        'upload_ktp',
        'nomor_surat',
        'nomor_urut',
        'tahun',
        'tanggal_surat',
        'jam_ambil',
        'jadwal_ambil',
        'catatan',
        'status_surat',
        'no_wa'
    ];
}