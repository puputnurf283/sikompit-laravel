<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    // Metode untuk logout
    public function destroy(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Menghapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman yang diinginkan setelah logout
        return redirect()->route('home.nolog');
    }
}
