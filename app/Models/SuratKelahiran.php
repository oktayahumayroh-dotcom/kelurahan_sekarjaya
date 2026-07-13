<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKelahiran extends Model
{
    use HasFactory;

    protected $table = 'surat_kelahiran';

    protected $fillable = [
        // DATA ANAK
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'bangsa',
        'agama',
        'pekerjaan',
        'alamat',

        // AYAH
        'nama_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'alamat_ayah',

        // IBU
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'alamat_ibu',

        // SISTEM
        'status_surat',
        'nomor_surat',
        'nomor_urut',
        'tahun',
        'tanggal_surat',
        'jam_ambil',
        'jadwal_ambil',
        'catatan',
         'upload_ktp',
         'no_wa'
    ];
}