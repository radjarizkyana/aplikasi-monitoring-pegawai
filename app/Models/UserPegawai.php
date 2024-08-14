<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jabatan', 'nama', 'jenis_kelamin', 'agama', 'alamat', 'no_telp'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_pegawai');
    }
}

