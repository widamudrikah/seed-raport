<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Seed;
use App\Models\Siswa;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardContoller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Mengambil jumlah guru, siswa, kelas
        $jumlahGuru = User::where('role_as', 0)->get()->count();
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();

        // Mengambil jumlah seluruh seed dalam satu tahun ajar
        $tahunAjarId = TahunAjar::latest()->first()->id; // Mengambil tahun ajar terakhir
        $jumlahSeed = Seed::where('tahun_ajar_id', $tahunAjarId)->sum('jumlah_seed');

        // Mengambil data kelas dan wali kelas
        $kelasWaliKelas = Kelas::with(['guru' => function ($query) {
            $query->where('role_as', 0); // Pastikan hanya guru (role_as = 0) yang tampil sebagai wali kelas
        }])->get();

        // Mengambil data grafik seed berdasarkan bulan dalam satu tahun ajar
        $grafikSeed = Seed::where('tahun_ajar_id', $tahunAjarId)
            ->groupBy('bulan_id')
            ->selectRaw('sum(jumlah_seed) as total_seed, bulan_id')
            ->get();
        //   dd($grafikSeed);

        // Mengambil bulan_id dan total_seed sebagai array
        $bulanIds = $grafikSeed->pluck('bulan_id')->toArray();
        $totalSeeds = $grafikSeed->pluck('total_seed')->toArray();
        // dd($totalSeeds);


        return view('admin.dashboard', compact(
            'user',
            'jumlahGuru',
            'jumlahSiswa',
            'jumlahKelas',
            'jumlahSeed',
            'kelasWaliKelas',
            'bulanIds', // Mengirim bulan_id
            'totalSeeds' // Mengirim total_seed
        ));
    }
}
