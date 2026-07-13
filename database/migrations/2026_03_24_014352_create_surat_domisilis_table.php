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
    Schema::create('surat_domisilis', function (Blueprint $table) {
        $table->id();

        $table->string('nik');
        $table->string('nama');
        $table->string('bin_binti')->nullable();
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin');
        $table->string('agama');
        $table->string('status');
        $table->string('kewarganegaraan');
        $table->string('pekerjaan');
        $table->text('alamat');

        // STATUS 🔥
        $table->enum('status_surat', ['pending', 'proses', 'selesai'])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_domisilis');
    }
};
