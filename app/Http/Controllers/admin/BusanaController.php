<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Busana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BusanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['busana'] = DB::table('tb_busana')->orderBy('id_busana', 'desc')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_busana.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_busana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_busana'   => 'required'
        ], [
            'nama_busana.required' => 'Wajib diisi'
        ]);

        $create = Busana::create([
            'id_busana' => Busana::GenerateID(),
            'nama_busana' => $request->nama_busana
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
        $data['dataById'] = Busana::where('id_busana', $id)->first();

        return view('pages.halaman_admin.kelola_busana.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_busana'   => 'required'
        ], [
            'nama_busana.required' => 'Wajib diisi'
        ]);

        $update = Busana::where('id_busana', $id)->update([
            'nama_busana' => $request->nama_busana
        ]);

        if ($update) {
            return redirect()->route('busana.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('busana.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Busana::where('id_busana', $id)->delete()) {
            return redirect()->route('busana.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('busana.index')->with('error', 'Data Gagal Dihapus');
        }
    }
}
