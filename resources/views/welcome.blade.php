<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Rangking</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <!-- Hero Section -->
    <header class="bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Sistem Rangking</h1>
            <p class="lead">Kelola dan lihat rangking siswa berdasarkan data yang terkumpul.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Masuk ke Dashboard</a>
        </div>
    </header>

    <!-- About Section -->
<section id="about" class="py-5">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="row justify-between">
            <div class="col-md-6 my-auto">
                <h2>Tentang Sistem</h2>
                <p>Sistem rangking ini digunakan untuk menghitung dan menampilkan peringkat siswa berdasarkan jumlah seed yang diberikan setiap semester. Sistem ini membantu guru untuk memantau dan mengevaluasi prestasi siswa dengan lebih efektif.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/baiturrahman-logo.jpg') }}" class="img-fluid" alt="Sistem Rangking" width="50%">
            </div>
        </div>
    </div>
</section>
    <!-- Footer Section -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 Sistem Rangking. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
