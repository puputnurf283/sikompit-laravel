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
        Schema::create('list_proyek', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('posisi');
            $table->string('perusahaan_mitra');
            $table->bigInteger('biaya');
            $table->string('jangka_waktu'); // bisa disesuaikan, jika ingin pakai date gunakan date/dateTime
            $table->text('deskripsi_proyek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_proyek');
    }
};
