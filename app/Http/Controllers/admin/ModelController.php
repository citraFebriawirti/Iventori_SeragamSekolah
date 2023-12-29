<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['model'] = DB::table('tb_model')->orderBy('id_model', 'desc')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_model.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_model.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_model'   => 'required'
        ], [
            'nama_model.required' => 'Wajib diisi'
        ]);

        $create = Models::create([
            'id_model' => Models::GenerateID(),
            'nama_model' => $request->nama_model
        ]);

        if ($create) {
            return redirect()->route('model.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('model.index')->with('error', 'Data Gagal Diubah');
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
        $data['dataById'] = Models::where('id_model', $id)->first();

        return view('pages.halaman_admin.kelola_model.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_model'   => 'required'
        ], [
            'nama_model.required' => 'Wajib diisi'
        ]);

        $update = Models::where('id_model', $id)->update([
            'nama_model' => $request->nama_model
        ]);

        if ($update) {
            return redirect()->route('model.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('model.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $countBarang = Barang::where('id_model', $id)->count();

        if ($countBarang > 0) {
            return redirect()->back()->with('error', 'Tidak Bisa Dihapus Karena Data Sudah Digunakan');
        } else {
            if (Models::where('id_model', $id)->delete()) {
                return redirect()->route('model.index')->with('success', 'Data Berhasil Dihapus');
            } else {
                return redirect()->route('model.index')->with('error', 'Data Gagal Dihapus');
            }
        }
    }
}
