<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Seed;
use App\Models\Siswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardContoller extends Controller
{
    public function index(Request $request)
    {
        $guru = Auth::user();
        
        // Ambil kelas yang diajar oleh guru
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        
        // Ambil tahun ajar berdasarkan filter (jika ada)
        $tahunAjarId = $request->tahun_ajar_id ?? TahunAjar::latest()->first()->id;

        // Ambil semua siswa di kelas tersebut
        $students = Siswa::where('kelas_id', $kelas->id)->get();

        // Ambil total data
        $totalSiswa = $students->count();
        $totalKelas = Kelas::where('guru_id', $guru->id)->count();
        $totalSeed = Seed::whereIn('siswa_id', $students->pluck('id'))
                         ->where('tahun_ajar_id', $tahunAjarId)
                         ->count();

        // Hitung total skor per siswa
        $students = $students->map(function ($student) use ($tahunAjarId) {
            $student->total_skor = Seed::where('siswa_id', $student->id)
                                        ->where('tahun_ajar_id', $tahunAjarId)
                                        ->sum('jumlah_seed');
            return $student;
        });

        // Urutkan siswa berdasarkan skor (ranking)
        $rankingSiswa = $students->sortByDesc('total_skor')->values();

        // Hitung rata-rata skor
        $rataSkor = $rankingSiswa->avg('total_skor');

        // Ambil data tahun ajar untuk filter
        $tahunAjar = TahunAjar::all();

        return view('guru.dashboard-guru', compact(['totalSiswa', 'totalKelas', 'totalSeed', 'rankingSiswa', 'rataSkor', 'tahunAjar']));
    }

    public function studentShow() {
        // Ambil data siswa dan kelas
        $kelas = Kelas::where('guru_id', Auth::user()->id)->first();
        $students = Siswa::where('kelas_id', $kelas->id)
        ->orderBy('name', 'asc') // Mengurutkan berdasarkan nama siswa (abjad)
        ->get();
        
        return view('guru.student-show', compact(['students', 'kelas']));
    }
}
