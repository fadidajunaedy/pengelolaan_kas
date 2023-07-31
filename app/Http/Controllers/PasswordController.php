<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class PasswordController extends Controller
{
    public function index(Request $request) {
        return view('password.index');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ],
        [
            'new_password' => 'Password konfirmasi tidak sesuai',
        ]);

        if (Auth::guard('web')->user()) {
            if(!Hash::check($request->old_password, Auth::guard('web')->user()->password)) {
                return back()->withErrors("Password lama tidak sesuai!");
            }
            User::where('id', Auth::guard('web')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return back()->with("success", "Berhasil merubah password!");
        }

        if (Auth::guard('admins')->user()) {
            if(!Hash::check($request->old_password, Auth::guard('admins')->user()->password)) {
                return back()->withErrors("Password lama tidak sesuai!");
            }
            Admin::where('id', Auth::guard('admins')->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return back()->with("success", "Berhasil merubah password!");
        }
        
    }
}
