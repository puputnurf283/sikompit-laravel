<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $bootcamps = Bootcamp::query();
        
        if ($keyword) {
            $bootcamps->where(function($query) use ($keyword) {
                $query->where('nama_bootcamp', 'like', '%'.$keyword.'%')
                      ->orWhere('penyedia', 'like', '%'.$keyword.'%')
                      ->orWhere('deskripsi', 'like', '%'.$keyword.'%');
            });
        }
        
        $bootcamps = $bootcamps->paginate(9);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('bootcamp.index', compact('bootcamps'))->render()
            ]);
        }
        
        return view('bootcamp.index', compact('bootcamps'));
    }

    public function show($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        return response()->json([
            'nama_bootcamp' => $bootcamp->nama_bootcamp,
            'penyedia' => $bootcamp->penyedia,
            'biaya' => number_format($bootcamp->biaya, 0, ',', '.'),
            'tanggal_mulai' => \Carbon\Carbon::parse($bootcamp->tanggal_mulai)->format('d F Y'),
            'tanggal_selesai' => \Carbon\Carbon::parse($bootcamp->tanggal_selesai)->format('d F Y'),
            'deskripsi' => $bootcamp->deskripsi,
            'waktu_kelas' => $bootcamp->waktu_kelas,
            'hari_kelas' => $bootcamp->hari_kelas,
            'durasi' => $bootcamp->durasi,
            'silabus' => $bootcamp->silabus,
            'fasilitas' => $bootcamp->fasilitas,
            'mentor' => $bootcamp->mentor
        ]);
    }
}