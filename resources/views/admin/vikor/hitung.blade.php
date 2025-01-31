@extends('dashboard.base')


@section('title', 'Data Kelas')
@section('content')
<!-- Page Heading -->

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Hitung Data Ranking</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tahun Ajar</th>
                <th>Semester</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tahunAjars as $tahunAjar)
            <tr>
                <td>{{ $tahunAjar->year }}</td>
                <td>{{ $tahunAjar->semester }}</td>
                <td>
                    <form action="{{ route('calculate-ranking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tahun_ajar_id" value="{{ $tahunAjar->id }}">
                        <button type="submit" class="btn btn-primary">Hitung Ranking</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    <!-- /.container-fluid -->
</div>

<!-- Content Row -->
@endsection