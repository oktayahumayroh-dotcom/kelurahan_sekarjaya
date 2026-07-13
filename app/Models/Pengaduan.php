<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'nik',             // NIK pelapor
        'nama',            // Nama pelapor
        'telepon',         // No telepon
        'jenis_pengaduan', // Jenis pengaduan (kebersihan, kerusakan, dll)
        'alamat',          // Alamat lokasi pengaduan
        'keterangan',      // Deskripsi pengaduan
        'foto',            // File foto pengaduan
        'status',          // pending, selesai, tolak
        'catatan'       // Catatan admin jika ada
        

    ];
}