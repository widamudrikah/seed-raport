@extends('dashboard.base')

@section('title', 'Data Guru')
@section('content')
<!-- Page Heading -->

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Guru</h1>
    <a href="{{ route('guru-create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fa-solid fa-plus text-white-50"></i>
        Tambah Guru</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Tanggal Bergabung</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger mr-2">
                                    <i class="fa-solid fa-trash"></i>
                                    </a>

                                    <a href="#" class="btn btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak ada data guru</td>
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