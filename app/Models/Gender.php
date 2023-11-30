<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'tb_gender';

    protected $fillable = [
        'id_gender',
        'nama_gender',
        
    ];


    public static function GenerateID()
    {
        $prefix = 'GDR' . date('Ymd');
        $MaxID = gender::where('id_gender', 'like', $prefix . '%')->max('id_gender');

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