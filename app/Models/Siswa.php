<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nisn',
        'kelas_id',
        'jenis_kelamin'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function seeds()
    {
        return $this->hasMany(Seed::class, 'siswa_id');
    }
}
