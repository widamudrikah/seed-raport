<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Seed;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class VikorController extends Controller
{
    // public function calculateRanking()
    // {
    //     // Ambil semua data seed
    //     $seeds = Seed::all();
    //     $tahunAjarId = $seeds->first()->tahun_ajar_id; // Ambil ID tahun ajar pertama

    //     $results = [];

    //     // Group data seed berdasarkan siswa
    //     $seedsGrouped = $seeds->groupBy('siswa_id');

    //     // Hitung untuk setiap siswa
    //     foreach ($seedsGrouped as $siswaId => $siswaSeeds) {
    //         $jumlahSeed = $siswaSeeds->sum('jumlah_seed');
    //         $rataRata = $siswaSeeds->avg('jumlah_seed');
    //         $selisih = $siswaSeeds->max('jumlah_seed') - $siswaSeeds->min('jumlah_seed');

    //         // Konsistensi: jika rata-rata tertinggi dan terendah selisihnya < 20 dan rata-rata setiap bulan > 20
    //         $isConsistent = $this->checkConsistency($siswaSeeds);

    //         // Hitung skor VIKOR (misalnya skor adalah rata-rata dikurangi selisih)
    //         $skor = $rataRata - $selisih;

    //         // Simpan hasil perhitungan ke dalam array
    //         $results[] = [
    //             'siswa_id' => $siswaId,
    //             'tahun_ajar_id' => $tahunAjarId,
    //             'konsisten' => $isConsistent ? 'Baik' : 'Kurang',
    //             'rata_rata' => $rataRata,
    //             'selisih' => $selisih,
    //             'jumlah_seed' => $jumlahSeed,
    //             'skor' => $skor,
    //         ];
    //     }

    //     // Simpan hasil perhitungan ke tabel results
    //     foreach ($results as $result) {
    //         Result::create($result);
    //     }

    //     return redirect()->route('ranking-result')->with('success', 'Perhitungan ranking selesai.');
    // }

    // private function checkConsistency($seeds)
    // {
    //     $rataBulans = $seeds->pluck('jumlah_seed')->toArray();
    //     $rataTertinggi = max($rataBulans);
    //     $rataTerendah = min($rataBulans);

    //     // Cek apakah selisih rata-rata tertinggi dan terendah < 20 dan setiap bulan > 20
    //     if (($rataTertinggi - $rataTerendah) < 20 && collect($rataBulans)->every(fn($rata) => $rata > 20)) {
    //         return true;
    //     }

    //     return false;
    // }

    public function calculateRanking(Request $request)
    {
        // Pastikan tahun ajar dikirim dari halaman
        $tahunAjarId = $request->input('tahun_ajar_id');

        // Ambil data seed berdasarkan tahun ajar yang dipilih
        $seeds = Seed::where('tahun_ajar_id', $tahunAjarId)->get();

        if ($seeds->isEmpty()) {
            return redirect()->route('ranking-result', ['tahun_ajar_id' => $tahunAjarId])
            ->with('error', 'Tidak ada data untuk tahun ajar yang dipilih.');
        }

        $results = [];

        // Group data seed berdasarkan siswa
        $seedsGrouped = $seeds->groupBy('siswa_id');

        // Hitung untuk setiap siswa
        foreach ($seedsGrouped as $siswaId => $siswaSeeds) {
            $jumlahSeed = $siswaSeeds->sum('jumlah_seed');
            $rataRata = $siswaSeeds->avg('jumlah_seed');
            $selisih = $siswaSeeds->max('jumlah_seed') - $siswaSeeds->min('jumlah_seed');

            // Konsistensi: jika rata-rata tertinggi dan terendah selisihnya < 20 dan rata-rata setiap bulan > 20
            $isConsistent = $this->checkConsistency($siswaSeeds);

            // Hitung skor VIKOR (misalnya skor adalah rata-rata dikurangi selisih)
            $skor = $rataRata - $selisih;

            // Simpan hasil perhitungan ke dalam array
            $results[] = [
                'siswa_id' => $siswaId,
                'tahun_ajar_id' => $tahunAjarId,
                'konsisten' => $isConsistent ? 'Baik' : 'Kurang',
                'rata_rata' => $rataRata,
                'selisih' => $selisih,
                'jumlah_seed' => $jumlahSeed,
                'skor' => $skor,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Simpan hasil perhitungan ke tabel results
        Result::where('tahun_ajar_id', $tahunAjarId)->delete(); // Hapus data lama untuk tahun ajar ini
        Result::insert($results);

        return redirect()->route('ranking-result', $tahunAjarId)->with('success', 'Perhitungan ranking selesai.');
    }

    private function checkConsistency($seeds)
    {
        $rataBulans = $seeds->pluck('jumlah_seed')->toArray();
        $rataTertinggi = max($rataBulans);
        $rataTerendah = min($rataBulans);

        // Cek apakah selisih rata-rata tertinggi dan terendah < 20 dan setiap bulan > 20
        return ($rataTertinggi - $rataTerendah) < 20 && collect($rataBulans)->every(fn($rata) => $rata > 20);
    }

    public function exportRanking()
    {
        $tahunAjars = TahunAjar::all();
        return view('admin.vikor.hitung', compact('tahunAjars'));
    }

    public function showRanking($tahunAjarId)
    {
        // Ambil data tahun ajar berdasarkan ID
        $tahunAjar = TahunAjar::findOrFail($tahunAjarId);
        // Ambil data ranking berdasarkan tahun ajar tertentu
        $results = Result::where('tahun_ajar_id', $tahunAjarId)
        ->orderByDesc('skor')
        ->get();

        return view('admin.vikor.index', compact('results', 'tahunAjar'));
    }
}
