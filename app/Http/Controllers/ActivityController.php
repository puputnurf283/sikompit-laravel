<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bootcamp;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
  public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $projects = DB::table('penyimpanan_lokal')
        ->join('list_proyek', 'penyimpanan_lokal.id_list_proyek', '=', 'list_proyek.id')
        ->where('penyimpanan_lokal.jenis_daftar', 'project')
        ->select(
            'penyimpanan_lokal.id',
            'list_proyek.nama_proyek as nama',
            'list_proyek.posisi',
            'list_proyek.perusahaan_mitra',
            'list_proyek.biaya',
            'list_proyek.jangka_waktu',
            'list_proyek.deskripsi_proyek',
            'penyimpanan_lokal.status_pengajuan',
            'penyimpanan_lokal.jenis_daftar'
        );

    $bootcamps = DB::table('penyimpanan_lokal')
        ->join('list_bootcamp', 'penyimpanan_lokal.id_bootcamp', '=', 'list_bootcamp.id')
        ->where('penyimpanan_lokal.jenis_daftar', 'bootcamp')
        ->select(
            'penyimpanan_lokal.id',
            'list_bootcamp.nama_bootcamp as nama',
            DB::raw('NULL as posisi'),
            'list_bootcamp.penyedia as perusahaan_mitra',
            'list_bootcamp.biaya',
            DB::raw("CONCAT(DATE_FORMAT(list_bootcamp.tanggal_mulai, '%d-%m-%Y'), ' - ', DATE_FORMAT(list_bootcamp.tanggal_selesai, '%d-%m-%Y')) as jangka_waktu"),
            'list_bootcamp.deskripsi as deskripsi_proyek',
            'penyimpanan_lokal.status_pengajuan',
            'penyimpanan_lokal.jenis_daftar'
        );
    
    if ($keyword) {
    $projects->where(function($q) use ($keyword) {
        $q->where('list_proyek.nama_proyek', 'like', "%$keyword%")
          ->orWhere('list_proyek.posisi', 'like', "%$keyword%")
          ->orWhere('list_proyek.perusahaan_mitra', 'like', "%$keyword%")
          ->orWhere('list_proyek.deskripsi_proyek', 'like', "%$keyword%");
    });

    $bootcamps->where(function($q) use ($keyword) {
        $q->where('list_bootcamp.nama_bootcamp', 'like', "%$keyword%")
          ->orWhere('list_bootcamp.penyedia', 'like', "%$keyword%")
          ->orWhere('list_bootcamp.deskripsi', 'like', "%$keyword%");
    });
}

    $unionQuery = $projects->unionAll($bootcamps);

    $query = DB::table(DB::raw("({$unionQuery->toSql()}) as sub"))
        ->mergeBindings($unionQuery);


    $activities = $query->orderByDesc('id')->get();

    // Kalau request ajax (dari frontend fetch), return JSON html partial
    if ($request->ajax()) {
        $html = view('activity.partials.activities_list', compact('activities'))->render();
        return response()->json(['html' => $html]);
    }

    // Bukan ajax, return view full page
    return view('activity.index', compact('activities'));
}


public function destroy($id)
    {
        try {
            $deleted = DB::table('penyimpanan_lokal')->where('id', $id)->delete();
            $delete = DB::table('pengajuan')->where('id_penyimpanan_lokal', $id)->delete();

            if ($deleted && $delete) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus'
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

public function ajukan($id)
{
    // Cari data penyimpanan_lokal berdasar id
    $penyimpanan = DB::table('penyimpanan_lokal')->where('id', $id)->first();

    if (!$penyimpanan) {
        return redirect()->route('activity.index')->with('error', 'Data tidak ditemukan.');
    }

    $statusArr = ['DIAJUKAN', 'DITERIMA', 'DITOLAK'];
    $statusPengajuan = $statusArr[array_rand($statusArr)];

    // Update status_pengajuan
    DB::table('penyimpanan_lokal')
        ->where('id', $id)
        ->update(['status_pengajuan' => $statusPengajuan]);

    // Insert ke tabel pengajuan
    DB::table('pengajuan')->insert([
        'id_penyimpanan_lokal' => $penyimpanan->id,
        'id_list_proyek' => $penyimpanan->id_list_proyek ?? null,
        'status_pengajuan' => $statusPengajuan,
    ]);

    return redirect()->route('activity.index')->with('success', 'Pengajuan berhasil!');
}
public function edit($id)
{
    $activity = DB::table('penyimpanan_lokal')->where('id', $id)->first();

    if (!$activity) {
        return redirect()->route('activity.index')->with('error', 'Data tidak ditemukan');
    }

    return view('activity.edit', compact('activity'));
}


public function getData($id)
{
    $data = DB::table('penyimpanan_lokal')->where('id', $id)->first();

    if (!$data) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan.'
        ]);
    }

    return response()->json([
        'success' => true,
        'id' => $data->id,
        'id_list_proyek' => $data->id_list_proyek,
        'nama' => $data->nama,
        'tanggal_lahir' => $data->tanggal_lahir,
        'status' => $data->status,
        'email' => $data->email,
        'jenis_kelamin' => $data->jenis_kelamin,
        'portofolio' => !empty($data->portofolio) ? asset('uploads/' . $data->portofolio) : null,
    ]);
}

public function getRegistrationHistory()
    {
        // Menghitung jumlah project dan bootcamp dari tabel penyimpanan_lokal
        
       $projectCount = DB::table('penyimpanan_lokal')->where('jenis_daftar', 'project')->count();
       $bootcampCount = DB::table('penyimpanan_lokal')->where('jenis_daftar', 'bootcamp')->count();

        // Mengembalikan data dalam bentuk array
        return [
            'project' => $projectCount,
            'bootcamp' => $bootcampCount
        ];
    }
public function update(Request $request, $id)
{
    // Validasi
    $request->validate([
        'nama' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'status' => 'nullable|string',
        'email' => 'required|email',
        'jenis_kelamin' => 'required|string',
        'portofolio' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // max 2MB
    ]);

    $activity = DB::table('penyimpanan_lokal')->where('id', $id);

    if (!$activity->exists()) {
        return redirect()->route('activity.index')->with('error', 'Data tidak ditemukan');
    }

    $data = [
        'nama' => $request->nama,
        'tanggal_lahir' => $request->tanggal_lahir,
        'status' => $request->status,
        'email' => $request->email,
        'jenis_kelamin' => $request->jenis_kelamin,
    ];

    // ✅ Cek jika ada file baru diupload
    if ($request->hasFile('portofolio')) {
        $file = $request->file('portofolio');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('portofolio', $fileName, 'public'); // simpan di storage/app/public/portofolio

        $data['portofolio'] = $filePath;
    }

    // ⬇️ Logika jika tombol simpan atau ajukan ditekan
    if ($request->has('simpan')) {
        $activity->update($data);
        return redirect()->route('activity.index')->with('success', 'Data berhasil disimpan');
    } elseif ($request->has('ajukan')) {
        $data['status_pengajuan'] = 'DIAJUKAN'; // ubah kolom yang benar
        $activity->update($data);
        return redirect()->route('activity.index')->with('success', 'Data berhasil diajukan');
    }
}


}