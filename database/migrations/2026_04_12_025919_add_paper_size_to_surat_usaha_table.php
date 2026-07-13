<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_usaha', function (Blueprint $table) {
            $table->string('paper_size', 255)->nullable()->after('catatan');
        });
    }

    public function down(): void
    {
        Schema::table('surat_usaha', function (Blueprint $table) {
            $table->dropColumn('paper_size');
        });
    }
};
