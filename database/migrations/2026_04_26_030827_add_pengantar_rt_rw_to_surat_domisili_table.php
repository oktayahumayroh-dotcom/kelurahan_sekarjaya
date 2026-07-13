<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->string('pengantar_rt_rw')->nullable()->after('upload_ktp');
        });
    }

    public function down(): void
    {
        Schema::table('surat_domisilis', function (Blueprint $table) {
            $table->dropColumn('pengantar_rt_rw');
        });
    }
};
