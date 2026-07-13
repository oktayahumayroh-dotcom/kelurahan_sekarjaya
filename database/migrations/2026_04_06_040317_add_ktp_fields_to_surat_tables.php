<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel surat_domisilis
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->string('foto_ktp')->nullable()->after('alamat');
            $table->string('upload_ktp')->nullable()->after('foto_ktp');
        });

        // Tabel surat_usaha
        Schema::table('surat_usaha', function (Blueprint $table) {
            $table->string('foto_ktp')->nullable()->after('alamat');
            $table->string('upload_ktp')->nullable()->after('foto_ktp');
        });
    }

    public function down(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->dropColumn(['foto_ktp', 'upload_ktp']);
        });

        Schema::table('surat_usaha', function (Blueprint $table) {
            $table->dropColumn(['foto_ktp', 'upload_ktp']);
        });
    }
};