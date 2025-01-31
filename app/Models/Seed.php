<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    use HasFactory;

    // Tambahkan siswa_id ke dalam fillable
    protected $fillable = [
        'siswa_id',
        'bulan_id',
        'tahun_ajar_id',
        'jumlah_seed',
    ];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }

    public function tahunAjar()
    {
        return $this->belongsTo(TahunAjar::class, 'tahun_ajar_id');
    }
}
