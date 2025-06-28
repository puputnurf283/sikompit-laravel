<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class landingcontroller extends Controller
{
    public function index()
    {
        return view('landing.home_nolog');
    }

    /**
     * Show the form for creating a new resource.
     */public function login()
    {
        return view('landing.login');
    }
  public function authenticate(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = DB::table('login')
        ->where('email', $credentials['email'])
        ->where('password', $credentials['password']) // sebaiknya hash!
        ->first();

    if ($user) {
        session(['user' => $user->email]);
        return redirect()->route('home')->with('success', 'Selamat datang kembali di SIKOMPIT!');
    } else {
        return redirect()->route('landing.login')->with('error', 'Email atau password salah');
    }
}
}
