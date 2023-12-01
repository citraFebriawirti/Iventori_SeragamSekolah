<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

     // mengcustom table ke database agar tidak rancu
     protected $table = 'tb_barang_masuk';

     // mendeskripsi table ke database
     protected $fillable = [
         'id_barang_masuk',
         'nama_barang_masuk',
         'tanggal_barang_masuk',
         'jumlah_barang_masuk',
         'gambar_barang_masuk',
 
     ];

         public static function GenerateID()
       {
           $prefix = 'MSK' . date('ymd');
   
           $last_id = BarangMasuk::where('id_barang_masuk', 'like', $prefix . '%')->max('id_barang_masuk');
   
           if ($last_id == null) {
               $kode = $prefix . '000000001';
           } else {
               $kode = str_replace($prefix, "", $last_id);
               $kode = (int) $kode + 1;
               $kode = $prefix . str_pad($kode, 9, "0", STR_PAD_LEFT);
           }
           return $kode;
       }
}