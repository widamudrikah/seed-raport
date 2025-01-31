<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index() {
        $teachers = User::where('role_as', 0)->get();
        return view('admin.guru.index', compact('teachers'));
    }

    public function create() {
        return view('admin.guru.create');
    }

    public function store(GuruRequest $request) {
        $validatedData = $request->validated();
        // Simpan ke database
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_as' => 0,
        ]);
    
        return redirect()->route('guru-index')->with('message', 'Data guru berhasil ditambahkan');
    }
    
}
