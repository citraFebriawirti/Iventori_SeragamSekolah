<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

     // mengcustom table ke database agar tidak rancu
     protected $table = 'tb_admin';

     // mendeskripsi table ke database
     protected $fillable = [
         'id_admin',
         'nama_admin',
         'alamat_admin',
         'no_hp_admin',
         'gambar_admin',
     ];
     
     public static function GenerateID()
     {
         $prefix = 'ADM' . date('Ymd');
         $MaxID = Admin::where('id_admin', 'like', $prefix . '%')->max('id_admin');
 
         if ($MaxID == null) {
 
             $kode = $prefix . '000000001';
         } else {
             $kode = str_replace($prefix, '', $MaxID);
             $kode = (int)$kode + 1;
             $kode = $prefix . str_pad($kode, 9, '0', STR_PAD_LEFT);
         }
 
         return $kode;
     }
}