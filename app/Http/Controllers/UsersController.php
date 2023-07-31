<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if(strlen($keyword)){
            $data = User::where('username', 'like', "%$keyword%")->
            orwhere('fullname', 'like', "%$keyword%")->
            orwhere('email', 'like', "%$keyword%")->
            orwhere('telepon', 'like', "%$keyword%")->paginate(10);
        } else { 
            $data = User::orderBy('created_at', 'asc')->paginate(10); 
        }
        return view('users.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'username'=>$request->username,
            'fullname'=>$request->fullname,
            'password'=>Hash::make($request->password),
            'status'=>'aktif'
        ];

        // Cek apakah nomor kwitansi sudah ada
        if (User::where('username', '=', $request->username)->exists()) {
            return Redirect::back()->withErrors("Username sudah terdaftar di database!");
        }
        
        User::create($data);
        return redirect()->to('/users')->with('success', 'Berhasil menambahkan data!');
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
        $data = User::where('id', $id)->first();
        return view('users.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'username'=>$request->username,
            'fullname'=>$request->fullname,
            'password'=>Hash::make($request->password),
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

            $data_foto = User::where('id', $id)->first();
            File::delete(public_path('foto').'/'.$data_foto->foto);

            $data['foto'] = $foto_name;
            
        } else {
            unset($data['foto']);
        }
        User::where('id', $id)->update($data);
        return redirect()->to('/users')->with('success', 'Berhasil update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('/users')->with('success', 'Berhasil menghapus data!');
    }

    public function changeToAktif(string $id) {
        User::where('id', $id)->update(['status' => 'aktif']);
        return redirect()->to('/users')->with('success', 'Berhasil mengubah status user!');
    }

    public function changeToNonAktif(string $id) {
        User::where('id', $id)->update(['status' => 'nonaktif']);
        return redirect()->to('/users')->with('success', 'Berhasil mengubah status user!');
    }
    
}
