<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'jumlah_siswa',
        'guru_id',
    ];

    // Relasi: Kelas has many Siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }

    public function guru() {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }
}
