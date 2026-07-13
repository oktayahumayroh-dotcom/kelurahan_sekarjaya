<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsip_pengaduans', function (Blueprint $table) {
            $table->id();

            // 🔥 DATA UTAMA PENGADUAN
            $table->string('nik', 16);
            $table->string('nama');
            $table->string('telepon')->nullable();

            $table->string('jenis_pengaduan');
            $table->string('alamat');

            $table->string('rt')->nullable();
            $table->string('rw')->nullable();

            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();

            // 🔥 STATUS & PROSES
            $table->enum('status', ['pending', 'proses', 'selesai', 'ditolak']);

            $table->text('catatan')->nullable();
            $table->date('tanggal_tindak_lanjut')->nullable();

            // 🔥 RELASI KE DATA ASLI
            $table->unsignedBigInteger('pengaduan_id')->nullable();

            // 🔥 TIMESTAMP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_pengaduans');
    }
};