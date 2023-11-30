<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BarangController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\BahanController;
use App\Http\Controllers\admin\GenderController;
use App\Http\Controllers\admin\UkuranController;
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


Route::resources([
    'dashboard' => DashboardController::class,
    'barang' => BarangController::class,
    // 'ekspedisi' => EkspedisiController::class,
     'admin' => AdminController::class,
     'bahan' => BahanController::class,
     'gender' => GenderController::class,
     'ukuran' => UkuranController::class,
    
     
]);