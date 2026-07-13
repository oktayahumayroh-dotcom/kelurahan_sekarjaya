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
    Schema::table('surat_kelahiran', function (Blueprint $table) {
        $table->string('status_surat')->default('pending');
        $table->string('nomor_surat')->nullable();
        $table->dateTime('tanggal_surat')->nullable();
        $table->time('jam_ambil')->nullable();
        $table->date('jadwal_ambil')->nullable();
        $table->text('catatan')->nullable();
        $table->string('upload_ktp')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
