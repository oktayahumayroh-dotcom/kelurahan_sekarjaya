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
    Schema::table('surat_domisilis', function (Blueprint $table) {
        $table->year('tahun')->nullable()->after('nomor_urut');
    });
}

public function down()
{
    Schema::table('surat_domisilis', function (Blueprint $table) {
        $table->dropColumn('tahun');
    });
}
};
