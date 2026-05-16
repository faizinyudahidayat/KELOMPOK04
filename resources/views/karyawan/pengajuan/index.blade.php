<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan | Karyawan UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent-color: #3b82f6;
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --sidebar-bg: rgba(15, 23, 42, 0.95);
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            backdrop-filter: blur(15px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link i { font-size: 1.2rem; margin-right: 15px; }

        .nav-link:hover, .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent-color);
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 3rem;
            transition: all 0.3s ease-in-out;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
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
            background: var(--accent-color);
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

        /* Tombol Toggle Menu Mobile */
        .mobile-header {
            display: none;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Aturan Responsif Mobile (HP & Tablet) */
        @media (max-width: 991.98px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }
            .mobile-header {
                display: flex !important;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-dark); }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent-color); }
    </style>
</head>
<body>

    <div class="mobile-header w-100 px-4 py-3 align-items-center justify-content-between d-lg-none">
        <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-2">
                <i class="bi bi-box-seam-fill text-primary fs-5"></i>
            </div>
            <span class="fw-bold tracking-wide">INV-UNIBA</span>
        </div>
        <button class="btn text-white p-0" id="mobileMenuToggle">
            <i class="bi bi-list fs-2 text-primary"></i>
        </button>
    </div>

    <div class="sidebar d-flex flex-column" id="sidebarContainer">
        <div class="d-flex align-items-center justify-content-between mb-5 px-2">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                    <i class="bi bi-box-seam-fill text-primary fs-4"></i>
                </div>
                <h4 class="fw-bold m-0">INV-UNIBA</h4>
            </div>
            <button class="btn text-white d-lg-none p-0" id="mobileMenuClose">
                <i class="bi bi-x-lg fs-4"></i>
            </button>
        </div>

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link active">
            <i class="bi bi-send"></i> Riwayat Pengajuan
        </a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan Stok
        </a>

        <div class="mt-auto">
            <hr class="opacity-10">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-sm-end flex-column flex-sm-row gap-3 mb-4">
                <div>
                    <h2 class="fw-bold m-0">Riwayat Pengajuan</h2>
                    <p class="text-muted small mb-0">Pantau status permohonan inventaris Anda di sini.</p>
                </div>
                <a href="{{ route('karyawan.pengajuan.create') }}" class="btn btn-primary align-self-start align-self-sm-auto">
                    <i class="bi bi-plus-lg me-2"></i> Buat Pengajuan
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-4 mb-4 py-3 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="stat-card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th>Status Verifikasi</th>
                                <th>Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white bg-opacity-5 p-2 rounded-3 me-3 text-info">
                                            <i class="bi bi-box"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $p->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}</span>
                                    </div>
                                </td>
                                <td class="text-center fw-bold">{{ $p->jumlah }}</td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 text-uppercase" style="font-size: 0.7rem;">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>
                                    @elseif($p->status == 'verifikasi')
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 text-uppercase" style="font-size: 0.7rem;">
                                            <i class="bi bi-check2-circle me-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 text-uppercase" style="font-size: 0.7rem;">
                                            <i class="bi bi-x-circle me-1"></i> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                    <div class="text-white-50" style="font-size: 0.65rem;">{{ $p->created_at ? $p->created_at->format('H:i') : '--:--' }} WIB</div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-20"></i>
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
        // Logika Pengendali Buka/Tutup Navigasi Sidebar di Layar HP
        const menuToggle = document.getElementById('mobileMenuToggle');
        const menuClose = document.getElementById('mobileMenuClose');
        const sidebarContainer = document.getElementById('sidebarContainer');

        if (menuToggle && sidebarContainer) {
            menuToggle.addEventListener('click', () => {
                sidebarContainer.classList.add('show');
            });
        }

        if (menuClose && sidebarContainer) {
            menuClose.addEventListener('click', () => {
                sidebarContainer.classList.remove('show');
            });
        }
    </script>
</body>
</html>
