<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UkuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['ukuran'] = DB::table('tb_ukuran')->orderBy('id_ukuran', 'desc')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_ukuran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_ukuran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_ukuran'   => 'required'
        ], [
            'nama_ukuran.required' => 'Wajib diisi'
        ]);

        $create = Ukuran::create([
            'id_ukuran' => Ukuran::GenerateID(),
            'nama_ukuran' => $request->nama_ukuran
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
        $data['dataById'] = Ukuran::where('id_ukuran', $id)->first();

        return view('pages.halaman_admin.kelola_ukuran.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_ukuran'   => 'required'
        ], [
            'nama_ukuran.required' => 'Wajib diisi'
        ]);

        $update = Ukuran::where('id_ukuran', $id)->update([
            'nama_ukuran' => $request->nama_ukuran
        ]);

        if ($update) {
            return redirect()->route('ukuran.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('ukuran.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Ukuran::where('id_ukuran', $id)->delete()) {
            return redirect()->route('ukuran.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('ukuran.index')->with('error', 'Data Gagal Dihapus');
        }
    }
}
