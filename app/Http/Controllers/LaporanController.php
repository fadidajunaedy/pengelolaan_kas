<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use App\Models\Anggota;
use Carbon\Carbon;
use Session;
use Redirect;

class LaporanController extends Controller
{
    
    //------ LAPORAN PENERIMAAN ------
    public function laporanPenerimaan() {
        $tanggalPenerimaan = Penerimaan::select('tanggal')->orderBy('tanggal')->get();
        
        return view('laporan.laporan-penerimaan', compact('tanggalPenerimaan'));
    }

    public function PenerimaanPertanggalPreview(Request $request) {
        $data = Penerimaan::where('tanggal', $request->tanggal)->orderBy('tanggal')->paginate(10);
        foreach ($data as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.penerimaan-pertanggal-preview', compact('data', 'anggotaBelumBayar'));
    }

    public function PenerimaanPerbulanPreview(Request $request) {
        $data = Penerimaan::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        foreach ($data as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.penerimaan-perbulan-preview', compact('data', 'anggotaBelumBayar'));

    }

    public function PenerimaanPertahunPreview(Request $request) {
        $data = Penerimaan::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        foreach ($data as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.penerimaan-pertahun-preview', compact('data', 'anggotaBelumBayar'));

    }

    public function GeneratePenerimaanPertanggal(Request $request) {
        $data = Penerimaan::where('tanggal', $request->tanggal)->orderBy('tanggal')->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-penerimaan-pertanggal', ['data' => $data]);
        return $pdf->download('Laporan_Perimaan_Kas_Tanggal '.$request->tanggal.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-penerimaan-pertanggal')->with(['data' => $data]);
    }

    public function GeneratePenerimaanPerbulan(Request $request) {
        $data = Penerimaan::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-penerimaan-perbulan', ['data' => $data]);
        return $pdf->download('Laporan_Penerimaan_Kas_Bulan '.$request->bulan.'_'.date('ymdhis').'.pdf');

        // return view('laporan.generate-penerimaan-perbulan')->with(['data' => $data]);
    }

    public function GeneratePenerimaanPertahun(Request $request) {
        $data = Penerimaan::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-penerimaan-pertahun', ['data' => $data]);
        return $pdf->download('Laporan_Penerimaan_Kas_Tahun '.$request->tahun.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-penerimaan-pertahun')->with(['data' => $data]);
    }
    

    //------ LAPORAN PENGELUARAN ------
    public function laporanPengeluaran() {
        $tanggalPengeluaran = Pengeluaran::select('tanggal')->orderBy('tanggal')->get();
        
        return view('laporan.laporan-pengeluaran', compact('tanggalPengeluaran'));
    }

    public function PengeluaranPertanggalPreview(Request $request) {
        $data = Pengeluaran::where('tanggal', $request->tanggal)->orderBy('tanggal')->paginate(10);
        foreach ($data as $pengeluaran) {
            $anggotaSudahBayar[] = $pengeluaran->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.pengeluaran-pertanggal-preview', compact('data', 'anggotaBelumBayar'));
    }

    public function PengeluaranPerbulanPreview(Request $request) {
        $data = Pengeluaran::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        foreach ($data as $pengeluaran) {
            $anggotaSudahBayar[] = $pengeluaran->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.pengeluaran-perbulan-preview', compact('data', 'anggotaBelumBayar'));

    }

    public function PengeluaranPertahunPreview(Request $request) {
        $data = Pengeluaran::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        foreach ($data as $pengeluaran) {
            $anggotaSudahBayar[] = $pengeluaran->nama;
        }

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        return view('laporan.pengeluaran-pertahun-preview', compact('data', 'anggotaBelumBayar'));

    }

    public function GeneratePengeluaranPertanggal(Request $request) {
        $data = Pengeluaran::where('tanggal', $request->tanggal)->orderBy('tanggal')->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-pengeluaran-pertanggal', ['data' => $data]);
        return $pdf->download('Laporan_Pengeluaran_Kas_Tanggal '.$request->tanggal.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-pengeluaran-pertanggal')->with(['data' => $data]);
    }

    public function GeneratePengeluaranPerbulan(Request $request) {
        $data = Pengeluaran::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-pengeluaran-perbulan', ['data' => $data]);
        return $pdf->download('Laporan_Pengeluaran_Kas_Bulan '.$request->bulan.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-pengeluaran-perbulan')->with(['data' => $data]);
    }

    public function GeneratePengeluaranPertahun(Request $request) {
        $data = Pengeluaran::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($data->isEmpty()) {
            return Redirect::back()->withErrors("Data tidak ditemukan");
        }

        $pdf = Pdf::loadView('laporan.generate-pengeluaran-pertahun', ['data' => $data]);
        return $pdf->download('Laporan_Pengeluaran_Kas_Tahun '.$request->tahun.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-pengeluaran-pertahun')->with(['data' => $data]);
    }

    public function laporanRekapitulasi() {
        $tanggal = Penerimaan::select('penerimaan.tanggal')
        ->join('pengeluaran', 'penerimaan.tanggal', '=', 'pengeluaran.tanggal')
        ->orderBy('penerimaan.tanggal')
        ->distinct()
        ->get();

        $tanggalPenerimaan = Penerimaan::select('penerimaan.tanggal')
        ->join('pengeluaran', function ($join) {
            $join->whereRaw('MONTH(penerimaan.tanggal) = MONTH(pengeluaran.tanggal)')
                ->whereRaw('YEAR(penerimaan.tanggal) = YEAR(pengeluaran.tanggal)');
        })
        ->orderBy('penerimaan.tanggal')
        ->distinct()
        ->get();
        
        $tanggalPengeluaran = Pengeluaran::select('tanggal')->orderBy('tanggal')->get();
        // $tanggalRekapitulasiPerbulan = DB::table('rekapitulasi')->select('tanggal')->orderBy('tanggal')->get();
        
        return view('laporan.laporan-rekapitulasi', compact('tanggal', 'tanggalPenerimaan', 'tanggalPengeluaran'));
    }

    public function RekapitulasiPertanggalPreview(Request $request) {
        $dataPenerimaan = Penerimaan::where('tanggal', $request->tanggal)->orderBy('tanggal')->paginate(10);
        $dataPengeluaran = Pengeluaran::where('tanggal', $request->tanggal)->orderBy('tanggal')->paginate(10);

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        foreach ($dataPenerimaan as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        foreach ($dataPengeluaran as $pengeluaran) {
            $anggotaSudahMelakukanPengeluaran[] = $pengeluaran->nama;
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        $anggotaBelumMelakukanPengeluaran = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahMelakukanPengeluaran)->paginate(10);

        return view('laporan.rekapitulasi-pertanggal-preview', compact('dataPenerimaan', 'dataPengeluaran', 'anggotaBelumBayar', 'anggotaBelumMelakukanPengeluaran'));
    }
    
    public function RekapitulasiPerbulanPreview(Request $request) {
        $dataPenerimaan = Penerimaan::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        $dataPengeluaran = Pengeluaran::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        foreach ($dataPenerimaan as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        foreach ($dataPengeluaran as $pengeluaran) {
            $anggotaSudahMelakukanPengeluaran[] = $pengeluaran->nama;
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        $anggotaBelumMelakukanPengeluaran = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahMelakukanPengeluaran)->paginate(10);

        return view('laporan.rekapitulasi-perbulan-preview', compact('dataPenerimaan', 'dataPengeluaran', 'anggotaBelumBayar', 'anggotaBelumMelakukanPengeluaran'));
    }

    public function RekapitulasiPertahunPreview(Request $request) {
        $dataPenerimaan = Penerimaan::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        $dataPengeluaran = Pengeluaran::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->paginate(10);

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        foreach ($dataPenerimaan as $penerimaan) {
            $anggotaSudahBayar[] = $penerimaan->nama;
        }

        foreach ($dataPengeluaran as $pengeluaran) {
            $anggotaSudahMelakukanPengeluaran[] = $pengeluaran->nama;
        }

        $anggotaBelumBayar = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahBayar)->paginate(10);
        $anggotaBelumMelakukanPengeluaran = Anggota::orderBy('created_at', 'asc')->whereNotIn('nama', $anggotaSudahMelakukanPengeluaran)->paginate(10);

        return view('laporan.rekapitulasi-pertahun-preview', compact('dataPenerimaan', 'dataPengeluaran', 'anggotaBelumBayar', 'anggotaBelumMelakukanPengeluaran'));
    }

    public function GenerateRekapitulasiPertanggal(Request $request) {
        $dataPenerimaan = Penerimaan::where('tanggal', $request->tanggal)->orderBy('tanggal')->get();

        $dataPengeluaran = Pengeluaran::where('tanggal', $request->tanggal)->orderBy('tanggal')->get();

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        $pdf = Pdf::loadView('laporan.generate-rekapitulasi-pertanggal', ['dataPenerimaan' => $dataPenerimaan, 'dataPengeluaran' => $dataPengeluaran]);
        return $pdf->download('Laporan_Rekapitulasi_Kas_Tanggal '.$request->tanggal.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-rekapitulasi-pertanggal', compact('dataPenerimaan','dataPengeluaran'));
    }

    public function GenerateRekapitulasiPerbulan(Request $request) {
        $dataPenerimaan = Penerimaan::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        $dataPengeluaran = Pengeluaran::whereMonth('tanggal', '=', date('m', strtotime($request->bulan)))
        ->whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        $pdf = Pdf::loadView('laporan.generate-rekapitulasi-perbulan', ['dataPenerimaan' => $dataPenerimaan, 'dataPengeluaran' => $dataPengeluaran]);
        return $pdf->download('Laporan_Rekapitulasi_Kas_Bulan '.$request->bulan.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-rekapitulasi-perbulan', compact('dataPenerimaan','dataPengeluaran'));
    }

    public function GenerateRekapitulasiPertahun(Request $request) {
        $dataPenerimaan = Penerimaan::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        $dataPengeluaran = Pengeluaran::whereYear('tanggal', '=', $request->tahun)
        ->orderBy('tanggal')
        ->get();

        if ($dataPenerimaan->isEmpty()) {
            return Redirect::back()->withErrors("Data penerimaan tidak ditemukan atau kosong");
        }

        if ($dataPengeluaran->isEmpty()) {
            return Redirect::back()->withErrors("Data pengeluaran tidak ditemukan atau kosong");
        }

        $pdf = Pdf::loadView('laporan.generate-rekapitulasi-pertahun', ['dataPenerimaan' => $dataPenerimaan, 'dataPengeluaran' => $dataPengeluaran]);
        return $pdf->download('Laporan_Rekapitulasi_Kas_Tahun '.$request->tahun.'_'.date('ymdhis').'.pdf');
        
        // return view('laporan.generate-rekapitulasi-pertahun', compact('dataPenerimaan','dataPengeluaran'));
    }

    
}
