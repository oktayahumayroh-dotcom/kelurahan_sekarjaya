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
    Schema::create('surat_kelahiran', function (Blueprint $table) {
        $table->id();

        // DATA ANAK
        $table->string('nama');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->string('jenis_kelamin');
        $table->string('bangsa');
        $table->string('agama');
        $table->string('pekerjaan');
        $table->text('alamat');

        // AYAH
        $table->string('nama_ayah');
        $table->string('tempat_lahir_ayah');
        $table->date('tanggal_lahir_ayah');
        $table->string('pekerjaan_ayah');
        $table->text('alamat_ayah');

        // IBU
        $table->string('nama_ibu');
        $table->string('tempat_lahir_ibu');
        $table->date('tanggal_lahir_ibu');
        $table->string('pekerjaan_ibu');
        $table->text('alamat_ibu');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kelahiran');
    }
};
