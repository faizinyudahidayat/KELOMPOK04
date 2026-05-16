<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan | INV-UNIBA</title>
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

        /* Sidebar Styling */
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

        /* Main Content Styling */
        .main-content {
            margin-left: 260px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }

        /* Top Navbar Mini Mobile */
        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: none;
        }

        /* Premium Card Styling */
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

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .mobile-nav { display: flex; }
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

    <div class="sidebar d-flex flex-column p-3" id="layoutSidebar">
        <h4 class="fw-bold text-center my-4">
            <i class="bi bi-box-seam-fill me-2 text-primary"></i>INV-UNIBA
        </h4>
        <hr class="opacity-10 mb-4">

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link active"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>

        <div class="mt-auto mb-3">
            <hr class="opacity-10">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid px-0">

            <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
                <div>
                    <h3 class="fw-bold m-0 text-white">Selamat Datang, {{ Auth::user()->name ?? 'Karyawan' }} 👋</h3>
                    <p class="text-muted m-0 small">Panel pemantauan dan pengajuan logistik internal UNIBA Madura.</p>
                </div>
                <div>
                    <a href="{{ route('karyawan.pengajuan.create') }}" class="btn btn-primary p-3 fw-bold rounded-3 shadow d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none;">
                        <i class="bi bi-plus-lg"></i> Buat Pengajuan Baru
                    </a>
                </div>
            </div>

            <div class="row g-4 mb-5">

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-4 h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary small fw-bold tracking-wider text-uppercase mb-1">Total Pengajuan</p>
                                <h2 class="fw-bold text-white m-0">{{ $total_pengajuan ?? 0 }}</h2>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2);">
                                <i class="bi bi-folder-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-4 h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary small fw-bold tracking-wider text-uppercase mb-1">Menunggu Verifikasi</p>
                                <h2 class="fw-bold text-warning m-0">{{ $pending_pengajuan ?? 0 }}</h2>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);">
                                <i class="bi bi-hourglass-split fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-4 h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary small fw-bold tracking-wider text-uppercase mb-1">Disetujui / Terverifikasi</p>
                                <h2 class="fw-bold text-success m-0">{{ $disetujui_pengajuan ?? 0 }}</h2>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2);">
                                <i class="bi bi-check-circle-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card p-4 h-100 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary small fw-bold tracking-wider text-uppercase mb-1">Permohonan Ditolak</p>
                                <h2 class="fw-bold text-danger m-0">{{ $ditolak_pengajuan ?? 0 }}</h2>
                            </div>
                            <div class="p-3 rounded-4" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);">
                                <i class="bi bi-x-circle-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card p-4 border-0" style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.75)); backdrop-filter: blur(15px); border-radius: 24px;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold text-white m-0">Riwayat Permohonan Terkini</h5>
                                <p class="text-muted small m-0">Daftar 5 pengajuan terakhir yang Anda lakukan.</p>
                            </div>
                            <a href="{{ route('karyawan.pengajuan.index') }}" class="btn btn-outline-secondary btn-sm rounded-3 text-white border-secondary border-opacity-40 px-3 py-2 small">
                                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle m-0" style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                                <thead>
                                    <tr class="text-secondary small text-uppercase tracking-wider">
                                        <th class="py-3 border-0">Tanggal</th>
                                        <th class="py-3 border-0">Nama Barang</th>
                                        <th class="py-3 border-0 text-center">Jumlah</th>
                                        <th class="py-3 border-0">Alasan</th>
                                        <th class="py-3 border-0 text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    {{-- Loop data riwayat asli dari controller --}}
                                    @forelse($riwayat_pengajuans ?? [] as $p)
                                    <tr>
                                        <td class="py-3 text-muted">{{ $p->created_at->format('d M Y') }}</td>
                                        <td class="py-3 fw-semibold text-white">{{ $p->barang->nama_barang }}</td>
                                        <td class="py-3 text-center text-info fw-bold">{{ $p->jumlah }}</td>
                                        <td class="py-3 text-muted text-truncate" style="max-width: 200px;">{{ $p->alasan }}</td>
                                        <td class="py-3 text-end">
                                            @if($p->status == 'pending')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-2 rounded-pill">Menunggu</span>
                                            @elseif($p->status == 'disetujui')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-pill">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-pill">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 opacity-40"></i>
                                            Belum ada riwayat pengajuan barang.
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
