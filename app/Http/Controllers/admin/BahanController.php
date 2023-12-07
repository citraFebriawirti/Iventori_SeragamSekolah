<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
// use Alert;


class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['bahan'] = DB::table('tb_bahan')->orderBy('id_bahan', 'desc')->get();

        return view('pages.halaman_admin.kelola_bahan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_bahan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_bahan'   => 'required'
        ], [
            'nama_bahan.required' => 'Wajib diisi'
        ]);

        $create = Bahan::create([
            'id_bahan' => Bahan::GenerateID(),
            'nama_bahan' => $request->nama_bahan
        ]);

        if ($create) {
            return back()->with('success', 'Data Berhasil Ditambahkan');
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
        $data['dataById'] = Bahan::where('id_bahan', $id)->first();

        return view('pages.halaman_admin.kelola_bahan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_bahan'   => 'required'
        ], [
            'nama_bahan.required' => 'Wajib diisi'
        ]);

        $update = Bahan::where('id_bahan', $id)->update([
            'nama_bahan' => $request->nama_bahan
        ]);

        if ($update) {
            return redirect()->route('bahan.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('bahan.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Bahan::where('id_bahan', $id)->delete()) {
            return redirect()->route('bahan.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('bahan.index')->with('error', 'Data Gagal Dihapus');
        }
    }
}
