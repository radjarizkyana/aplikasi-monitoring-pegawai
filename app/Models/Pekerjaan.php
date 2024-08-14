<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'judul_pekerjaan', 'id_kategori', 'id_bobot_kerja', 'foto_sebelum', 'foto_sesudah'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function bobotKerja()
    {
        return $this->belongsTo(BobotKerja::class, 'id_bobot_kerja');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
