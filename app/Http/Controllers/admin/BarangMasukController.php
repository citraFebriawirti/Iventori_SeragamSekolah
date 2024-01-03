<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['barang_masuk'] = DB::table('tb_barang_masuk')->join('tb_barang', 'tb_barang_masuk.id_barang', '=', 'tb_barang.id_barang')->join('tb_ekspedisi', 'tb_barang_masuk.id_ekspedisi', '=', 'tb_ekspedisi.id_ekspedisi')->get();

        $data['filter'] = 'false';

        return view('pages.halaman_admin.kelola_barang_masuk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['barang'] = DB::table('tb_barang')->get();
        $data['ekspedisi'] = DB::table('tb_ekspedisi')->get();
        return view('pages.halaman_admin.kelola_barang_masuk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate(
            [
                'id_barang' => 'required',
                'id_ekspedisi' => 'required',

                'jumlah_barang_masuk' => 'required',
                'harga_barang_masuk' => 'required',
                'tanggal_barang_masuk' => 'required',
            ],

            [
                'id_barang.required' => 'Wajib diisi',
                'id_ekspedisi.required' => 'Wajib diisi',
                'harga_barang_masuk.required' => 'vvv diisi',
                'jumlah_barang_masuk.required' => 'Wajib diisi',
                'tanggal_barang_masuk.required' => 'Wajib diisi',
            ]
        );

        $dataById = DB::table('tb_barang')->where('id_barang', $request->id_barang)->first();
        if ($dataById) {
            $jumlah_barang = $dataById->jumlah_barang + $request->jumlah_barang_masuk;

            DB::table('tb_barang')->where('id_barang', $request->id_barang)->update([
                'jumlah_barang' => $jumlah_barang
            ]);
        }
        $create = BarangMasuk::create([
            'id_barang_masuk' => BarangMasuk::GenerateID(),
            'id_barang' => $request->id_barang,
            'id_ekspedisi' => $request->id_ekspedisi,

            'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
            'harga_barang_masuk' => $request->harga_barang_masuk,
            'tanggal_barang_masuk' => $request->tanggal_barang_masuk,

        ]);


        if ($create) {
            return redirect()->route('barang_masuk.index')->with('success', 'Data Berhasil Di Update');
        } else {
            return redirect()->route('barang_masuk.index')->with('error', 'Data Gagal Di Update');
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

        $data['barang'] = DB::table('tb_barang')->get();
        $data['ekspedisi'] = DB::table('tb_ekspedisi')->get();

        $data['dataById'] = DB::table('tb_barang_masuk')->join('tb_barang', 'tb_barang_masuk.id_barang', '=', 'tb_barang.id_barang')->join('tb_ekspedisi', 'tb_barang_masuk.id_ekspedisi', '=', 'tb_ekspedisi.id_ekspedisi')->where('tb_barang_masuk.id_barang_masuk', $id)->first();

        return view('pages.halaman_admin.kelola_barang_masuk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate(
            [
                'id_barang' => 'required',
                'id_ekspedisi' => 'required',
                'jumlah_barang_masuk' => 'required',
                'harga_barang_masuk' => 'required',
                'tanggal_barang_masuk' => 'required',
            ],

            [
                'id_barang.required' => 'Wajib diisi',
                'id_ekspedisi.required' => 'Wajib diisi',
                'jumlah_barang_masuk.required' => 'Wajib diisi',
                'harga_barang_masuk.required' => 'Wajib diisi',
                'tanggal_barang_masuk.required' => 'Wajib diisi',
            ]
        );

        $dataBarangMasukOld = DB::table('tb_barang_masuk')->where('id_barang_masuk', '=', $id)->first();
        $dataById = DB::table('tb_barang')->where('id_barang', '=', $request->id_barang)->first();

        if ($dataById) {
            $jumlahBarangOld = $dataById->jumlah_barang - $dataBarangMasukOld->jumlah_barang_masuk;

            $jumlah_barang = $jumlahBarangOld + $request->jumlah_barang_masuk;

            $updateBarang = DB::table('tb_barang')->where('id_barang', $request->id_barang)->update([
                'jumlah_barang' => $jumlah_barang
            ]);

            $update = BarangMasuk::where('id_barang_masuk', '=', $id)->update([
                'id_barang' => $request->id_barang,
                'id_ekspedisi' => $request->id_ekspedisi,
                'jumlah_barang_masuk' => $request->jumlah_barang_masuk,
                'harga_barang_masuk' => $request->harga_barang_masuk,
                'tanggal_barang_masuk' => $request->tanggal_barang_masuk,

            ]);

            if ($update && $updateBarang) {
                return redirect()->route('barang_masuk.index')->with('success', 'Data Berhasil Di Update');
            } else {
                return redirect()->route('barang_masuk.index')->with('error', 'Data Gagal Di Update');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (BarangMasuk::where('id_barang_masuk', '=', $id)->delete()) {
            return back()->with('success', 'Data Berhasil');
        } else {
            return back()->with('error', 'Data Gagal Ditambahkan');
        }
    }


    public function filterBarangMasuk(Request $request)
    {

        $data['filter'] = 'true';

        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $data['tanggal_awal'] = $request->input('tanggal_awal');
        $data['tanggal_akhir'] = $request->input('tanggal_akhir');


        $data['barang_masuk'] = DB::table('tb_barang_masuk')->join('tb_barang', 'tb_barang_masuk.id_barang', '=', 'tb_barang.id_barang')->join('tb_ekspedisi', 'tb_barang_masuk.id_ekspedisi', '=', 'tb_ekspedisi.id_ekspedisi')->where('tb_barang_masuk.tanggal_barang_masuk', '>=', $tanggal_awal)->where('tb_barang_masuk.tanggal_barang_masuk', '<=', $tanggal_akhir)->get();

        return view('pages.halaman_admin.kelola_barang_masuk.index', $data);
    }
}
