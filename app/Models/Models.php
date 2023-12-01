<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    protected $table = 'tb_model';


    protected $fillable = [
        'id_model',
        'nama_model'
    ];


    public static function GenerateID()
    {
        $prefix = 'KTG' . date('Ymd');
        $MaxID = Models::where('id_model', 'like', $prefix . '%')->max('id_model');

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