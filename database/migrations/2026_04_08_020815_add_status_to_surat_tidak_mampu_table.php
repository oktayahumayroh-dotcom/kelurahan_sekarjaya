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
    Schema::table('surat_tidak_mampu', function (Blueprint $table) {
        $table->string('status')->nullable(); // bisa nullable dulu
    });
}

public function down(): void
{
    Schema::table('surat_tidak_mampu', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
