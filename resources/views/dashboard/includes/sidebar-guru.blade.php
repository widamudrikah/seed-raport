<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-seedling"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Seed Reward</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard-guru') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Guru</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('seed-create') }}">
            <i class="fa-solid fa-users"></i>
            <span>Input Data Seed</span>
        </a>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('seed-index') }}">
            <i class="fa-solid fa-school"></i>
            <span>Rangking Kelas</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students-list') }}">
            <i class="fa-solid fa-school"></i>
            <span>Data Siswa</span>
        </a>
    </li>
</ul>