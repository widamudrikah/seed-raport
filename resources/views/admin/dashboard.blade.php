@extends('dashboard.base')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang di Sistem Rangking</h1>
</div>
    <!-- Content Row -->
    <div class="row">
        <!-- Jumlah Guru -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahGuru }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Siswi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Siswi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSiswa }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Kelas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKelas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Seed -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Seed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSeed }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-seedling fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row for Table and Chart -->
    <div class="row">
        <!-- Tabel Kelas dan Wali Kelas -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Kelas dan Wali Kelas</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kelasWaliKelas as $kelas)
                            <tr>
                                <td>{{ $kelas->name }}</td>
                                <td>{{ $kelas->guru->name ?? 'Belum Ditentukan' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Grafik Seed per Bulan -->
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Seed per Bulan</h6>
                </div>
                <div class="card-body">
                    <canvas id="seedChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<script>
    const ctx = document.getElementById('seedChart').getContext('2d');
const seedChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($bulanIds), // Bulan id dari data controller
        datasets: [{
            label: 'Jumlah Seed',
            data: @json($totalSeeds), // Total seed dari data controller
            borderColor: 'rgba(75, 192, 192, 1)',
            fill: false,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Jumlah Seed'
                },
                beginAtZero: true
            }
        }
    }
});

</script>

@endsection