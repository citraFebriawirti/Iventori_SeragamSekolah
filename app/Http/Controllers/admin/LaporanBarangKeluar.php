<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class LaporanBarangKeluar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang_keluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        $data['jumlahBarangKeluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->sum('jumlah_barang_keluar');


        $data['hargaBarangKeluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->sum('harga_barang_masuk');

        $pdf = PDF::loadview('pages.halaman_admin.laporan_barang_keluar.index', $data);
        return $pdf->stream();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filterBarangKeluarTanggal($tanggal_awal, $tanggal_akhir)
    {
        $data['barang_keluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->where('tb_barang_keluar.tanggal_barang_keluar', '<=', $tanggal_akhir)->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        $data['jumlahBarangKeluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->where('tb_barang_keluar.tanggal_barang_keluar', '<=', $tanggal_akhir)->sum('jumlah_barang_keluar');

        $data['hargaBarangKeluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->where('tb_barang_keluar.tanggal_barang_keluar', '<=', $tanggal_akhir)->sum('harga_barang_masuk');

        $pdf = PDF::loadview('pages.halaman_admin.laporan_barang_keluar.index', $data);
        return $pdf->stream();
    }
}
