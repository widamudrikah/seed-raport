@extends('dashboard.base')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Sistem Rangking</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="row mb-3">
    <!-- Kartu Ringkasan Data -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Total Siswa</h5>
                <h3>{{ $totalSiswa }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Total Kelas</h5>
                <h3>{{ $totalKelas }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Data Seed yang Diinput</h5>
                <h3>{{ $totalSeed }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5>Rata-rata Skor</h5>
                <h3>{{ $totalSeed }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Grafik Skor Siswa</h5>
                @if ($rankingSiswa->isEmpty()) <!-- Percabangan jika tidak ada data -->
                    <p>Belum ada data skor yang dimasukkan.</p>
                @else
                    <canvas id="totalSkorChart"></canvas>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Ranking Siswa</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ranking</th>
                            <th>Nama</th>
                            <th>Seed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankingSiswa as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->total_skor }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Data untuk grafik total skor per siswa
    const siswaNames = @json($rankingSiswa->pluck('name'));
    const siswaSkor = @json($rankingSiswa->pluck('total_skor'));

    // Grafik Total Skor Siswa
    const ctx1 = document.getElementById('totalSkorChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: siswaNames,
            datasets: [{
                label: 'Total Seed',
                data: siswaSkor,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Rata-rata Skor
    const ctx2 = document.getElementById('rataSkorChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Rata-rata Skor'],
            datasets: [{
                label: 'Rata-rata Skor',
                data: [@json($rataSkor)],
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection