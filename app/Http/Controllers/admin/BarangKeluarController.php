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
        $data['barang_keluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->get();
        return view('pages.halaman_admin.kelola_barang_keluar.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['barang'] = DB::table('tb_barang')->get();
        return view('pages.halaman_admin.kelola_barang_keluar.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'id_barang' => 'required',
                'jumlah_barang_keluar' => 'required',
                'tanggal_barang_keluar' => 'required',
            ],

            [
                'id_barang.required' => 'Wajib diisi',
                'jumlah_barang_keluar.required' => 'Wajib diisi',
                'tanggal_barang_keluar.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_barang')->where('id_barang', $request->id_barang)->first();
        if ($dataById) {
            $jumlah_barang = $dataById->jumlah_barang - $request->jumlah_barang_keluar;

            DB::table('tb_barang')->where('id_barang', $request->id_barang)->update([
                'jumlah_barang' => $jumlah_barang
            ]);
        }



        $create = BarangKeluar::create([
            'id_barang_keluar' => BarangKeluar::GenerateID(),
            'id_barang' => $request->id_barang,
            'jumlah_barang_keluar' => $request->jumlah_barang_keluar,
            'tanggal_barang_keluar' => $request->tanggal_barang_keluar,

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
        $data['barang'] = DB::table('tb_barang')->get();

        $data['barang_keluar'] = DB::table('tb_barang_keluar')->join('tb_barang', 'tb_barang_keluar.id_barang', '=', 'tb_barang.id_barang')->where('tb_barang_keluar.id_barang_keluar', $id)->first();

        return view('pages.halaman_admin.kelola_barang_keluar.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'id_barang' => 'required',
                'jumlah_barang_keluar' => 'required',
                'tanggal_barang_keluar' => 'required',
            ],

            [
                'id_barang.required' => 'Wajib diisi',
                'jumlah_barang_keluar.required' => 'Wajib diisi',
                'tanggal_barang_keluar.required' => 'Wajib diisi',
            ]
        );

        $dataBarangMasukOld = DB::table('tb_barang_keluar')->where('id_barang_keluar', '=', $id)->first();
        $dataById = DB::table('tb_barang')->where('id_barang', '=', $request->id_barang)->first();

        if ($dataById) {
            $jumlahBarangOld = $dataById->jumlah_barang - $dataBarangMasukOld->jumlah_barang_keluar;

            $jumlah_barang = $jumlahBarangOld - $request->jumlah_barang_keluar;

            $updateBarang = DB::table('tb_barang')->where('id_barang', $request->id_barang)->update([
                'jumlah_barang' => $jumlah_barang
            ]);
        };


        $update = BarangKeluar::where('id_barang_keluar', '=', $id)->update([
            'id_barang' => $request->id_barang,
            'jumlah_barang_keluar' => $request->jumlah_barang_keluar,
            'tanggal_barang_keluar' => $request->tanggal_barang_keluar,

        ]);


        if ($update && $updateBarang) {
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
