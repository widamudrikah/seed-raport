@extends('dashboard.base')


@section('title', 'Tambah Siswa')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Tambah Data Kelas</h1>
    <a href="{{ route('kelas-index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        Batal</a>
</div>


<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form class="card p-4" method="post" action="{{ route('kelas-store') }}">
            @csrf
            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan nama kelas" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="jumlah_siswi" class="form-label">Jumlah Siswi</label>
                <input type="number" class="form-control @error('jumlah_siswa') is-invalid @enderror" id="email" name="jumlah_siswa" placeholder="Masukan jumlah siswa" value="{{ old('email') }}" required>
                @error('jumlah_siswi') <small class="text-danger">{{$message}}</small> @enderror

            </div>

            <div class="mb-3">
                <label for="guru_id" class="form-label">Pilih Wali Kelas</label>
                <select class="form-control" id="exampleSelect" name="guru_id">
                    <option selected disabled>Pilih guru...</option>
                    @foreach($teachers as $teacher)
                    <option value="{{$teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="text-start">
                <button type="submit" class="btn btn-primary btn-md w-auto">Tambah Kelas</button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
</div>


<!-- Content Row -->
@endsection