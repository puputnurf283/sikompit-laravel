<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    protected $table = 'list_bootcamp';  // nama tabel sesuai database lama

    protected $fillable = [
        'nama_bootcamp',
        'penyedia',
        'biaya',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
    ];
}
