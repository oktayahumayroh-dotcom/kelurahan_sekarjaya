<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->time('jam_ambil')->nullable()->after('jadwal_ambil');
        });
    }

    public function down(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->dropColumn('jam_ambil');
        });
    }
};