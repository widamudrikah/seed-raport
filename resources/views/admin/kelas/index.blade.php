@extends('dashboard.base')


@section('title', 'Data Kelas')
@section('content')
<!-- Page Heading -->

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Data Kelas</h1>
    <a href="{{ route('kelas-create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fa-solid fa-plus text-white-50"></i>
        Tambah Kelas</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Jumlah Murid</th>
                                <th>Wali Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelases as $kelas)
                            <tr>
                                <td>{{ $kelas->name }}</td>
                                <td>{{ $kelas->jumlah_siswa }}</td>
                                <td>{{ $kelas->guru->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger mr-2">
                                    <i class="fa-solid fa-trash"></i>
                                    </a>

                                    <a href="{{ route('kelas-edit', $kelas->id) }}" class="btn btn-warning mr-2">
                                    <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="{{ route('kelas-show', $kelas->id) }}" class="btn btn-success">
                                    <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada data kelas</td>
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