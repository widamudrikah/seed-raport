@extends('dashboard.base')


@section('title', 'Data Siswa')
@section('content')
<!-- Page Heading -->

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Seluruh Siswa</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="card-header py-3">
                        <form method="GET" action="{{ route('siswa-index') }}" class="row g-3">
                            <!-- Filter Nama -->
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Cari Nama" value="{{ request('name') }}">
                            </div>

                            <!-- Filter Kelas -->
                            <div class="col-md-4">
                                <select name="kelas_id" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Button Cari -->
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                                <a href="{{ route('siswa-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->nisn }}</td>
                                <td>{{ $student->kelas->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger mr-2">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>

                                    <a href="{{ route('siswa-edit', $student->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak Ada Data Siswa</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>

<!-- Content Row -->
@endsection