<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Session;
Use Redirect;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
         if(strlen($keyword)){
             $data = Anggota::where('no_anggota', 'like', "%$keyword%")->
             orwhere('nama', 'like', "%$keyword%")->paginate(10);
         } else { 
             $data = Anggota::orderBy('created_at', 'asc')->paginate(10); 
         }
         return view('anggota.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah nomor anggota sudah ada
        if (Anggota::where('no_anggota', '=', $request->no_anggota)->exists()) {
            return Redirect::back()->withErrors("No Anggota sudah ada di database");
        }

        $data = [
            'no_anggota'=>$request->no_anggota,
            'nama'=>$request->nama,
            'no_telepon'=>$request->no_telepon,
            'alamat'=>$request->alamat
        ];
        
        Anggota::create($data);
        return redirect()->to('/anggota')->with('success', 'Berhasil menambahkan data!');

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
    public function edit(string $no_anggota)
    {
        $data = Anggota::where('no_anggota', $no_anggota)->first();
        return view('anggota.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $no_anggota)
    {
        $data = [
            'nama'=>$request->nama,
            'no_telepon'=>$request->no_telepon,
            'alamat'=>$request->alamat
        ];

        Anggota::where('no_anggota', $no_anggota)->update($data);
        return redirect()->to('anggota/')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $no_anggota)
    {
        Anggota::where('no_anggota', $no_anggota)->delete();
        return redirect()->to('/anggota')->with('success', 'Berhasil menghapus data!');
    }
}
