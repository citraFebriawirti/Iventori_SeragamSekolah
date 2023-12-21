<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JenisController extends Controller
{
    public function index()
    {
        $data['jenis'] = DB::table('tb_jenis')->orderBy('id_jenis', 'desc')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_jenis.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_jenis'   => 'required'
        ], [
            'nama_jenis.required' => 'Wajib diisi'
        ]);

        $create = Jenis::create([
            'id_jenis' => Jenis::GenerateID(),
            'nama_jenis' => $request->nama_jenis
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
        $data['dataById'] = Jenis::where('id_jenis', $id)->first();

        return view('pages.halaman_admin.kelola_jenis.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_jenis'   => 'required'
        ], [
            'nama_jenis.required' => 'Wajib diisi'
        ]);

        $update = Jenis::where('id_jenis', $id)->update([
            'nama_jenis' => $request->nama_jenis
        ]);

        if ($update) {
            return redirect()->route('jenis.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('jenis.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Jenis::where('id_jenis', $id)->delete()) {
            return redirect()->route('jenis.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('jenis.index')->with('error', 'Data Gagal Dihapus');
        }
    }
}
