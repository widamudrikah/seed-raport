<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Bulan;
use App\Models\Kelas;
use App\Models\Seed;
use App\Models\Siswa;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeedController extends Controller
{
    public function index(Request $request)
    {
        $guru = Auth::user();
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        $tahunAjar = TahunAjar::get(); // Mengambil semua tahun ajar

        // Ambil filter dari request
        $tahunAjarId = $request->tahun_ajar_id;

        // Ambil siswa dalam kelas yang diajar guru
        $studentsQuery = Siswa::where('kelas_id', $kelas->id)
            ->with(['seeds' => function ($query) use ($tahunAjarId) {
                if ($tahunAjarId) {
                    $query->where('tahun_ajar_id', $tahunAjarId);
                }
            }]);

        // Hitung total seed berdasarkan tahun ajar yang dipilih
    $students = $studentsQuery->get()->map(function ($student) {
        $student->total_seed = $student->seeds->sum('jumlah_seed'); // Menjumlahkan semua jumlah seed
        return $student;
    })->sortByDesc('total_seed'); // Urutkan berdasarkan total seed tertinggi

        return view('guru.index', compact('students', 'tahunAjar', 'kelas'));
    }



    public function create()
    {
        $guru = Auth::user();
        $kelas = Kelas::where('guru_id', $guru->id)->first();
        $students = Siswa::where('kelas_id', $kelas->id)->get();

        $bulan = Bulan::get();
        $tahunAjar = TahunAjar::get();

        return view('guru.seed.create', compact(['students', 'tahunAjar', 'bulan']));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jumlah_seed.*' => 'required|numeric',
            'bulan_id' => 'required|exists:bulans,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        // Loop untuk menyimpan data seed per siswa
        foreach ($request->jumlah_seed as $siswaId => $jumlah_seed) {
            // Simpan data seed untuk setiap siswa
            Seed::create([
                'siswa_id' => $siswaId,
                'bulan_id' => $request->bulan_id,
                'tahun_ajar_id' => $request->tahun_ajar_id,
                'jumlah_seed' => $jumlah_seed,
            ]);
        }

        return redirect()->route('seed-index')->with('success', 'Data seed berhasil ditambahkan.');
    }
}
