@extends('dashboard.base')

@section('title', 'Rangking Siswa')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Data Siswa Kelas {{ $kelas->name }}</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Absen</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NISN</th>
                    <th scope="col">Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->jenis_kelamin }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Content Row -->
@endsection