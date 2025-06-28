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
    Schema::table('penyimpanan_lokal', function (Blueprint $table) {
        $table->unsignedBigInteger('id_bootcamp')->nullable()->after('id_list_proyek');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyimpanan_lokal', function (Blueprint $table) {
            //
        });
    }
};
