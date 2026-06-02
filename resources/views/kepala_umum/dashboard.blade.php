<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Umum | INV-UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --accent-color: #3b82f6;
            --bg-dark: #0b1426;
            --card-bg: rgba(19, 38, 70, 0.4);
            --sidebar-bg: #0b1426;
            --sidebar-active-bg: #132646;
            --sidebar-text-inactive: #94a3b8;
            --border-color: rgba(30, 41, 59, 0.5);
            --text-readable-muted: #94a3b8;
            --glass: rgba(30, 41, 59, 0.7);
        }

        body {
            background: radial-gradient(circle at top right, #132646, #0b1426);
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        .text-muted,
        .text-white-50 {
            color: var(--text-readable-muted) !important;
        }

        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            z-index: 1010;
            transition: transform 0.3s ease-in-out;
        }

        .nav-link {
            color: var(--sidebar-text-inactive);
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-weight: 500;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--sidebar-active-bg) !important;
            color: var(--accent-color) !important;
            font-weight: 600;
        }

        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 3rem;
            transition: all 0.3s ease-in-out;
        }

        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        .metric-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.5rem;
            transition: transform 0.3s;
        }

        .metric-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-header-dark {
            background: rgba(255, 255, 255, 0.02) !important;
            border-bottom: 1px solid var(--border-color) !important;
            padding: 1.2rem 1.5rem;
        }

        .card-header-dark h5 {
            color: #f8fafc !important;
        }

        .table-custom {
            background: transparent !important;
            color: #f8fafc !important;
            margin-bottom: 0;
        }

        .table-custom thead th {
            background: rgba(255, 255, 255, 0.04) !important;
            border-bottom: 1px solid var(--border-color) !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            font-weight: 700;
            color: #cbd5e1 !important;
            padding: 1.2rem 1rem;
        }

        .table-custom tbody td {
            background: transparent !important;
            padding: 1.2rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            color: #e2e8f0 !important;
            vertical-align: middle;
        }

        .table-custom-responsive {
            background: transparent;
            border-radius: 0 0 24px 24px;
            overflow: hidden;
        }

        .table-hover tbody tr:hover td {
            background: rgba(59, 130, 246, 0.08) !important;
            color: #ffffff !important;
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

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: #132646;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }
    </style>
</head>

<body>

    <!-- Mobile Nav -->
    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-UNIBA</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-4" id="layoutSidebar">
        <div class="d-flex align-items-center justify-content-between mb-5 px-2">
            <div class="d-flex align-items-center">
                <div class="p-2 rounded-3 me-3" style="background: rgba(59, 130, 246, 0.1);">
                    <i class="bi bi-box-seam-fill fs-4" style="color: #3b82f6;"></i>
                </div>
                <h4 class="fw-bold m-0 tracking-wider text-white" style="font-size: 1.2rem;">INV-UNIBA</h4>
            </div>
        </div>

        <div class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link active" id="tab-overview-button" data-bs-toggle="pill"
                data-bs-target="#panel-overview" type="button" role="tab">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard Overview
            </button>
            <button class="nav-link" id="tab-validasi-button" data-bs-toggle="pill" data-bs-target="#panel-validasi"
                type="button" role="tab">
                <i class="bi bi-check2-square"></i> Validasi Pengajuan
            </button>
            <button class="nav-link" id="tab-logistik-button" data-bs-toggle="pill" data-bs-target="#panel-logistik"
                type="button" role="tab">
                <i class="bi bi-graph-up-arrow"></i> Analisis Logistik
            </button>
            <button class="nav-link" id="tab-user-button" data-bs-toggle="pill" data-bs-target="#panel-user"
                type="button" role="tab">
                <i class="bi bi-people"></i> Manajemen User
            </button>
        </div>

        <div class="mt-auto">
            <hr class="opacity-10" style="border-color: var(--border-color);">
            <div class="px-2 mb-3 d-flex align-items-center">
                <div class="rounded-circle me-2"
                    style="width: 35px; height: 35px; background: #132646; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-fill text-white-50"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="small fw-bold m-0 text-truncate">{{ Auth::user()->name ?? 'Kepala Umum' }}</p>
                    <span class="text-white-50 p-0 m-0" style="font-size: 0.65rem;">General Manager</span>
                </div>
            </div>

            <a href="{{ route('logout') }}" class="nav-link text-danger m-0 p-2 hover:bg-danger-subtle">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold m-0 text-transparent bg-clip-text"
                        style="background: linear-gradient(to right, #3b82f6, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Sistem Kontrol Kepala Umum
                    </h2>
                    <p class="text-muted small mb-0">Selamat datang kembali. Berikut ringkasan aktivitas logistik
                        db_inventaris hari ini.</p>
                </div>
                <span class="badge bg-dark border border-secondary px-3 py-2 rounded-3 text-white-50">
                    <i class="bi bi-calendar3 me-2" style="color: #3b82f6;"></i>{{ date('d M Y') }}
                </span>
            </div>

            @if (session('success'))
                <div
                    class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-4 mb-4 py-3 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="tab-content" id="v-pills-tabContent">

                <!-- ========== PANEL OVERVIEW ========== -->
                <div class="tab-pane fade show active" id="panel-overview" role="tabpanel">
                    <div class="row g-4 mb-5">
                        <div class="col-6 col-lg-3">
                            <div class="metric-card d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3"
                                    style="background: rgba(234, 179, 8, 0.1); color: #eab308;">
                                    <i class="bi bi-hourglass-split fs-3"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-1">Butuh Validasi</p>
                                    <h3 class="fw-bold m-0">{{ $countPending ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="metric-card d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3"
                                    style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                                    <i class="bi bi-check2-all fs-3"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-1">Disetujui</p>
                                    <h3 class="fw-bold m-0">{{ $countVerified ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="metric-card d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3"
                                    style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                                    <i class="bi bi-box-seam fs-3"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-1">Total Item</p>
                                    <h3 class="fw-bold m-0">{{ $countBarang ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="metric-card d-flex align-items-center">
                                <div class="p-3 rounded-3 me-3"
                                    style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                                    <i class="bi bi-slash-circle-fill fs-3"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-1">Ditolak</p>
                                    <h3 class="fw-bold m-0">{{ $countDitolak ?? 0 }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-12 col-xl-7">
                            <div class="stat-card p-4 h-100">
                                <h5 class="fw-bold mb-3"><i class="bi bi-activity me-2"
                                        style="color: #3b82f6;"></i>Tren Grafik Pengajuan</h5>
                                <div style="height: 250px; position: relative;">
                                    <canvas id="trenChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-5">
                            <div class="stat-card p-4 h-100">
                                <h5 class="fw-bold mb-3"><i class="bi bi-diagram-3 me-2 text-info"></i>Konektivitas
                                    Jalur Role</h5>
                                <p class="text-muted small">Sistem ini menghubungkan arus persetujuan logistik
                                    terpusat:</p>
                                <div class="vstack gap-3 mt-4">
                                    <div
                                        class="p-3 rounded-3 border border-secondary bg-dark bg-opacity-40 d-flex align-items-center justify-content-between">
                                        <span class="small"><i class="bi bi-person me-2 text-info"></i>
                                            Karyawan</span>
                                        <span class="badge bg-info bg-opacity-10 text-info">Input Request</span>
                                    </div>
                                    <div class="text-center py-0 my-0"><i class="bi bi-arrow-down text-muted"></i>
                                    </div>
                                    <div class="p-3 rounded-3 border bg-dark bg-opacity-40 d-flex align-items-center justify-content-between"
                                        style="border-color: rgba(59, 130, 246, 0.4) !important;">
                                        <span class="small"><i class="bi bi-shield-lock me-2"
                                                style="color: #3b82f6;"></i> Kepala Umum</span>
                                        <span class="badge bg-primary bg-opacity-10" style="color: #3b82f6;">Validasi
                                            & ACC</span>
                                    </div>
                                    <div class="text-center py-0 my-0"><i class="bi bi-arrow-down text-muted"></i>
                                    </div>
                                    <div
                                        class="p-3 rounded-3 border border-secondary bg-dark bg-opacity-40 d-flex align-items-center justify-content-between">
                                        <span class="small"><i class="bi bi-person-gear me-2 text-success"></i> Admin
                                            / Finance</span>
                                        <span class="badge bg-success bg-opacity-10 text-success">Cetak & Kurangi
                                            Stok</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== PANEL VALIDASI ========== -->
                <div class="tab-pane fade" id="panel-validasi" role="tabpanel">
                    <div class="stat-card">
                        <div class="card-header-dark d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold m-0">
                                <i class="bi bi-lightning-charge-fill text-warning me-2"></i>Antrean Validasi Pengajuan
                                Terbaru
                            </h5>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 small">Real-time
                                Request</span>
                        </div>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Karyawan</th>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                        <th class="text-center">Aksi Operasional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingPengajuans as $p)
                                        <tr>
                                            <td><span
                                                    class="fw-bold text-white">{{ $p->user->name ?? 'Tanpa Nama' }}</span>
                                            </td>
                                            <td><span
                                                    class="text-info font-monospace">{{ $p->barang->nama_barang ?? 'Barang Terhapus' }}</span>
                                            </td>
                                            <td class="text-center fw-bold text-warning">{{ $p->jumlah }}</td>
                                            <td class="text-muted small">
                                                {{ $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-' }} WIB
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('kepala_umum.pengajuan.setujui', $p->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success rounded-3 px-3 me-1"
                                                        onclick="return confirm('Setujui pengajuan ini?')">
                                                        <i class="bi bi-check-lg"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('kepala_umum.pengajuan.tolak', $p->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger rounded-3 px-3"
                                                        onclick="return confirm('Tolak pengajuan ini?')">
                                                        <i class="bi bi-x"></i> Tolak
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-clipboard-check fs-1 d-block mb-3 opacity-20"></i>
                                                Tidak ada antrean validasi.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========== PANEL ANALISIS LOGISTIK ========== -->
                <div class="tab-pane fade" id="panel-logistik" role="tabpanel">
                    <div class="stat-card">
                        <div class="card-header-dark d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold m-0">
                                <i class="bi bi-graph-up-arrow me-2" style="color: #3b82f6;"></i>Rekap Status
                                Pengajuan Barang
                            </h5>
                            <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 small">Semua Status</span>
                        </div>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Karyawan</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($semuaPengajuans as $item)
                                        @php
                                            $status = $item->status;
                                            // Ubah status 'verifikasi' menjadi 'Disetujui' di tampilan
                                            if ($status == 'verifikasi') {
                                                $statusLabel = 'Disetujui';
                                                $badgeClass = 'bg-success bg-opacity-10 text-success';
                                            } else {
                                                $statusLabel = ucfirst($status);
                                                $badgeClass = match ($status) {
                                                    'disetujui', 'approved' => 'bg-success bg-opacity-10 text-success',
                                                    'ditolak', 'rejected' => 'bg-danger bg-opacity-10 text-danger',
                                                    default => 'bg-warning bg-opacity-10 text-warning',
                                                };
                                            }
                                        @endphp
                                        <tr>
                                            <td><span
                                                    class="fw-bold text-white">{{ $item->barang->nama_barang ?? 'Barang Terhapus' }}</span>
                                            </td>
                                            <td class="text-center fw-bold">{{ $item->jumlah }}</td>
                                            <td>{{ $item->user->name ?? 'Tanpa Nama' }}</td>
                                            <td><span
                                                    class="badge {{ $badgeClass }} px-2 py-1 rounded-pill">{{ $statusLabel }}</span>
                                            </td>
                                            <td class="text-muted small">
                                                {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                            <td class="text-muted small">{{ $item->keterangan ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-20"></i>
                                                Belum ada data pengajuan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-muted small mt-3"><i class="bi bi-info-circle me-1"></i> Tabel ini menampilkan
                        seluruh pengajuan barang yang sudah tercatat di sistem.</p>
                </div>

                <!-- ========== PANEL MANAJEMEN USER ========== -->
                <div class="tab-pane fade" id="panel-user" role="tabpanel">
                    <div class="stat-card">
                        <div class="card-header-dark d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold m-0">
                                <i class="bi bi-people-fill me-2" style="color: #60a5fa;"></i>Manajemen User
                            </h5>
                            <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 small">Total:
                                {{ count($users) }}</span>
                        </div>
                        <div class="table-responsive table-custom-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Terdaftar Sejak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        @php
                                            $roleClass = match ($user->role) {
                                                'kepala_umum', 'kepala-umum' => 'primary',
                                                'admin' => 'success',
                                                'finance' => 'info',
                                                'karyawan' => 'secondary',
                                                default => 'light',
                                            };
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="fw-bold text-white">{{ $user->name }}</span>
                                                @if ($user->id === Auth::id())
                                                    <span class="badge bg-primary bg-opacity-10 text-primary ms-2"
                                                        style="font-size: 0.7rem;">Anda</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $roleClass }} bg-opacity-10 text-{{ $roleClass }} px-2 py-1 rounded-pill">
                                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                                </span>
                                            </td>
                                            <td class="text-muted small">{{ $user->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-person-x fs-1 d-block mb-3 opacity-20"></i>
                                                Belum ada pengguna terdaftar.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p class="text-muted small mt-3"><i class="bi bi-info-circle me-1"></i> Menampilkan seluruh akun
                        terdaftar di sistem.</p>
                </div>

            </div>

            <footer class="mt-5 text-center">
                <p class="text-muted small">&copy; 2026 Informatika UNIBA Madura - Inventory System</p>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const layoutSidebar = document.getElementById('layoutSidebar');
        if (menuToggle && layoutSidebar) {
            menuToggle.addEventListener('click', function() {
                layoutSidebar.classList.toggle('active');
            });
        }

        const ctx = document.getElementById('trenChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
