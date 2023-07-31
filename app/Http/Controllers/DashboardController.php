<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index() {
        $totalJumlahPenerimaan = Penerimaan::sum('jumlah'); 
        $totalJumlahPengeluaran = Pengeluaran::sum('jumlah'); 
        $totalJumlahSaldo = $totalJumlahPenerimaan - $totalJumlahPengeluaran;
        
        return view('index', compact('totalJumlahPenerimaan', 'totalJumlahPengeluaran', 'totalJumlahSaldo'));
    }
}
