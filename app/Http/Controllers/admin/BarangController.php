<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor = 1;
        $data = Barang::get();
        return view('Pages.Admin.Barang.index', ['no' => $nomor, 'data' => $data]);

        // return view('Pages.Admin.Barang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pages.Admin.Barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Barang();

        $data->id_barang = Barang::GenerateID();
        $data->nama_barang = $request->nama_barang;
        $data->tanggal_masuk = $request->tanggal_masuk;
        $data->jumlah_stok = $request->jumlah_stok;
        $data->gambar_barang = $request->gambar_barang;
        $data->save();

        return redirect('/barang');
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
        $data = Barang::where('id_barang', $id)->first();
        return view('Pages.Admin.Barang.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Barang::where('id_barang', $id)->first();

        $data->id_barang = Barang::GenerateID();
        $data->nama_barang = $request->nama_barang;
        $data->tanggal_masuk = $request->tanggal_masuk;
        $data->jumlah_stok = $request->jumlah_stok;
        $data->gambar_barang = $request->gambar_barang;
        $data->save();
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}