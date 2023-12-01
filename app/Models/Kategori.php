<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;


    protected $table = 'tb_kategori';


    protected $fillable = [
        'id_kategori',
        'nama_kategori'
    ];


    public static function GenerateID()
    {
        $prefix = 'KTG' . date('Ymd');
        $MaxID = Kategori::where('id_kategori', 'like', $prefix . '%')->max('id_kategori');

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