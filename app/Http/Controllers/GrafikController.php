<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use App\Charts\KasChart;
use DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class GrafikController extends Controller
{

    public function index(Request $request, KasChart $KasChart) {
        $tahunPenerimaan = Penerimaan::select('tanggal')->get();
        $tahunPengeluaran = Pengeluaran::select('tanggal')->get();

        $tahun = $request->tahun;
        if(strlen($tahun)){
            # Get jumlah Penerimaan kas perBulan
            $jumlahPenerimaanJanuari = DB::table('penerimaan')
            ->select(DB::raw('SUM(jumlah) as jumlah'))
            ->whereRaw("EXTRACT(MONTH FROM tanggal) = '1'")
            ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
            ->get();
        
            $jumlahPenerimaanFebuari = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '2'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPenerimaanMaret = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '3'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanApril = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '4'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPenerimaanMei = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '5'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanJuni = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '6'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPenerimaanJuli = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '7'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanAgustus = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '8'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanSeptember = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '9'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanOktober = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '10'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanNovember = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '11'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPenerimaanDesember = DB::table('penerimaan')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '12'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            # Get jumlah Pengeluaran kas perBulan
            $jumlahPengeluaranJanuari = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '1'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
                
            $jumlahPengeluaranFebuari = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '2'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPengeluaranMaret = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '3'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranApril = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '4'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPengeluaranMei = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '5'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranJuni = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '6'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();
            
            $jumlahPengeluaranJuli = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '7'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranAgustus = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '8'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranSeptember = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '9'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranOktober = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '10'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranNovember = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '11'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $jumlahPengeluaranDesember = DB::table('pengeluaran')
                ->select(DB::raw('SUM(jumlah) as jumlah'))
                ->whereRaw("EXTRACT(MONTH FROM tanggal) = '12'")
                ->whereRaw("EXTRACT(YEAR FROM tanggal) = $tahun")
                ->get();

            $dataPenerimaan = [
                $jumlahPenerimaanJanuari = $jumlahPenerimaanJanuari[0]->jumlah,
                $jumlahPenerimaanFebuari = $jumlahPenerimaanFebuari[0]->jumlah,
                $jumlahPenerimaanMaret = $jumlahPenerimaanMaret[0]->jumlah,
                $jumlahPenerimaanApril = $jumlahPenerimaanApril[0]->jumlah,
                $jumlahPenerimaanMei = $jumlahPenerimaanMei[0]->jumlah,
                $jumlahPenerimaanJuni = $jumlahPenerimaanJuni[0]->jumlah,
                $jumlahPenerimaanJuli = $jumlahPenerimaanJuli[0]->jumlah,
                $jumlahPenerimaanAgustus = $jumlahPenerimaanAgustus[0]->jumlah,
                $jumlahPenerimaanSeptember = $jumlahPenerimaanSeptember[0]->jumlah,
                $jumlahPenerimaanOktober = $jumlahPenerimaanOktober[0]->jumlah,
                $jumlahPenerimaanNovember = $jumlahPenerimaanNovember[0]->jumlah,
                $jumlahPenerimaanDesember = $jumlahPenerimaanDesember[0]->jumlah,
            ];

            $dataPengeluaran = [
                $jumlahPengeluaranJanuari = $jumlahPengeluaranJanuari[0]->jumlah,
                $jumlahPengeluaranFebuari = $jumlahPengeluaranFebuari[0]->jumlah,
                $jumlahPengeluaranMaret = $jumlahPengeluaranMaret[0]->jumlah,
                $jumlahPengeluaranApril = $jumlahPengeluaranApril[0]->jumlah,
                $jumlahPengeluaranMei = $jumlahPengeluaranMei[0]->jumlah,
                $jumlahPengeluaranJuni = $jumlahPengeluaranJuni[0]->jumlah,
                $jumlahPengeluaranJuli = $jumlahPengeluaranJuli[0]->jumlah,
                $jumlahPengeluaranAgustus = $jumlahPengeluaranAgustus[0]->jumlah,
                $jumlahPengeluaranSeptember = $jumlahPengeluaranSeptember[0]->jumlah,
                $jumlahPengeluaranOktober = $jumlahPengeluaranOktober[0]->jumlah,
                $jumlahPengeluaranNovember = $jumlahPengeluaranNovember[0]->jumlah,
                $jumlahPengeluaranDesember = $jumlahPengeluaranDesember[0]->jumlah,
            ];
        } else {
            $dataPenerimaan = [];
            $dataPengeluaran = [];
        }
        return view('grafik.index', compact('tahunPenerimaan', 'tahunPengeluaran'))->with('KasChart', $KasChart->build($dataPenerimaan, $dataPengeluaran, $tahun));
    }
    
}
