<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Barang | Karyawan UNIBA</title>
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

        /* Sidebar Styling (Disamakan dengan Dashboard) */
        .sidebar {
            width: 260px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            border-right: 1px solid rgba(255,255,255,0.08);
            z-index: 1000;
            transition: all 0.3s ease;
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
        .nav-link:hover, .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
        }

        /* Main Content Styling (Disamakan dengan Dashboard) */
        .main-content {
            margin-left: 260px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }

        /* Top Navbar Mini Mobile (Disamakan dengan Dashboard) */
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

        /* Table Styling */
        .table { color: #e2e8f0; margin-bottom: 0; }
        .table thead th {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            font-weight: 700;
            color: #94a3b8;
            padding: 1.2rem 1rem;
        }
        .table tbody td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background: rgba(59, 130, 246, 0.05);
        }

        /* Responsive Breakpoints (Disamakan dengan Dashboard) */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .mobile-nav { display: flex; }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }
    </style>
</head>
<body>

    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-UNIBA</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="sidebar d-flex flex-column p-3" id="layoutSidebar">
        <h4 class="fw-bold text-center my-4">
            <i class="bi bi-box-seam-fill me-2 text-primary"></i>INV-UNIBA
        </h4>
        <hr class="opacity-10 mb-4">

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link {{ Request::is('karyawan/dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link {{ Request::is('karyawan/pengajuan*') && !Request::is('karyawan/pengajuan/create') ? 'active' : '' }}"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link {{ Request::is('karyawan/laporan*') ? 'active' : '' }} active"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>

        <div class="mt-auto mb-3">
            <hr class="opacity-10">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid px-0">

            <div class="mb-5">
                <h3 class="fw-bold m-0 text-white">Laporan Stok Barang</h3>
                <p class="text-muted m-0 small">Pantau ketersediaan logistik dan stok gudang real-time.</p>
            </div>

            <div class="stat-card p-4">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle m-0" style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                        <thead>
                            <tr class="text-secondary small text-uppercase tracking-wider">
                                <th class="py-3 border-0">Barang</th>
                                <th class="py-3 border-0">Kategori</th>
                                <th class="py-3 border-0 text-center">Stok</th>
                                <th class="py-3 border-0">Status Ketersediaan</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @forelse($barangs as $b)
                            <tr>
                                <td class="py-3">
                                    <span class="fw-bold text-info">{{ $b->nama_barang }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-white bg-opacity-10 text-white-50 fw-normal">
                                        {{ $b->category->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="fs-5 fw-bold">{{ $b->stok }}</span>
                                </td>
                                <td class="py-3" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        @if($b->stok > 10)
                                            <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Tersedia</span>
                                            <span class="text-muted small">{{ $b->stok }} unit</span>
                                        @elseif($b->stok > 0)
                                            <span class="text-warning small fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Menipis</span>
                                            <span class="text-muted small">{{ $b->stok }} unit</span>
                                        @else
                                            <span class="text-danger small fw-bold"><i class="bi bi-x-circle-fill me-1"></i> Habis</span>
                                            <span class="text-muted small">0 unit</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-white-50">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 text-primary opacity-75"></i>
                                    Tidak ada data barang yang tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="mt-5 text-center">
                <p class="text-muted small">&copy; 2026 Informatika UNIBA Madura - Inventory System</p>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JS Toggle Menu Mobile (Disamakan dengan sistem Dashboard)
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
