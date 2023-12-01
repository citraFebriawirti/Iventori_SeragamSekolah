<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busana extends Model
{
    use HasFactory;

    protected $table = 'tb_busana';


    protected $fillable = [
        'id_busana',
        'nama_busana'
    ];


    public static function GenerateID()
    {
        $prefix = 'BUSN' . date('Ymd');
        $MaxID = Busana::where('id_busana', 'like', $prefix . '%')->max('id_busana');

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