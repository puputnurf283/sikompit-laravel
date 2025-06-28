<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'id_penyimpanan_lokal',
        'id_list_proyek',
        'status_pengajuan',
    ];
    public $timestamps = false;
}
