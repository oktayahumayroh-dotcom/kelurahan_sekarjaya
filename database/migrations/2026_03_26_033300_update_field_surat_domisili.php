<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {

            // 🔥 AGAMA
            $table->enum('agama', [
                'Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'
            ])->change();

            // 🔥 STATUS PERKAWINAN
            $table->enum('status', [
                'Belum Menikah','Menikah'
            ])->change();

            // 🔥 KEWARGANEGARAAN
            $table->string('kewarganegaraan', 50)->change();

        });
    }

    public function down(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {

            $table->string('agama')->change();
            $table->string('status')->change();
            $table->string('kewarganegaraan')->change();

        });
    }
};
