<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'tb_ekspedisi';

    protected $fillable = [
        'id_ekspedisi',
        'nama_ekspedisi',
        'alamat_ekspedisi',
        'no_hp_ekspedisi',
        'gambar_ekspedisi',
    ];


    public static function GenerateID()
    {
        $prefix = 'EKSP' . date('Ymd');
        $MaxID = Ekspedisi::where('id_ekspedisi', 'like', $prefix . '%')->max('id_ekspedisi');

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