<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware('isLogin');

Route::get('/login', [SessionController::class, 'index'])->middleware('isGuest');
Route::post('/login', [SessionController::class, 'login']);
Route::get('/logout', [SessionController::class, 'logout']);

Route::resource('/penerimaan', PenerimaanController::class)->middleware('isLogin');
Route::resource('/pengeluaran', PengeluaranController::class)->middleware('isLogin');
Route::resource('/users', UsersController::class)->middleware('isLogin');
Route::resource('/anggota', AnggotaController::class)->middleware('isLogin');

Route::resource('/profile', ProfileController::class)->middleware('isLogin');

Route::put('/users/{id}/change-to-aktif', [UsersController::class, 'changeToAktif'])->middleware('isLogin');
Route::put('/users/{id}/change-to-non-aktif', [UsersController::class, 'changeToNonAktif'])->middleware('isLogin');

Route::get('/password', [PasswordController::class, 'index'])->middleware('isLogin');
Route::put('/password/change-password', [PasswordController::class, 'changePassword'])->middleware('isLogin');

Route::get('/grafik', [GrafikController::class, 'index'])->middleware('isLogin');
Route::get('/grafik/generateGrafik', [GrafikController::class, 'generateGrafik'])->middleware('isLogin');

Route::get('/laporan-penerimaan', [LaporanController::class, 'laporanPenerimaan'])->middleware('isLogin');
Route::get('/penerimaan-pertanggal-preview', [LaporanController::class, 'PenerimaanPertanggalPreview'])->middleware('isLogin');
Route::get('/penerimaan-perbulan-preview', [LaporanController::class, 'PenerimaanPerbulanPreview'])->middleware('isLogin');
Route::get('/penerimaan-pertahun-preview', [LaporanController::class, 'PenerimaanPertahunPreview'])->middleware('isLogin');
Route::get('/generate-penerimaan-pertanggal', [LaporanController::class, 'GeneratePenerimaanPertanggal'])->middleware('isLogin');
Route::get('/generate-penerimaan-perbulan', [LaporanController::class, 'GeneratePenerimaanPerbulan'])->middleware('isLogin');
Route::get('/generate-penerimaan-pertahun', [LaporanController::class, 'GeneratePenerimaanPertahun'])->middleware('isLogin');

Route::get('/laporan-pengeluaran', [LaporanController::class, 'laporanPengeluaran'])->middleware('isLogin');
Route::get('/pengeluaran-pertanggal-preview', [LaporanController::class, 'PengeluaranPertanggalPreview'])->middleware('isLogin');
Route::get('/pengeluaran-perbulan-preview', [LaporanController::class, 'PengeluaranPerbulanPreview'])->middleware('isLogin');
Route::get('/pengeluaran-pertahun-preview', [LaporanController::class, 'PengeluaranPertahunPreview'])->middleware('isLogin');
Route::get('/generate-pengeluaran-pertanggal', [LaporanController::class, 'GeneratePengeluaranPertanggal'])->middleware('isLogin');
Route::get('/generate-pengeluaran-perbulan', [LaporanController::class, 'GeneratePengeluaranPerbulan'])->middleware('isLogin');
Route::get('/generate-pengeluaran-pertahun', [LaporanController::class, 'GeneratePengeluaranPertahun'])->middleware('isLogin');

Route::get('/laporan-rekapitulasi', [LaporanController::class, 'laporanRekapitulasi'])->middleware('isLogin');
Route::get('/rekapitulasi-pertanggal-preview', [LaporanController::class, 'RekapitulasiPertanggalPreview'])->middleware('isLogin');
Route::get('/rekapitulasi-perbulan-preview', [LaporanController::class, 'RekapitulasiPerbulanPreview'])->middleware('isLogin');
Route::get('/rekapitulasi-pertahun-preview', [LaporanController::class, 'RekapitulasiPertahunPreview'])->middleware('isLogin');
Route::get('/generate-rekapitulasi-pertanggal', [LaporanController::class, 'GenerateRekapitulasiPertanggal'])->middleware('isLogin');
Route::get('/generate-rekapitulasi-perbulan', [LaporanController::class, 'GenerateRekapitulasiPerbulan'])->middleware('isLogin');
Route::get('/generate-rekapitulasi-pertahun', [LaporanController::class, 'GenerateRekapitulasiPertahun'])->middleware('isLogin');
