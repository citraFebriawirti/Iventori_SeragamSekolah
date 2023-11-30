<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['admin'] = DB::table('tb_admin')->get();

        return view('pages.halaman_admin.kelola_admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_admin' => 'required',
                'alamat_admin' => 'required',
                'no_hp_admin' => 'required',
            ],

            [
                'nama_admin.required' => 'Wajib diisi',
                'alamat_admin.required' => 'Wajib diisi',
                'no_hp_admin.required' => 'Wajib diisi',
            ]
        );


        if ($request->hasFile('gambar_admin')) {
            $path = 'images/gambar_admin/';
            $request->file('gambar_admin')->move($path, $request->file('gambar_admin')->getClientOriginalName());

            $gambar_admin = $path . $request->file('gambar_admin')->getClientOriginalName();
        } else {

            return back()->with('error', 'Gambar harus diisi');
        }

        $create = Admin::create([
            'id_admin' => Admin::GenerateID(),
            'nama_admin' => $request->nama_admin,
            'alamat_admin' => $request->alamat_admin,
            'no_hp_admin' => $request->no_hp_admin,
            'gambar_admin' => $gambar_admin
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
        $data['dataById'] = DB::table('tb_admin')->where('id_admin', '=', $id)->first();

        return view('pages.halaman_admin.kelola_admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'nama_admin' => 'required',
                'alamat_admin' => 'required',
                'no_hp_admin' => 'required',
            ],

            [
                'nama_admin.required' => 'Wajib diisi',
                'alamat_admin.required' => 'Wajib diisi',
                'no_hp_admin.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_admin')->where('id_admin', '=', $id)->first();

        if ($request->hasFile('gambar_admin')) {
            $path = 'images/gambar_admin/';
            $request->file('gambar_admin')->move($path, $request->file('gambar_admin')->getClientOriginalName());

            $gambar_admin = $path . $request->file('gambar_admin')->getClientOriginalName();
        } else {
            $gambar_admin = $dataById->gambar_admin;
        }

        $update = Admin::where('id_admin', '=', $id)->update([
            'nama_admin' => $request->nama_admin,
            'alamat_admin' => $request->alamat_admin,
            'no_hp_admin' => $request->no_hp_admin,
            'gambar_admin' => $gambar_admin
        ]);


        if ($update) {
            return redirect()->route('admin.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('admin.index')->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Admin::where('id_admin', '=', $id)->delete()) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
    }
}