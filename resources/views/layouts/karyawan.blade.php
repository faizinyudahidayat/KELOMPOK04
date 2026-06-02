<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Karyawan') | INV-UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent: #3b82f6;
            --bg: #0f172a;
            --glass: rgba(30, 41, 59, 0.7);
        }
        body {
            background: radial-gradient(circle at top right, #1e293b, var(--bg));
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 280px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            border-right: 1px solid rgba(255,255,255,0.08);
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }
        .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 5px 15px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
        }
        .nav-link i {
            font-size: 1.15rem;
            margin-right: 14px;
        }
        .nav-link:hover,
        .nav-link.active {
            background: rgba(59, 130, 246, 0.12);
            color: #3b82f6;
            font-weight: 600;
        }
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 2.5rem;
            transition: all 0.3s ease-in-out;
        }
        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: none;
        }
        .stat-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.65));
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            border-color: rgba(59, 130, 246, 0.2);
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }
            .mobile-nav {
                display: flex;
            }
        }
    </style>
</head>
<body>

    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-UNIBA</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="sidebar d-flex flex-column p-4" id="layoutSidebar">
        <div class="d-flex align-items-center mb-5 px-2">
            <div class="p-2 rounded-3 me-3" style="background: rgba(59, 130, 246, 0.1);">
                <i class="bi bi-box-seam-fill fs-4" style="color: #3b82f6;"></i>
            </div>
            <h4 class="fw-bold m-0 text-white" style="font-size: 1.2rem; letter-spacing: 1px;">
                INV-UNIBA
            </h4>
        </div>

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link {{ Request::is('karyawan/dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link {{ Request::is('karyawan/pengajuan*') && !Request::is('karyawan/pengajuan/create') ? 'active' : '' }}"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link {{ Request::is('karyawan/laporan*') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>

        <div class="mt-auto">
            <hr class="opacity-10" style="border-color: rgba(255,255,255,0.08);">
            <!-- Profile User -->
            <div class="px-2 mb-3 d-flex align-items-center">
                <div class="rounded-circle me-3"
                    style="
                        width: 42px;
                        height: 42px;
                        background: rgba(59, 130, 246, 0.12);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid rgba(59,130,246,0.15);
                    ">
                    <i class="bi bi-person-fill text-white-50"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="small fw-bold m-0 text-white text-truncate">
                        {{ Auth::user()->name ?? 'Karyawan' }}
                    </p>

                    <span class="text-white-50"
                        style="font-size: 0.72rem;">
                        Karyawan
                    </span>
                </div>
            </div>
            <!-- Logout -->
            <a href="{{ route('logout') }}"
            class="nav-link text-danger m-0">
                <i class="bi bi-box-arrow-left"></i>
                Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid px-0">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mb-4 text-white" role="alert" style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3) !important;">
                <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const layoutSidebar = document.getElementById('layoutSidebar');
        if(menuToggle && layoutSidebar) {
            menuToggle.addEventListener('click', function() {
                layoutSidebar.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
