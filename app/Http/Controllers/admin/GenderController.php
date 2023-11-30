<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['gender'] = DB::table('tb_gender')->orderBy('id_gender', 'desc')->get();

        return view('pages.halaman_admin.kelola_gender.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_gender.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_gender'   => 'required'
        ], [
            'nama_gender.required' => 'Wajib diisi'
        ]);

        $create = Gender::create([
            'id_gender' => Gender::GenerateID(),
            'nama_gender' => $request->nama_gender
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
        $data['dataById'] = Gender::where('id_gender', $id)->first();

        return view('pages.halaman_admin.kelola_gender.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_gender'   => 'required'
        ], [
            'nama_gender.required' => 'Wajib diisi'
        ]);

        $update = Gender::where('id_gender', $id)->update([
            'nama_gender' => $request->nama_gender
        ]);

        if ($update) {
            return redirect()->route('gender.index')->with('success', 'Data Berhasil Diubah');
        } else {
            return redirect()->route('gender.index')->with('error', 'Data Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gender::where('id_gender', $id)->delete()) {
            return redirect()->route('gender.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('gender.index')->with('error', 'Data Gagal Dihapus');
        }
    }
}