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
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
        }

        .btn-edit:hover {
            color: var(--primary);
        }
        
        .btn-delete:hover {
            color: red;
            
        }
        
        .main-content {
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 10px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.95rem;
        }

       .attendance-table {
            background-color: white;
            width: 100%;
            border-collapse: collapse
            
        }

       
        
        .attendance-table thead {
            background-color: var(--light);
        }
        
        .attendance-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 2px solid var(--light-gray);
        }
        
        .attendance-table td {
            padding: 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .attendance-table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }

         /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .status-admin {
            background-color: rgba(35, 128, 204, 0.374);
            color: var(--primary);
        }
        
        .status-petugas {
            background-color: rgba(47, 223, 71, 0.341);
            color: var(--success);
        }
        
        .status-owner {
            background-color: rgba(80, 77, 73, 0.241);
            color: var(--secondary);
        }

        .status-unknown {
            background-color: rgba(158, 158, 158, 0.15);
            color: var(--danger);
        }

        .status-select, .time-input, .note-input {
            padding: 10px 12px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 0.95rem;
            width: 100%;
            max-width: 200px;
        }

        .quick-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .input-group{
            display: flex;
            flex-wrap: nowrap;
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