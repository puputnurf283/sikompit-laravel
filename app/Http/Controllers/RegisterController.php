<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyimpananLokal;
use App\Models\Pengajuan;

class RegisterController extends Controller
{
    public function showForm(Request $request)
    {
        $idList = $request->query('id_list'); // ambil id list project atau bootcamp
        $jenis = $request->query('jenis');    // 'project' atau 'bootcamp'

        // Validasi parameter 
        if (!in_array($jenis, ['project', 'bootcamp'])) {
            abort(404, "Jenis daftar tidak valid.");
        }
        // Kirim variabel ke view
        return view('register', [
            'idList' => $idList,
            'jenis' => $jenis,
            'isBootcamp' => $jenis === 'bootcamp'
        ]);

    }

    public function submitForm(Request $request)
    {
        $isBootcamp = $request->jenis_daftar === 'bootcamp';
        $filePath = $request->file('portofolio')->store('portofolio', 'public');

        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'portofolio' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'id_list' => 'required|integer',
            'jenis_daftar' => 'required|in:project,bootcamp',
        ]);

        // Simpan file portofolio di storage/app/public/portofolio
        $filePath = $request->file('portofolio')->store('portofolio', 'public');

        // Untuk bootcamp, status selalu "TERDAFTAR"
        $status_pengajuan = $isBootcamp ? 'TERDAFTAR' : 
            ($request->has('ajukan') ? collect(['DIAJUKAN', 'DITERIMA', 'DITOLAK'])->random() : 'BELUM DIAJUKAN');

        // Insert ke tabel penyimpanan_lokal
        $penyimpanan = PenyimpananLokal::create([
            'id_list_proyek' => $isBootcamp ? null : $request->id_list,
            'id_bootcamp' => $isBootcamp ? $request->id_list : null,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'portofolio' => $filePath,
            'status_pengajuan' => $status_pengajuan,
            'jenis_daftar' => $request->jenis_daftar,
        ]);

        // Jika tombol 'ajukan' ditekan, insert ke tabel pengajuan
        if ($request->has('ajukan')) {
            Pengajuan::create([
                'id_penyimpanan_lokal' => $penyimpanan->id,
                'id_list_proyek' => $isBootcamp ? null : $request->id_list,
                'status_pengajuan' => $status_pengajuan,
            ]);
        }

        $request->validate([
            'portofolio' => [
                'required',
                'file',
                $request->jenis_daftar === 'bootcamp' 
                    ? 'mimes:pdf,jpg,jpeg,png' // Format untuk Kartu Pelajar
                    : 'mimes:pdf,jpg,jpeg,png,pdf,zip,docx' // Format untuk Portofolio proyek
            ],
        ]);
        if ($isBootcamp) {
    return redirect('/activity')->with('success', 'Berhasil mendaftar bootcamp!');
} elseif ($request->has('simpan')) {
    return redirect('/activity')->with('success', 'Data berhasil disimpan.');
} elseif ($request->has('ajukan')) {
    return redirect('/activity')->with('success', 'Data berhasil diajukan dan tidak bisa diedit kembali.');
}
    }
    
}
