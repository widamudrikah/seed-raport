<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() {
        $kelases = Kelas::get();
        return view('admin.kelas.index', compact('kelases'));
    }

    public function show($id) {
        $kelas = Kelas::findorFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }

    public function create() {
        $teachers = User::where('role_as', 0)->get();
        return view('admin.kelas.create', compact('teachers'));
    }

    public function store(KelasRequest $request) {
        $validatedData = $request->validated();

        Kelas::create([
            'name'          => $validatedData['name'],
            'jumlah_siswa'  => $validatedData['jumlah_siswa'],
            'guru_id'       => $validatedData['guru_id']
        ]);

        return redirect()->route('kelas-index')->with('message', 'Kelas berhasil ditambahkan');
    }

    public function edit($id) {
        $kelas = Kelas::findorFail($id);
        $teachers = User::where('role_as', 0)->get();
        return view('admin.kelas.edit', compact('kelas', 'teachers'));
    }

    public function update(KelasRequest $request, $id) {
        $validatedData = $request->validated();

        $kelas = Kelas::findorFail($id);
        $kelas->update([
            'name'          => $validatedData['name'],
            'jumlah_siswa'  => $validatedData['jumlah_siswa'],
            'guru_id'       => $validatedData['guru_id']
        ]);

        return redirect()->route('kelas-index')->with('message', 'Kelas berhasil diupdate');
    }
}
