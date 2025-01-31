@extends('dashboard.base')

@section('title', 'Tambah Guru')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Tambah Data Guru</h1>
    <a href="{{ route('guru-index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        Batal</a>
</div>


<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
    <form action="{{ route('guru-store') }}" method="post" class="card p-4">
    @csrf
    <!-- Name Field -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
        @error('name') <small class="text-danger">{{$message}}</small> @enderror
    </div>

    <!-- Email Field -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
        @error('email') <small class="text-danger">{{$message}}</small> @enderror

    </div>

    <!-- Password Field -->
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
        @error('password') <small class="text-danger">{{$message}}</small> @enderror

    </div>

    <!-- Submit Button -->
    <div class="text-start">
        <button type="submit" class="btn btn-primary btn-md w-auto">Create User</button>
    </div>
</form>

    </div>
    <!-- /.container-fluid -->
</div>


<!-- Content Row -->
@endsection