<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan'
    ];

    public function userPegawais()
    {
        return $this->hasMany(UserPegawai::class, 'id_jabatan');
    }
    
}
