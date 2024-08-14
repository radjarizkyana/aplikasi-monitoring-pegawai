<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bobot', 'deskripsi'
    ];

    public function pekerjaans()
    {
        return $this->hasMany(Pekerjaan::class, 'id_bobot_kerja');
    }
}
