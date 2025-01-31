@extends('dashboard.base')

@section('title', 'Ranking Siswa')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1 class="h3 mb-4 text-gray-800 fw-bold">Ranking Siswa {{ $tahunAjar->semester }} {{ $tahunAjar->year }}</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Ranking</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Konsistensi</th>
            <th scope="col">Rata-Rata</th>
            <th scope="col">Selisih</th>
            <th scope="col">Jumlah Seed</th>
            <th scope="col">Skor</th>
        </tr>
    </thead>
    <tbody>
        @if($results->isEmpty())
        <tr>
            <td colspan="6" class="text-center">Belum ada data seed pada tahun ajar ini</td>
        </tr>
        @else
        @foreach ($results as $index => $result)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $result->siswa->name }}</td>
            <td>{{ $result->konsisten }}</td>
            <td>{{ $result->rata_rata }}</td>
            <td>{{ $result->selisih }}</td>
            <td>{{ $result->jumlah_seed }}</td>
            <td>{{ $result->skor }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endsection