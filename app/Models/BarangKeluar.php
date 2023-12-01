<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

     // mengcustom table ke database agar tidak rancu
     protected $table = 'tb_barang_keluar';

     // mendeskripsi table ke database
     protected $fillable = [
         'id_barang_keluar',
         'nama_barang_keluar',
         'tanggal_barang_keluar',
         'jumlah_barang_keluar',
         'gambar_barang_keluar',
 
     ];

         public static function GenerateID()
       {
           $prefix = 'KLR' . date('ymd');
   
           $last_id = BarangKeluar::where('id_barang_keluar', 'like', $prefix . '%')->max('id_barang_keluar');
   
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