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
        Schema::create('surat_tidak_mampu', function (Blueprint $table) {
            $table->id();

            // Field tambahan seperti domisili
            $table->string('nomor_surat')->nullable();
            $table->time('jam_ambil')->nullable();
            $table->date('jadwal_ambil')->nullable();
            $table->text('catatan')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('upload_ktp')->nullable(); // opsional, file path
            $table->enum('status_surat', ['pending', 'proses', 'selesai', 'tolak'])->default('pending');

            // Field user basic
            $table->string('nama');
            $table->string('bin_binti');
            $table->string('nik', 16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->enum('kewarganegaraan', ['WNI','WNA']);
            $table->string('pekerjaan');
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tidak_mampu');
    }
};