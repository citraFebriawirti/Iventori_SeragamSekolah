<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['kategori'] = DB::table('tb_kategori')->count();
        $data['gender'] = DB::table('tb_gender')->count();
        $data['model'] = DB::table('tb_model')->count();
        $data['busana'] = DB::table('tb_busana')->count();
        $data['bahan'] = DB::table('tb_bahan')->count();
        $data['ukuran'] = DB::table('tb_ukuran')->count();
        $data['jenis'] = DB::table('tb_jenis')->count();
        $data['barang'] = DB::table('tb_barang')->count();
        $data['barang_masuk'] = DB::table('tb_barang_masuk')->count();
        $data['barang_keluar'] = DB::table('tb_barang_keluar')->count();
        $data['admin'] = DB::table('tb_admin')->count();
        $data['ekspedisi'] = DB::table('tb_ekspedisi')->count();

        if (!Session::get('id')) {

            return redirect()->route('login')->with('tidak_login', 'login');
        }

        return view('pages.halaman_admin.dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
