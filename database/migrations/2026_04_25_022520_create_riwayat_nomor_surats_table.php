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
        Schema::create('riwayat_nomor_surats', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_surat');
            $table->integer('nomor_urut');
            $table->integer('tahun');

            $table->string('jenis'); // domisili, usaha, dll
            $table->string('nama');

            $table->string('status')->default('dipakai'); 
            // dipakai / dibatalkan / selesai

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_nomor_surats');
    }
};