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
    Schema::create('list_bootcamp', function (Blueprint $table) {
        $table->id();
        $table->string('nama_bootcamp');
        $table->string('penyedia');
        $table->bigInteger('biaya');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->text('deskripsi');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_bootcamp');
    }
};
