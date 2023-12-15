<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'id_users',
        'nama_users',
        'email',
        'password',
        'gambar_users'
    ];


    public static function GenerateID()
    {
        $prefix = 'Users' . date('ymd');

        $last_id = User::where('id_users', 'like', $prefix . '%')->max('id_users');

        if ($last_id == null) {
            $kode = $prefix . '000000001';
        } else {
            $kode = str_replace($prefix, "", $last_id);
            $kode = (int) $kode + 1;
            $kode = $prefix . str_pad($kode, 9, "0", STR_PAD_LEFT);
        }
        return $kode;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
