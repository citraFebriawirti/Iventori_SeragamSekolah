<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;


    protected $table = 'tb_jenis';


    protected $fillable = [
        'id_jenis',
        'nama_jenis'
    ];


    public static function GenerateID()
    {
        $prefix = 'JNS' . date('Ymd');
        $MaxID = Jenis::where('id_jenis', 'like', $prefix . '%')->max('id_jenis');

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