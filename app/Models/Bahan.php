<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'tb_bahan';

    protected $fillable = [
        'id_bahan',
        'nama_bahan',
        
    ];


    public static function GenerateID()
    {
        $prefix = 'BHN' . date('Ymd');
        $MaxID = bahan::where('id_bahan', 'like', $prefix . '%')->max('id_bahan');

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