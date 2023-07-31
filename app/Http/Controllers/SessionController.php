<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index() {
        return view('login');
    }

    function login(Request $request) {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::guard('admins')->user()->status == 'nonaktif') {
                $request->session()->invalidate();
                return back()->withErrors('Akun anda sedang di nonaktifkan');
            }
            return redirect('/');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::guard('web')->user()->status == 'nonaktif') {
                $request->session()->invalidate();
                return back()->withErrors('Akun anda sedang di nonaktifkan');
            }
            return redirect('/');
        }

        return back()->withErrors('Username atau Password yang diinput tidak sesuai');
    }

    function logout(Request $request) {
        $request->session()->invalidate();
        return redirect('/login')->with('success', 'Berhasil logout');
    }
}
