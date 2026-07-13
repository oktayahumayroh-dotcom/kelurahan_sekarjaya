<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifications'; // 🔥 penting (biar gak jadi notifikasis)

  protected $fillable = [
    'title',
    'message',
    'type',
    'url',
    'is_read',
    'is_popup',
    'surat_id',      // ✅ TAMBAH INI
    'jenis_surat'    // ✅ TAMBAH INI
];

    protected $casts = [
        'is_read' => 'boolean',
        'is_popup' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}