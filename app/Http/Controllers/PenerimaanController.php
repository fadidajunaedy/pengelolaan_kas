<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Penerimaan;
use App\Models\Anggota;
use Carbon\Carbon;
use Session;
Use Redirect;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         $keyword = $request->keyword;
         if(strlen($keyword)){
             $data = Penerimaan::where('no_kwitansi', 'like', "%$keyword%")->
             orwhere('nama', 'like', "%$keyword%")->
             orwhere('keterangan', 'like', "%$keyword%")->
             orwhere('jumlah', 'like', "%$keyword%")->paginate(10);
         } else { 
             $data = Penerimaan::orderBy('created_at', 'asc')->paginate(10); 
         }
         return view('penerimaan.index')->with('data', $data);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::select('nama')->orderBy('created_at', 'asc')->get();
        return view('penerimaan.create')->with('anggota', $anggota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah Admin atau User yang sedang Login
        if(Auth::guard('admins')->user()) {
            $created_user = Auth::guard('admins')->user()->id;
        }
        
        if(Auth::guard('web')->user()) {
            $created_user = Auth::guard('web')->user()->id;
        }

        // Cek apakah nomor kwitansi sudah ada
        if (Penerimaan::where('no_kwitansi', '=', $request->no_kwitansi)->exists()) {
            return Redirect::back()->withErrors("No Kwitansi sudah ada di database");
        }

        $jumlah = str_replace('.', '', trim($request->jumlah));
        $data = [
            'no_kwitansi'=>$request->no_kwitansi,
            'nama'=>$request->nama,
            'tanggal'=>$request->tanggal,
            'keterangan'=>$request->keterangan,
            'jumlah'=>$jumlah,
            'created_user'=>$created_user
        ];
        
        Penerimaan::create($data);
        return redirect()->to('/penerimaan')->with('success', 'Berhasil menambahkan data!');
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
    public function edit(string $no_kwitansi)
    {
        $data = Penerimaan::where('no_kwitansi', $no_kwitansi)->first();
        $anggota = Anggota::select('nama')->orderBy('created_at', 'asc')->get();
        return view('penerimaan.edit', compact('data', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $no_kwitansi)
    {
        $jumlah = str_replace('.', '', trim($request->jumlah));
        $data = [
            'tanggal'=>$request->tanggal,
            'nama'=>$request->nama,
            'keterangan'=>$request->keterangan,
            'jumlah'=>$jumlah,
        ];

        Penerimaan::where('no_kwitansi', $no_kwitansi)->update($data);
        return redirect()->to('penerimaan/')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $no_kwitansi)
    {
        Penerimaan::where('no_kwitansi', $no_kwitansi)->delete();
        return redirect()->to('/penerimaan')->with('success', 'Berhasil menghapus data!');
    }
}
