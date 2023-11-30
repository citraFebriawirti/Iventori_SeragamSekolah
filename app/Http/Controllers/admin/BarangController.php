<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor = 1;
        $data = Barang::OrderBy('id_barang','Desc')->get();
        return view('pages.halaman_admin.kelola_barang.index', ['no' => $nomor, 'data' => $data]);

        // return view('Pages.Admin.Barang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.halaman_admin.kelola_barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jumlah_stok' => 'required',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for image file
        ]);

        if ($validator->fails()) {
            return redirect('/barang')
                ->withErrors($validator)
                ->withInput();
        }

        $tujuan_upload = ''; // Inisialisasi variabel
        $nama_file = '';

        if ($request->file('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'images/gambar_barang/';
            $file->move($tujuan_upload, $nama_file);
        }


        $data = new Barang;
        $data->nama_barang = $request->nama_barang;
        $data->jumlah_stok = $request->jumlah_stok;
        $data->gambar_barang = $tujuan_upload . $nama_file;
        $data->save();

        if ($data) {
            return redirect('/barang');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Barang::where('id_barang', $id)->first();
        return view('pages.halaman_admin.kelola_barang.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jumlah_stok' => 'required',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation for image file
        ]);


        $data = Barang::where('id_barang', $id)->first();


        if (!$data) {
            return redirect('/barang')->with('error', 'Barang not found');
        }

        // $data->fill($request->except('gambar_barang'));

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'images/gambar_barang/';
            $file->move($tujuan_upload, $nama_file);

            $gambar_barang = $tujuan_upload . $nama_file;
        } else {
            $gambar_barang = $data->gambar_barang;
        }

        $updateBarang = Barang::where('id_barang', $id)->update([
            'nama_barang' => $request->nama_barang,
            'jumlah_stok' => $request->jumlah_stok,
            'gambar_barang' => $gambar_barang,
        ]);



        if ($updateBarang) {
            return redirect('/barang');
        } else {
            return "gagal";
        }
    }




    public function destroy(string $id)
    {
        $data = Barang::where('id_barang', $id)->first();
        storage::delete("images/gambar_barang/$data->gambar_barang");
        Barang::where('id_barang', $id)->delete();
        return redirect('/barang');
    }
}