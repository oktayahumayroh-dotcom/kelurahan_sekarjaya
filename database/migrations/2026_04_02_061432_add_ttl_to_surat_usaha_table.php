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
    Schema::table('surat_usaha', function (Blueprint $table) {
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
    });
}

public function down()
{
    Schema::table('surat_usaha', function (Blueprint $table) {
        $table->dropColumn(['tempat_lahir', 'tanggal_lahir']);
    });
}
};
