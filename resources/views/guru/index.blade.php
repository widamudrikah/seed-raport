@extends('dashboard.base')

@section('title', 'Rangking Siswa')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ranking Siswa Kelas {{ $kelas->name }}</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Form Filter Tahun Ajar -->
        <div class="d-flex align-items-center gap-2 mb-4">
            <form method="GET" action="{{ route('seed-index') }}" class="d-flex align-items-center gap-2">
                <select name="tahun_ajar_id" class="form-control">
                    <option value="">Pilih Tahun Ajar</option>
                    @foreach ($tahunAjar as $tahun)
                    <option value="{{ $tahun->id }}" {{ request('tahun_ajar_id') == $tahun->id ? 'selected' : '' }}>
                        {{ $tahun->year }} - {{ $tahun->semester }}
                    </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary ml-4">Filter</button>
            </form>
        </div>


        <!-- Tabel Rangking -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama</th>
                    <th>Total Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->total_seed ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- /.container-fluid -->
</div>

<!-- Content Row -->
@endsection