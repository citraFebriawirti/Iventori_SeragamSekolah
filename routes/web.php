<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\BahanController;
use App\Http\Controllers\admin\BarangKeluarController;
use App\Http\Controllers\admin\BarangMasukController;
use App\Http\Controllers\admin\BusanaController;
use App\Http\Controllers\admin\EkspedisiController;
use App\Http\Controllers\admin\GenderController;
use App\Http\Controllers\admin\JenisController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\LaporanBarangMasuk;
use App\Http\Controllers\admin\LaporanBarangKeluar;
use App\Http\Controllers\admin\ModelController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\UkuranController;
use App\Http\Controllers\AuthController;
use App\Models\Barang;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('registerProcces', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('register', 'loginProcces')->name('login.procces');
    Route::get('logout', 'logout')->name('logout');
});




Route::resources([
    'profile' => ProfileController::class,
    'dashboard' => DashboardController::class,
    'barang' => BarangController::class,
    'admin' => AdminController::class,
    'bahan' => BahanController::class,
    'gender' => GenderController::class,
    'ukuran' => UkuranController::class,
    'barang_masuk' => BarangMasukController::class,
    'barang_keluar' => BarangKeluarController::class,
    'ekspedisi' => EkspedisiController::class,
    'busana' => BusanaController::class,
    'jenis' => JenisController::class,
    'kategori' => KategoriController::class,
    'model' => ModelController::class,
    'laporanbarangmasuk' => LaporanBarangMasuk::class,
    'laporanbarangkeluar' => LaporanBarangKeluar::class,

]);

Route::post('filterBarangMasuk', [BarangMasukController::class, 'filterBarangMasuk'])->name('filterBarangMasuk');

Route::get('filterBarangMasukTanggal/{tanggal_awal}/{tanggal_akhir}', [LaporanBarangMasuk::class, 'filterBarangMasukTanggal']);

Route::post('filterBarangKeluar', [BarangKeluarController::class, 'filterBarangKeluar'])->name('filterBarangKeluar');

Route::get('filterBarangKeluarTanggal/{tanggal_awal}/{tanggal_akhir}', [LaporanBarangKeluar::class, 'filterBarangKeluarTanggal']);