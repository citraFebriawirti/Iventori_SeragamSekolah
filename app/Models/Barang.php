<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

       // mengcustom table ke database agar tidak rancu
       protected $table = 'tb_barang';

       // mendeskripsi table ke database
       protected $fillable = [
           'id_barang',
           'nama_barang',
        //    'tanggal_masuk',
           'jumlah_stok',
           'gambar_barang',
   
       ];

    //    public static function GenerateID()
    //    {
    //        $prefix = 'BRG' . date('ymd');
   
    //        $last_id = Barang::where('id_barang', 'like', $prefix . '%')->max('id_barang');
   
    //        if ($last_id == null) {
    //            $kode = $prefix . '000000001';
    //        } else {
    //            $kode = str_replace($prefix, "", $last_id);
    //            $kode = (int) $kode + 1;
    //            $kode = $prefix . str_pad($kode, 9, "0", STR_PAD_LEFT);
    //        }
    //        return $kode;
    //    }


    // protected $table = 'tb_barang';
    // protected $primaryKey = 'id_barang';
}