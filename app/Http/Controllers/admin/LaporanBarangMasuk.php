<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanBarangMasuk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang_masuk'] = DB::table('tb_barang_masuk')->join('tb_barang', 'tb_barang_masuk.id_barang', '=', 'tb_barang.id_barang')->join('tb_ekspedisi', 'tb_barang_masuk.id_ekspedisi', '=', 'tb_ekspedisi.id_ekspedisi')->get();

        $data['jumlahBarangMasuk'] = DB::table('tb_barang_masuk')->sum('jumlah_barang_masuk');

        $pdf = PDF::loadview('pages.halaman_admin.laporan_barang_masuk.index', $data);
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
}
