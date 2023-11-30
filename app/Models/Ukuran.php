<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = 'tb_ukuran';

    protected $fillable = [
        'id_ukuran',
        'nama_ukuran',
        
    ];


    public static function GenerateID()
    {
        $prefix = 'UKR' . date('Ymd');
        $MaxID = Ukuran::where('id_ukuran', 'like', $prefix . '%')->max('id_ukuran');

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