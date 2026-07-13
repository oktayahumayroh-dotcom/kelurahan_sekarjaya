<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('surat_usaha', function (Blueprint $table) {
        $table->id();

        // DATA PEMOHON
        $table->string('nama');
        $table->string('jenis_kelamin');
        $table->string('agama');
        $table->string('status');
        $table->string('kewarganegaraan');
        $table->string('pekerjaan');
        $table->text('alamat');

        // DATA USAHA
        $table->string('jenis_usaha');
        $table->string('tempat_usaha');

        // DATA ADMIN
        $table->string('nomor_surat')->nullable();
        $table->date('tanggal_surat')->nullable();
        $table->date('jadwal_ambil')->nullable();
        $table->text('catatan')->nullable();

        // STATUS
        $table->enum('status_surat', ['pending', 'proses', 'selesai'])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_usaha');
    }
};
