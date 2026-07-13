<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id(); // id otomatis pengaduan
            $table->string('nik', 16); // NIK pelapor
            $table->string('nama'); // Nama pelapor
            $table->string('telepon')->nullable(); // Nomor yang bisa dihubungi
            $table->string('kategori'); // kategori pengaduan (dropdown)
            $table->text('deskripsi'); // isi laporan
            $table->string('alamat'); // lokasi / alamat
            $table->string('foto')->nullable(); // path foto jika ada
            $table->enum('status', ['pending', 'proses', 'selesai', 'ditolak'])->default('pending'); // status pengaduan
            $table->text('catatan')->nullable(); // catatan admin
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};