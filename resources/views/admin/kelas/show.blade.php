@extends('dashboard.base')


@section('title', 'Detail Kelas')
@section('content')
<!-- Page Heading -->

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kelas {{ $kelas->name }}</h1>
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
                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>

<!-- Content Row -->
@endsection