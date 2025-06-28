<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Project;
use App\Models\Bootcamp;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{

    public function index()
{
    
}

public function home()
{
    $activityController = new ActivityController();
    $dataForPieChart = $activityController->getRegistrationHistory();

    // Ambil data project dan bootcamp
    $projects = Project::paginate(3);
    $bootcamps = Bootcamp::take(3)->get();

$recentActivities = DB::table('penyimpanan_lokal')
    ->leftJoin('list_proyek', function($join) {
        $join->on('penyimpanan_lokal.id_list_proyek', '=', 'list_proyek.id')
            ->where('penyimpanan_lokal.jenis_daftar', 'project');
    })
    ->leftJoin('list_bootcamp', function($join) {
        $join->on('penyimpanan_lokal.id_bootcamp', '=', 'list_bootcamp.id')
            ->where('penyimpanan_lokal.jenis_daftar', 'bootcamp');
    })
    ->select(
        'penyimpanan_lokal.*',
        'list_proyek.nama_proyek',
        'list_proyek.posisi',
        'list_proyek.perusahaan_mitra', // Add perusahaan_mitra here
        'list_bootcamp.nama_bootcamp',
        'list_bootcamp.penyedia',
        DB::raw("CASE 
            WHEN penyimpanan_lokal.jenis_daftar = 'project' THEN list_proyek.nama_proyek
            WHEN penyimpanan_lokal.jenis_daftar = 'bootcamp' THEN list_bootcamp.nama_bootcamp
            ELSE 'Unknown Activity'
        END as activity_name"),
        DB::raw("CASE 
            WHEN penyimpanan_lokal.jenis_daftar = 'project' THEN 'Project'
            WHEN penyimpanan_lokal.jenis_daftar = 'bootcamp' THEN list_bootcamp.penyedia
            ELSE 'Unknown'
        END as activity_type")
    )
    ->orderBy('penyimpanan_lokal.id', 'desc')
    ->limit(3)
    ->get();

return view('dashboard.home_log', [
    'dataForPieChart' => $dataForPieChart,
    'projects' => $projects,
    'bootcamps' => $bootcamps,
    'recentActivities' => $recentActivities // kirim ke view
]);

}



    
    public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    $user = DB::table('login')
        ->where('email', $credentials['email'])
        ->first();

    if (!$user) {
        return redirect()
            ->route('landing.login')
            ->with('error', 'Email tidak terdaftar!')
            ->withInput($request->except('password'));
    }

    if (!Hash::check($credentials['password'], $user->password)) {
        return redirect()
            ->route('landing.login')
            ->with('error', 'Password yang Anda masukkan salah!')
            ->withInput($request->except('password'));
    }

    // Simpan data user di session
    session([
        'user' => $user->email,
        'user_id' => $user->id,
        'user_name' => $user->name,
        'first_login' => true // Tambahkan flag untuk pertama kali login
    ]);

    return redirect()
        ->route('home')
        ->with('success', 'Login berhasil! Selamat datang kembali.');
}

public function logout(Request $request)
{
    // Hapus semua session user
    $request->session()->flush();

    // Redirect ke home_nolog dengan pesan sukses
    return redirect()->route('home.nolog')->with('logout_success', 'Anda telah keluar dari SIKOMPIT');
}
public function homeNoLog()
{
    return view('landing.home_nolog'); // pastikan view ini sudah ada
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}