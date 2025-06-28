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
        $table->renameColumn('id_list_proyek', 'id_list');
    });
}

public function down()
{
    Schema::table('penyimpanan_lokal', function (Blueprint $table) {
        $table->renameColumn('id_list', 'id_list_proyek');
    });
}

};
