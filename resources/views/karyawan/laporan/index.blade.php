<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Inventaris | Karyawan UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent-color: #3b82f6;
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --sidebar-bg: rgba(15, 23, 42, 0.9);
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
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
            z-index: 100;
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
            width: 100%;
            padding: 3rem;
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
        .table { color: #e2e8f0; margin-bottom: 0; border-color: rgba(255, 255, 255, 0.05); }
        .table thead th {
            background: rgba(255, 255, 255, 0.03);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            font-weight: 700;
            color: #94a3b8;
            padding: 1.2rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .table tbody td {
            padding: 1.2rem 1rem;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .progress {
            background: rgba(255, 255, 255, 0.1);
            height: 6px;
            border-radius: 10px;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-dark); }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <div class="d-flex align-items-center mb-5 px-2">
            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                <i class="bi bi-box-seam-fill text-primary fs-4"></i>
            </div>
            <h4 class="fw-bold m-0">INV-UNIBA</h4>
        </div>

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link">
            <i class="bi bi-send"></i> Riwayat Pengajuan
        </a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link active">
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

            <div class="mb-4">
                <h2 class="fw-bold m-0">Laporan Inventaris</h2>
                <p class="text-muted small">Data ketersediaan barang secara real-time.</p>
            </div>

            <div class="stat-card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th class="text-center">Sisa Stok</th>
                                <th>Status & Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $b)
                            <tr>
                                <td>
                                    <span class="fw-bold text-info">{{ $b->nama_barang }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-white bg-opacity-10 text-white-50 fw-normal">
                                        {{ $b->category->name }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fs-5 fw-bold">{{ $b->stok }}</span>
                                </td>
                                <td style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        @if($b->stok > 10)
                                            <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Tersedia</span>
                                            <span class="text-muted small">{{ $b->stok }} unit</span>
                                        @else
                                            <span class="text-warning small fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Menipis</span>
                                            <span class="text-muted small text-warning">{{ $b->stok }} unit</span>
                                        @endif
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar {{ $b->stok > 10 ? 'bg-primary' : 'bg-warning' }}"
                                             role="progressbar"
                                             style="width: {{ min(($b->stok / 100) * 100, 100) }}%">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
</body>
</html>
