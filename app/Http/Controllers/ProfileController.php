<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::guard('admins')->user()) {
            $data = Admin::where('id', Auth::guard('admins')->user()->id)->first();
        }
        
        if(Auth::guard('web')->user()) {
            $data = User::where('id', Auth::guard('web')->user()->id)->first();
        }
        return view('profile.index')->with('data', $data);
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
        $data = [
            'username'=>$request->username,
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'telepon'=>$request->telepon
        ];

        if($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png'
            ]);

            $foto = $request->file('foto');
            $foto_extension = $foto->extension();
            $foto_name = date('ymdhis').".".$foto_extension;
            $foto->move(public_path('foto'), $foto_name);

            if (Auth::guard('admins')->user()){
                $data_foto = Admin::where('id', $id)->first();
            }

            if (Auth::guard('web')->user()){
                $data_foto = User::where('id', $id)->first();
            }
            File::delete(public_path('foto').'/'.$data_foto->foto);

            $data['foto'] = $foto_name;
            
        } else {
            unset($data['foto']);
        }

        if (Auth::guard('admins')->user()){
            Admin::where('id', $id)->update($data);
        }

        if (Auth::guard('web')->user()){
            User::where('id', $id)->update($data);
        }

        return redirect()->to('/profile')->with('success', 'Berhasil update profile!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
