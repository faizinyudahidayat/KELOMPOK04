<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --accent: #3b82f6;
            --bg: #0f172a;
            --glass: rgba(30, 41, 59, 0.7);
            --bg-card: #151e2f;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, var(--bg));
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- SIDEBAR STYLING --- */
        .sidebar {
            width: 280px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin: 5px 15px;
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

        /* --- KONTEN UTAMA --- */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 2.5rem;
            transition: all 0.3s ease-in-out;
        }

        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        /* --- CARD & TABLES STYLING --- */
        .card {
            background-color: var(--bg-card);
            border: none;
            border-radius: 12px;
        }

        .table-dark-custom th {
            color: var(--text-muted) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color) !important;
            background-color: transparent !important;
        }

        .table-dark-custom td {
            background-color: transparent !important;
            color: var(--text-main) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            padding: 16px 8px;
            vertical-align: middle;
        }

        .table-dark-custom tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        .badge-kategori {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* --- RESPONSIVE MEDIA QUERIES --- */
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
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-ADMIN</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="d-flex">
        <div class="sidebar d-flex flex-column p-4" id="layoutSidebar">
            <div class="d-flex align-items-center mb-5 px-2">
                <div class="p-2 rounded-3 me-3" style="background: rgba(59, 130, 246, 0.1);">
                    <i class="bi bi-box-seam-fill fs-4" style="color: #3b82f6;"></i>
                </div>
                <div>
                    <h4 class="fw-bold m-0 text-white" style="font-size: 1.2rem; letter-spacing: 1px;">INV-UNIBA</h4>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.barang.index') }}" class="nav-link active">
                <i class="bi bi-box-seam"></i> Kelola Barang
            </a>
            <a href="{{ route('admin.category.index') }}"
                class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Kelola Kategori
            </a>

            <div class="mt-auto">
                <hr class="opacity-10" style="border-color: rgba(255,255,255,0.08);">
                <div class="px-2 mb-3 d-flex align-items-center">
                    <div class="rounded-circle me-3"
                        style="width: 42px; height: 42px; background: rgba(59, 130, 246, 0.12); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(59,130,246,0.15);">
                        <i class="bi bi-person-fill text-white-50"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="small fw-bold m-0 text-white text-truncate">
                            {{ Auth::user()->name ?? 'Admin Faizin' }}
                        </p>
                        <span class="text-white-50" style="font-size: 0.72rem;">Administrator</span>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="nav-link text-danger m-0 p-2">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </div>

        <div class="main-content" id="content">
            <nav class="navbar navbar-expand-lg rounded-3 mb-4 shadow-sm px-3 d-none d-md-block"
                style="background-color: var(--bg-card);">
                <div class="container-fluid p-0">
                    <span class="navbar-text fw-semibold text-white">
                        Sistem Inventaris UNIBA Madura — Kelola Barang
                    </span>
                    <div class="ms-auto">
                        <span class="badge p-2 px-3 rounded-pill shadow-sm"
                            style="background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: #fff; font-weight: 500;">
                            <i class="bi bi-box-seam me-1" style="color: #3b82f6;"></i> Modul Barang
                        </span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-0">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-transparent py-3 border-bottom"
                        style="border-color: var(--border-color) !important;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <h5 class="fw-bold mb-0 text-white">Semua Daftar Barang</h5>
                            <a href="{{ route('admin.barang.create') }}"
                                class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm fw-medium">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Barang
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark-custom mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Stok</th>
                                        <th class="pe-4 text-end">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allBarang as $key => $row)
                                        <tr>
                                            <td class="ps-4" style="color: var(--text-muted);">{{ $key + 1 }}
                                            </td>
                                            <td class="fw-semibold text-white">{{ $row->nama_barang }}</td>
                                            <td>{{ $row->category->nama_kategori ?? '-' }}</td>
                                            <td><span
                                                    class="badge badge-kategori rounded-pill px-2 py-1">{{ $row->merk }}</span>
                                            </td>
                                            <td>
                                                @if ($row->stok <= 5)
                                                    <span class="badge rounded-pill px-2 py-1"
                                                        style="background-color: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid #ef4444;">{{ $row->stok }}</span>
                                                @else
                                                    <span class="badge rounded-pill px-2 py-1"
                                                        style="background-color: rgba(34, 197, 94, 0.15); color: #22c55e; border: 1px solid #22c55e;">{{ $row->stok }}</span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end fw-bold" style="color: #38bdf8;">
                                                Rp {{ number_format($row->harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5"
                                                style="color: var(--text-muted);">
                                                <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                                Belum ada data barang terdaftar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sistem Toggle Mobile Standar
        const menuToggle = document.getElementById('menuToggle');
        const layoutSidebar = document.getElementById('layoutSidebar');

        if (menuToggle && layoutSidebar) {
            menuToggle.addEventListener('click', function() {
                layoutSidebar.classList.toggle('active');
            });
        }
    </script>
</body>

</html>
