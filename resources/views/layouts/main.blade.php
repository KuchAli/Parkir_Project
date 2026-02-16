<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Peminjaman Alat')</title>

    {{-- CSS Global --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    
    {{-- CSS untuk sidebar --}}
    <style>
        body {
            overflow-x: hidden;
        }
        
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
        }
        
        .main-content {
            min-height: 100vh;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: static;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid px-0">
    <div class="row g-0">
        {{-- Sidebar --}}
        <div class="col-lg-2 col-md-3 d-md-block sidebar bg-dark text-white">
            <aside class="bg-dark text-white p-3" style="width: 250px;">
                @include('layouts.sidebar.' . auth()->user()->role)
            </aside>
        </div>

        {{-- Konten Utama --}}
        <div class="col-lg-10 col-md-9 main-content">
            <div class="p-4">
                <h3 class="mb-4">@yield('page-title')</h3>
                @yield('content')
            </div>
        </div>
    </div>
</div>

{{-- JS Global --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- JS untuk toggle sidebar di mobile --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggler = document.querySelector('[data-bs-toggle="sidebar"]');
        const sidebar = document.querySelector('.sidebar');
        
        if (sidebarToggler && sidebar) {
            sidebarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('d-none');
                sidebar.classList.toggle('d-md-block');
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>