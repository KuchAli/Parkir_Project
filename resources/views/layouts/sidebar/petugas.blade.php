<nav class="navbar navbar-dark bg-dark d-flex flex-column align-items-stretch p-3">
    {{-- Brand/Logo --}}
    <div class="w-100 text-center mb-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h4 class="mt-3 mb-0">Peminjaman Alat</h4>
        </a>
        
        {{-- Toggle button untuk mobile --}}
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    {{-- Menu Navigasi --}}
    <ul class="nav nav-pills flex-column w-100">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} text-white rounded-3 mb-2" 
               href="#">
                <span class="d-flex align-items-center">
                    <span class="flex-grow-1">Dashboard</span>
                    
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }} text-white rounded-3 mb-2" 
               href="#">
                <span class="d-flex align-items-center">
                    <span class="flex-grow-1">Peminjaman</span>
                    
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }} text-white rounded-3 mb-2" 
               href="#">
                <span class="d-flex align-items-center">
                    <span class="flex-grow-1">Data Alat</span>
                    
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }} text-white rounded-3 mb-2" 
               href="#">
                <span class="d-flex align-items-center">
                    <span class="flex-grow-1">Data Mahasiswa</span>
                    
                </span>
            </a>
        </li>
        
        {{-- Separator --}}
        <li class="nav-item my-3">
            <hr class="bg-light">
        </li>
        
        {{-- Menu Pengaturan --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }} text-white rounded-3 mb-4" 
               href="#">
                <span class="d-flex align-items-center">
                    <span class="flex-grow-1">Pengaturan</span>
                    
                </span>
            </a>
        </li>
    </ul>

    {{-- User Info & Logout --}}
    <div class="mt-auto w-100 pt-3 ms-3">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle rounded-3 p-2" 
               data-bs-toggle="dropdown">
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                     style="width: 40px; height: 40px;">
                    <span>{{ substr(Auth::user()->name ?? 'User', 0, 1) }}</span>
                </div>
                <div class="ms-2">
                    <small>{{ Auth::user()->name ?? 'User' }}</small>
                    <br>
                    <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item rounded-2" href="#">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="dropdown-item rounded-2 text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Hover effect menggunakan Bootstrap utility classes tambahan */
    .nav-link:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
        padding-left: 20px !important;
        transition: all 0.3s ease;
    }
    
    .nav-link .opacity-50 {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .nav-link:hover .opacity-50 {
        opacity: 0.7;
    }
    
    .dropdown-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .dropdown-item:hover {
        background-color: #495057;
        padding-left: 20px !important;
    }
</style>