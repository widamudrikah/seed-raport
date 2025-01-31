@extends('dashboard.base')

@section('title', 'Tambah Guru')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Form Input Data Seed Bulanan</h1>
    <a href="{{ route('guru-index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        Batal</a>
</div>


<!-- Content Row -->
<div class="row">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if ($students->isEmpty())
        <p>Tidak ada siswa di kelas Anda.</p>
        @else
        <form action="{{ route('seed-store') }}" method="POST">
            @csrf
            <div class="d-sm-flex align-items-center mb-4">

                <!-- Input bulan -->
                <div class="mb-3 mr-4">
                    <label for="bulan_id" class="form-label">Pilih Bulan:</label>
                    <select name="bulan_id" id="bulan_id" class="form-control">
                        @foreach ($bulan as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input tahun ajar -->
                <div class="mb-3">
                    <label for="tahun_ajar_id" class="form-label">Pilih Tahun Ajar:</label>
                    <select name="tahun_ajar_id" id="tahun_ajar_id" class="form-control">
                        @foreach ($tahunAjar as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->year }} {{ $tahun->semester }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Jumlah Seed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }} ({{ $student->nisn }})</td>
                        <td><input type="number" name="jumlah_seed[{{ $student->id }}]" class="form-control" required></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



            <!-- Button untuk submit form -->
            <button type="submit" class="btn btn-primary">Tambah Seed</button>
        </form>
        @endif
    </div>
    <!-- /.container-fluid -->
</div>


<!-- Content Row -->
@endsection