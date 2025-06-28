<?php

namespace App\Http\Controllers;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
public function index(Request $request)
{
    $keyword = $request->input('keyword');
    
    $projects = Project::query();
    
    if ($keyword) {
        $projects->where(function($query) use ($keyword) {
            $query->where('posisi', 'like', '%'.$keyword.'%')
                  ->orWhere('perusahaan_mitra', 'like', '%'.$keyword.'%');
        });
    }
    
    $projects = $projects->paginate(9);
    
    // Jika request AJAX, kembalikan hanya bagian project-list
    if ($request->ajax()) {
        return response()->json([
            'html' => view('project.index', compact('projects'))->render()
        ]);
    }
    
    return view('project.index', compact('projects'));
}

public function show($id)
    {
        $project = Project::findOrFail($id);

        return response()->json([
            'nama_proyek' => $project->nama_proyek,
            'posisi'=> $project->posisi,
            'perusahaan_mitra' => $project->perusahaan_mitra,
            'biaya' => number_format($project->biaya, 0, ',', '.'),
            'jangka_waktu' => $project->jangka_waktu,
            'deskripsi_proyek' => $project->deskripsi_proyek,
            'lokasi'=> $project->lokasi,
            'responsibilities' => $project->responsibilities,
            'tanggung_jawab' => $project->tanggung_jawab,
            'why_join' => $project->why_join
        ]);
    }

}