<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategori'] = DB::table('tb_kategori')->orderBy('id_kategori', 'desc')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_kategori'   => 'required'
        ], [
            'nama_kategori.required' => 'Wajib diisi'
        ]);

        $create = Kategori::create([
            'id_kategori' => Kategori::GenerateID(),
            'nama_kategori' => $request->nama_kategori
        ]);

        if ($create) {
            return redirect()->route('kategori.index')->with('success', 'Data Berhasil Di Ditambahkan');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data Gagal Ditambahkan');
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
        $data['dataById'] = Kategori::where('id_kategori', $id)->first();

        return view('pages.halaman_admin.kelola_kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_kategori'   => 'required'
        ], [
            'nama_kategori.required' => 'Wajib diisi'
        ]);

        $update = Kategori::where('id_kategori', $id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        if ($update) {
            return redirect()->route('kategori.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menggunakan count untuk memeriksa jumlah data yang menggunakan kategori
        $countBarang = Barang::where('id_kategori', $id)->count();

        if ($countBarang > 0) {
            return redirect()->back()->with('error', 'Tidak Bisa Dihapus Karena Data Sudah Digunakan');
        } else {
            // Menghapus kategori jika tidak digunakan oleh barang
            if (Kategori::where('id_kategori', $id)->delete()) {
                return redirect()->route('kategori.index')->with('success', 'Data Berhasil Dihapus');
            } else {
                return redirect()->route('kategori.index')->with('error', 'Data Gagal Dihapus');
            }
        }
    }
}
