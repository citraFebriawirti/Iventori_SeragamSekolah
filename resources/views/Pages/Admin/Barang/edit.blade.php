@extends('Layouts.Admin.layout')
@section('content')
<div>
    <div>
        <h1>Form Ubah Data</h1>
        <form action="{{route('barang.update',$data->id_barang)}}" method="post" enctype="multipart/form-data">
        @csrf 
        @method('PUT')
        </div>
         <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label">Nama Barang</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_barang" value="{{$data->nama_barang}}" required>
        </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" name="tanggal_masuk" value="{{$data->tanggal_masuk}}" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Jumlah Stok</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="jumlah_stok" value="{{$data->jumlah_stok}}" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="gambar_barang" value="{{$data->gambar_barang}}" required>
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
    
</div>
@endsection