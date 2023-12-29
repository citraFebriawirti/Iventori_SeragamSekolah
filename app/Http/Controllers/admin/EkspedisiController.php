<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['ekspedisi'] = DB::table('tb_ekspedisi')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_ekspedisi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.halaman_admin.kelola_ekspedisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validasi = $request->validate(
            [
                'nama_ekspedisi' => 'required',
                'alamat_ekspedisi' => 'required',
                'no_hp_ekspedisi' => 'required',
            ],

            [
                'nama_ekspedisi.required' => 'Wajib diisi',
                'alamat_ekspedisi.required' => 'Wajib diisi',
                'no_hp_ekspedisi.required' => 'Wajib diisi',
            ]
        );


        if ($request->hasFile('gambar_ekspedisi')) {
            $path = 'images/gambar_ekspedisi/';
            $request->file('gambar_ekspedisi')->move($path, $request->file('gambar_ekspedisi')->getClientOriginalName());

            $gambar_ekspedisi = $path . $request->file('gambar_ekspedisi')->getClientOriginalName();
        } else {

            return back()->with('error', 'Gambar harus diisi');
        }

        $create = Ekspedisi::create([
            'id_ekspedisi' => Ekspedisi::GenerateID(),
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'alamat_ekspedisi' => $request->alamat_ekspedisi,
            'no_hp_ekspedisi' => $request->no_hp_ekspedisi,
            'gambar_ekspedisi' => $gambar_ekspedisi
        ]);


        if ($create) {
            return redirect()->route('ekspedisi.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('ekspedisi.index')->with('error', 'Data Gagal Di Update');
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

        $data['dataById'] = DB::table('tb_ekspedisi')->where('id_ekspedisi', '=', $id)->first();

        return view('pages.halaman_admin.kelola_ekspedisi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validasi = $request->validate(
            [
                'nama_ekspedisi' => 'required',
                'alamat_ekspedisi' => 'required',
                'no_hp_ekspedisi' => 'required',
            ],

            [
                'nama_ekspedisi.required' => 'Wajib diisi',
                'alamat_ekspedisi.required' => 'Wajib diisi',
                'no_hp_ekspedisi.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_ekspedisi')->where('id_ekspedisi', '=', $id)->first();

        if ($request->hasFile('gambar_ekspedisi')) {
            $path = 'images/gambar_ekspedisi/';
            $request->file('gambar_ekspedisi')->move($path, $request->file('gambar_ekspedisi')->getClientOriginalName());

            $gambar_ekspedisi = $path . $request->file('gambar_ekspedisi')->getClientOriginalName();
        } else {
            $gambar_ekspedisi = $dataById->gambar_ekspedisi;
        }

        $update = Ekspedisi::where('id_ekspedisi', '=', $id)->update([
            'nama_ekspedisi' => $request->nama_ekspedisi,
            'alamat_ekspedisi' => $request->alamat_ekspedisi,
            'no_hp_ekspedisi' => $request->no_hp_ekspedisi,
            'gambar_ekspedisi' => $gambar_ekspedisi
        ]);


        if ($update) {
            return redirect()->route('ekspedisi.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('ekspedisi.index')->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $countBarangMasuk = BarangMasuk::where('id_ekspedisi', $id)->count();

        if ($countBarangMasuk > 0) {
            return redirect()->back()->with('error', 'Tidak Bisa Dihapus Karena Data Sudah Digunakan');
        } else {
            if (Ekspedisi::where('id_ekspedisi', '=', $id)->delete()) {
                return back()->with('success', 'Data Berhasil');
            } else {
                return back()->with('error', 'Data Gagal Ditambahkan');
            }
        }
    }
}