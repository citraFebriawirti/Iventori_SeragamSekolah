<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang_masuk'] = DB::table('tb_barang_masuk')->get();

        return view('pages.halaman_admin.kelola_barang_masuk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_barang_masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_barang_masuk' => 'required',
                'jumlah_barang_masuk' => 'required',
                'tanggal_barang_masuk' => 'required',
            ],

            [
                'nama_barang_masuk.required' => 'Wajib diisi',
                'jumlah_barang_masuk.required' => 'Wajib diisi',
                'tanggal_barang_masuk.required' => 'Wajib diisi',
            ]
        );


        if ($request->hasFile('gambar_barang_masuk')) {
            $path = 'images/gambar_barang_masuk/';
            $request->file('gambar_barang_masuk')->move($path, $request->file('gambar_barang_masuk')->getClientOriginalName());

            $gambar_barang_masuk = $path . $request->file('gambar_barang_masuk')->getClientOriginalName();
        } else {

            return back()->with('error', 'Gambar harus diisi');
        }

        $create = BarangMasuk::create([
            'id_barang_masuk' => BarangMasuk::GenerateID(),
            'nama_barang_masuk' => $request->nama_barang_masuk,
            'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
            'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
            'gambar_barang_masuk' => $gambar_barang_masuk
        ]);


        if ($create) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
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
        $data['dataById'] = DB::table('tb_barang_masuk')->where('id_barang_masuk', '=', $id)->first();

        return view('pages.halaman_admin.kelola_barang_masuk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'nama_barang_masuk' => 'required',
                'jumlah_barang_masuk' => 'required',
                'tanggal_barang_masuk' => 'required',
            ],

            [
                'nama_barang_masuk.required' => 'Wajib diisi',
                'jumlah_barang_masuk.required' => 'Wajib diisi',
                'tanggal_barang_masuk.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_barang_masuk')->where('id_barang_masuk', '=', $id)->first();

        if ($request->hasFile('gambar_barang_masuk')) {
            $path = 'images/gambar_barang_masuk/';
            $request->file('gambar_barang_masuk')->move($path, $request->file('gambar_barang_masuk')->getClientOriginalName());

            $gambar_barang_masuk = $path . $request->file('gambar_barang_masuk')->getClientOriginalName();
        } else {
            $gambar_barang_masuk = $dataById->gambar_barang_masuk;
        }

        $update = BarangMasuk::where('id_barang_masuk', '=', $id)->update([
            'nama_barang_masuk' => $request->nama_barang_masuk,
            'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
            'tanggal_barang_masuk' => $request->tanggal_barang_masuk,
            'gambar_barang_masuk' => $gambar_barang_masuk
        ]);


        if ($update) {
            return redirect()->route('barang_masuk.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('barang_masuk.index')->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (BarangMasuk::where('id_barang_masuk', '=', $id)->delete()) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
    }
}