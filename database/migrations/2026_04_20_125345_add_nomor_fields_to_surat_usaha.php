<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('surat_usaha', function (Blueprint $table) {
            // ✅ cukup tambah tahun saja
            $table->year('tahun')->nullable()->after('nomor_urut');
        });
    }

    public function down()
    {
        Schema::table('surat_usaha', function (Blueprint $table) {
            // rollback hanya hapus tahun
            $table->dropColumn('tahun');
        });
    }
};