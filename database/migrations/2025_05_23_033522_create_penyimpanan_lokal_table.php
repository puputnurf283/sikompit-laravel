<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyimpananLokalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyimpanan_lokal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_list_proyek');
            $table->string('nama', 255);
            $table->date('tanggal_lahir');
            $table->string('status', 100);
            $table->string('email', 255);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('portofolio'); // menyimpan path file portofolio
            $table->string('status_pengajuan', 20);
            $table->enum('jenis_daftar', ['project', 'bootcamp']);
            $table->timestamps();

            // Jika perlu, buat foreign key ke tabel proyek atau bootcamp jika ada
            // $table->foreign('id_list_proyek')->references('id')->on('list_proyek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyimpanan_lokal');
    }
}
