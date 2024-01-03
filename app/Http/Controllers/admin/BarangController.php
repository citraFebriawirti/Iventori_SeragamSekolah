<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang'] = DB::table('tb_barang')->join('tb_kategori', 'tb_barang.id_kategori', '=', 'tb_kategori.id_kategori')->join('tb_gender', 'tb_barang.id_gender', '=', 'tb_gender.id_gender')->join('tb_model', 'tb_barang.id_model', '=', 'tb_model.id_model')->join('tb_busana', 'tb_barang.id_busana', '=', 'tb_busana.id_busana')->join('tb_bahan', 'tb_barang.id_bahan', '=', 'tb_bahan.id_bahan')->join('tb_ukuran', 'tb_barang.id_ukuran', '=', 'tb_ukuran.id_ukuran')->join('tb_jenis', 'tb_barang.id_jenis', '=', 'tb_jenis.id_jenis')->get();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.kelola_barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['kategori'] = DB::table('tb_kategori')->get();
        $data['gender'] = DB::table('tb_gender')->get();
        $data['model'] = DB::table('tb_model')->get();
        $data['busana'] = DB::table('tb_busana')->get();
        $data['bahan'] = DB::table('tb_bahan')->get();
        $data['ukuran'] = DB::table('tb_ukuran')->get();
        $data['jenis'] = DB::table('tb_jenis')->get();
        // $data['barang_masuk'] = DB::table('tb_barang_masuk')->get();

        return view('pages.halaman_admin.kelola_barang.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'nama_barang' => 'required',
                'jumlah_barang' => 'required',
                // 'id_barang_masuk' => 'required',
                'id_kategori' => 'required',
                'id_gender' => 'required',
                'id_model' => 'required',
                'id_busana' => 'required',
                'id_bahan' => 'required',
                'id_ukuran' => 'required',
                'id_jenis' => 'required',


            ],

            [
                'nama_barang.required' => 'Wajib diisi',
                'jumlah_barang.required' => 'Wajib diisi',
                // 'id_barang_masuk.required' => 'vvvvv Wajib diisi',
                'id_kategori.required' => 'Wajib diisi',
                'id_gender.required' => 'Wajib diisi',
                'id_model.required' => 'Wajib diisi',
                'id_busana.required' => 'Wajib diisi',
                'id_bahan.required' => 'Wajib diisi',
                'id_ukuran.required' => 'Wajib diisi',
                'id_jenis.required' => 'Wajib diisi',

            ]
        );


        if ($request->hasFile('gambar_barang')) {
            $path = 'images/gambar_barang/';
            $request->file('gambar_barang')->move($path, $request->file('gambar_barang')->getClientOriginalName());

            $gambar_barang = $path . $request->file('gambar_barang')->getClientOriginalName();
        } else {

            return back()->with('error', 'Gambar harus diisi');
        }


        $create = Barang::create([
            'id_barang' => Barang::GenerateID(),
            'id_kategori' => $request->id_kategori,
            'id_gender' => $request->id_gender,
            'id_model' => $request->id_model,
            'id_busana' => $request->id_busana,
            'id_bahan' => $request->id_bahan,
            'id_ukuran' => $request->id_ukuran,
            'id_jenis' => $request->id_jenis,
            // 'id_barang_masuk' => $request->id_barang_masuk,
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,

            'gambar_barang' => $gambar_barang
        ]);


        if ($create) {
            return redirect()->route('barang.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('barang.index')->with('error', 'Data Gagal Di Update');
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

        $data['kategori'] = DB::table('tb_kategori')->get();
        $data['gender'] = DB::table('tb_gender')->get();
        $data['model'] = DB::table('tb_model')->get();
        $data['busana'] = DB::table('tb_busana')->get();
        $data['bahan'] = DB::table('tb_bahan')->get();
        $data['ukuran'] = DB::table('tb_ukuran')->get();
        $data['jenis'] = DB::table('tb_jenis')->get();
        // $data['barang_masuk'] = DB::table('tb_barang_masuk')->get();

        $data['dataById'] = DB::table('tb_barang')->join('tb_kategori', 'tb_barang.id_kategori', '=', 'tb_kategori.id_kategori')->join('tb_gender', 'tb_barang.id_gender', '=', 'tb_gender.id_gender')->join('tb_model', 'tb_barang.id_model', '=', 'tb_model.id_model')->join('tb_busana', 'tb_barang.id_busana', '=', 'tb_busana.id_busana')->join('tb_bahan', 'tb_barang.id_bahan', '=', 'tb_bahan.id_bahan')->join('tb_ukuran', 'tb_barang.id_ukuran', '=', 'tb_ukuran.id_ukuran')->join('tb_jenis', 'tb_barang.id_jenis', '=', 'tb_jenis.id_jenis')->where('tb_barang.id_barang', $id)->first();

        return view('pages.halaman_admin.kelola_barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'nama_barang' => 'required',
                'jumlah_barang' => 'required',


            ],

            [
                'nama_barang.required' => 'Wajib diisi',
                'jumlah_barang.required' => 'Wajib diisi',


            ]
        );

        $dataById = DB::table('tb_barang')->where('id_barang', '=', $id)->first();

        if ($request->hasFile('gambar_barang')) {
            $path = 'images/gambar_barang/';
            $request->file('gambar_barang')->move($path, $request->file('gambar_barang')->getClientOriginalName());

            $gambar_barang = $path . $request->file('gambar_barang')->getClientOriginalName();
        } else {
            $gambar_barang = $dataById->gambar_barang;
        }

        $update = Barang::where('id_barang', '=', $id)->update([
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,

            'gambar_barang' => $gambar_barang
        ]);


        if ($update) {
            return redirect()->route('barang.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('barang.index')->with('error', 'Data Gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Barang::where('id_barang', '=', $id)->delete()) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
    }
}
