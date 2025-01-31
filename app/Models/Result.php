<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    // Menambahkan kolom-kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'siswa_id', 
        'tahun_ajar_id', 
        'konsisten', 
        'rata_rata', 
        'selisih', 
        'jumlah_seed', 
        'skor'
    ];

    public $timestamps = true;

    public function siswa() {
        return $this->belongsTo(Siswa::class,'siswa_id', 'id');
    }
}
