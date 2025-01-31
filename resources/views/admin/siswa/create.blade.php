@extends('dashboard.base')


@section('title', 'Tambah Siswa')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Tambah Data Siswa</h1>
    <a href="{{ route('kelas-index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        Batal</a>
</div>


<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form class="card p-4" method="post" action="{{ route('siswa-store') }}">
            @csrf
            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan nama lengkap siswa" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="exampleSelect" name="jenis_kelamin">
                    <option selected disabled>Pilih Jenis kelamin...</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">perempuan</option>
                </select>
                @error('jenis_kelamin') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" placeholder="Masukan NISN siswa" value="{{ old('nisn') }}" required>
                @error('nisn') <small class="text-danger">{{$message}}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="kelas_id" class="form-label">Pilih Kelas</label>
                <select class="form-control" id="exampleSelect" name="kelas_id">
                    <option selected disabled>Pilih Kelas...</option>
                    @foreach($kelases as $kelas)
                    <option value="{{$kelas->id }}">{{ $kelas->name }}</option>
                    @endforeach
                </select>
                @error('kelas_id') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            

            <!-- Submit Button -->
            <div class="text-start">
                <button type="submit" class="btn btn-primary btn-md w-auto">Tambah Siswa</button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
</div>


<!-- Content Row -->
@endsection