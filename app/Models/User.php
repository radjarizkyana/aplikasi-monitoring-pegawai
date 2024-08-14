<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai', 'username', 'password', 'admin'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function userPegawai()
    {
        return $this->belongsTo(UserPegawai::class, 'id_pegawai');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->userPegawai) {
                $user->userPegawai->delete();
            }
        });
    }
    
    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class, 'id_user');
    }
}
