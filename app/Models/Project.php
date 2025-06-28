<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'list_proyek'; // Nama tabel di database

    protected $fillable = [
        'nama_proyek',
        'posisi',
        'perusahaan_mitra',
        'biaya',
        'jangka_waktu',
        'deskripsi_proyek',
    ];
}
