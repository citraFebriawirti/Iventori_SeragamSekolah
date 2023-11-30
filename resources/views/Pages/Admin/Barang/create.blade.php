@extends('Layouts.Admin.layout')
@section('content')
<div>
    <h1>Form Tambah Data</h1>
    <form action="/barang" method="post" enctype="multipart/form-data">
    @csrf 

    <div class="mb-3 row">
        <label for="" class="col-sm-2 cool-form-lavel">Nama Barang </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_barang" required>
        </div>

    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 cool-form-lavel">Tanggal Masuk</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="tanggal_masuk" required>
        </div>

    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 cool-form-lavel">Jumlah Stok</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="jumlah_stok" required>
        </div>

    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 cool-form-lavel">Gambar</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="gambar_barang" required>

        </div>

    </div>
    <div class="mb-3 row">
       <div class="col-sm-12">
        <a href="/barang"><button type="button" class="btn btn-secondary btn-sm">Kembali</button></a>
        <button type="submit" value="Simpan" class="btn btn-primary btn-sm">Simpan</button>
       </div>

    </div>
</form>
</div>
@endsection
