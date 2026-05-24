<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan | Karyawan UNIBA</title>
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

        .btn-primary {
            background: var(--accent);
            border: none;
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .badge {
            font-weight: 600;
            border-radius: 8px;
            letter-spacing: 0.5px;
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
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link {{ Request::is('karyawan/pengajuan*') && !Request::is('karyawan/pengajuan/create') ? 'active' : '' }} active"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link {{ Request::is('karyawan/laporan*') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>

        <div class="mt-auto mb-3">
            <hr class="opacity-10">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid px-0">

            <div class="d-flex justify-content-between align-items-sm-end flex-column flex-sm-row gap-3 mb-5">
                <div>
                    <h3 class="fw-bold m-0 text-white">Riwayat Pengajuan</h3>
                    <p class="text-muted small m-0">Pantau status permohonan inventaris Anda di sini.</p>
                </div>
                <a href="{{ route('karyawan.pengajuan.create') }}" class="btn btn-primary p-3 fw-bold rounded-3 shadow d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none;">
                    <i class="bi bi-plus-lg"></i> Buat Pengajuan
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mb-4 text-white" role="alert" style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3) !important;">
                    <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="stat-card p-4">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle m-0" style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                        <thead>
                            <tr class="text-secondary small text-uppercase tracking-wider">
                                <th class="py-3 border-0">Barang</th>
                                <th class="py-3 border-0 text-center">Jumlah</th>
                                <th class="py-3 border-0">Status Verifikasi</th>
                                <th class="py-3 border-0">Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @forelse($pengajuans as $p)
                            <tr>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white bg-opacity-5 p-2 rounded-3 me-3 text-info">
                                            <i class="bi bi-box"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $p->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 text-center fw-bold text-info">{{ $p->jumlah }} Unit</td>
                                <td class="py-3">
                                    @if($p->status == 'pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-2 rounded-pill">
                                            <i class="bi bi-clock-history me-1"></i> Menunggu
                                        </span>
                                    @elseif($p->status == 'verifikasi' || $p->status == 'selesai')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-pill">
                                            <i class="bi bi-check2-circle me-1"></i> Disetujui
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle me-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                    <div class="text-white-50" style="font-size: 0.65rem;">{{ $p->created_at ? $p->created_at->format('H:i') : '--:--' }} WIB</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-white-50">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 text-primary opacity-75"></i>
                                    Belum ada riwayat pengajuan barang.
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
