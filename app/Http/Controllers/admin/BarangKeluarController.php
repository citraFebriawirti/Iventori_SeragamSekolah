<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang_keluar'] = DB::table('tb_barang_keluar')->get();

        return view('pages.halaman_admin.kelola_barang_keluar.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_barang_keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_barang_keluar' => 'required',
                'jumlah_barang_keluar' => 'required',
                'tanggal_barang_keluar' => 'required',
            ],

            [
                'nama_barang_keluar.required' => 'Wajib diisi',
                'jumlah_barang_keluar.required' => 'Wajib diisi',
                'tanggal_barang_keluar.required' => 'Wajib diisi',
            ]
        );


        if ($request->hasFile('gambar_barang_keluar')) {
            $path = 'images/gambar_barang_keluar/';
            $request->file('gambar_barang_keluar')->move($path, $request->file('gambar_barang_keluar')->getClientOriginalName());

            $gambar_barang_keluar = $path . $request->file('gambar_barang_keluar')->getClientOriginalName();
        } else {

            return back()->with('error', 'Gambar harus diisi');
        }

        $create = BarangKeluar::create([
            'id_barang_keluar' => BarangKeluar::GenerateID(),
            'nama_barang_keluar' => $request->nama_barang_keluar,
            'jumlah_barang_keluar' => $request->jumlah_barang_keluar,
            'tanggal_barang_keluar' => $request->tanggal_barang_keluar,
            'gambar_barang_keluar' => $gambar_barang_keluar
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
        $data['dataById'] = DB::table('tb_barang_keluar')->where('id_barang_keluar', '=', $id)->first();

        return view('pages.halaman_admin.kelola_barang_keluar.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'nama_barang_keluar' => 'required',
                'jumlah_barang_keluar' => 'required',
                'tanggal_barang_keluar' => 'required',
            ],

            [
                'nama_barang_keluar.required' => 'Wajib diisi',
                'jumlah_barang_keluar.required' => 'Wajib diisi',
                'tanggal_barang_keluar.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_barang_keluar')->where('id_barang_keluar', '=', $id)->first();

        if ($request->hasFile('gambar_barang_keluar')) {
            $path = 'images/gambar_barang_keluar/';
            $request->file('gambar_barang_keluar')->move($path, $request->file('gambar_barang_keluar')->getClientOriginalName());

            $gambar_barang_keluar = $path . $request->file('gambar_barang_keluar')->getClientOriginalName();
        } else {
            $gambar_barang_keluar = $dataById->gambar_barang_keluar;
        }

        $update = BarangKeluar::where('id_barang_keluar', '=', $id)->update([
            'nama_barang_keluar' => $request->nama_barang_keluar,
            'jumlah_barang_keluar' => $request->jumlah_barang_keluar,
            'tanggal_barang_keluar' => $request->tanggal_barang_keluar,
            'gambar_barang_keluar' => $gambar_barang_keluar
        ]);


        if ($update) {
            return redirect()->route('barang_keluar.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('barang_keluar.index')->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (BarangKeluar::where('id_barang_keluar', '=', $id)->delete()) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
    }
}