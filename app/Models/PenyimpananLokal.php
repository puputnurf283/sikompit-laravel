<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyimpananLokal extends Model
{
    use HasFactory;

    protected $table = 'penyimpanan_lokal';

    protected $fillable = [
        'id_list_proyek',
        'id_bootcamp',
        'nama',
        'tanggal_lahir',
        'status',
        'email',
        'jenis_kelamin',
        'portofolio',
        'status_pengajuan',
        'jenis_daftar',
    ];
    public $timestamps = false;
}
