<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();
        // Filter berdasarkan nama
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $students = $query->with('kelas')->get();
        $kelas = Kelas::all(); // Untuk opsi filter kelas

        return view('admin.siswa.index', compact('students', 'kelas'));
    }

    public function create()
    {
        $kelases = Kelas::get();
        return view('admin.siswa.create', compact('kelases'));
    }

    public function store(SiswaRequest $request)
    {
        $validatedData = $request->validated();

        // Create a new siswa
        $siswa = Siswa::create([
            'name'  => $validatedData['name'],
            'nisn' => $validatedData['nisn'],
            'kelas_id' => $validatedData['kelas_id'],
            'jenis_kelamin' => $validatedData['jenis_kelamin']
        ]);

        // Redirect to siswa index page
        return redirect()->route('siswa-index')->with('message', 'Siswa berhasil ditambahkan');
    }

    public function edit($id) {
        $siswa = Siswa::findorFail($id);
        $kelases = Kelas::get();

        return view('admin.siswa.edit', compact('siswa', 'kelases'));
    }
}
