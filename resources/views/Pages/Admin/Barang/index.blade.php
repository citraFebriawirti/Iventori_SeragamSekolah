@extends('Layouts.Admin.layout')
@section('content')
<div>
   
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Daftar Matakuliah</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="/barang/create">
                    <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" type="submit">Tambah Data</button>
                </a>
            </div>
        </div>
    </div>
    
    <table class="table table-bordered table-hover">
     <tr>
         <td style="width: 10px">No</td>
         <td class="text-center fw-semibold">Nama Barang</td>
         <td class="text-center fw-semibold">Tanggal Masuk</td>
         <td class="text-center fw-semibold">Jumlah Stok</td>
         <td class="text-center fw-semibold">Gambar</td>
         <td class="text-center fw-semibold" style="width: 150px">Aksi</td>
     </tr>
     @foreach ($data as $baris)
    <tr>
     <td>{{$no++}}</td>
     <td>{{$baris->nama_barang}}</td>
     <td>{{$baris->tanggal_masuk}}</td>
     <td>{{$baris->jumlah_stok}}</td>
     
    
     <td class="w-25 text-center align-middle"><img src="{{ asset("$baris->gambar_barang") }}" class="img-thumbnail w-50 mx-auto p-3" ></td>
     <td class="text-center">
        <a href="/barang/{{$baris->id_barang}}/edit" data-bs-title="Ubah Data"><button type="submit" class="btn btn-warning btn-sm">Ubah</button></a>

        <form action="/barang/{{$baris->id_barang}}" method="post" style="display: inline-block">
        @csrf
        @method("DELETE")
        <button class="btn btn-danger btn-sm" data-bs-title="toottip" data-bs-placement="left" onclick="return cofirm('apakah anda yakin untuk menghapus data ?')">Hapus</button>
        </form>
     </td>
    </tr>
     @endforeach 
    </table>
</div>

    
@endsection