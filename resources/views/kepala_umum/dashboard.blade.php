<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Umum | INV-UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent-color: #a855f7; /* Ungu khas untuk level manajemen/Kepala */
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
            background: rgba(168, 85, 247, 0.1);
            color: var(--accent-color);
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 3rem;
            transition: all 0.3s ease-in-out;
        }

        /* Card Metrics */
        .metric-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
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

        .mobile-header {
            display: none;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            body { flex-direction: column; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; padding: 1.5rem; }
            .mobile-header { display: flex !important; }
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
            <div class="bg-purple bg-opacity-10 p-2 rounded-3 me-2">
                <i class="bi bi-shield-lock-fill text-purple fs-5" style="color: #a855f7;"></i>
            </div>
            <span class="fw-bold tracking-wide">INV-UNIBA (KU)</span>
        </div>
        <button class="btn text-white p-0" id="mobileMenuToggle">
            <i class="bi bi-list fs-2 text-purple" style="color: #a855f7;"></i>
        </button>
    </div>

    <div class="sidebar d-flex flex-column" id="sidebarContainer">
        <div class="d-flex align-items-center justify-content-between mb-5 px-2">
            <div class="d-flex align-items-center">
                <div class="p-2 rounded-3 me-3" style="background: rgba(168, 85, 247, 0.1);">
                    <i class="bi bi-shield-lock-fill fs-4" style="color: #a855f7;"></i>
                </div>
                <h4 class="fw-bold m-0">KU-PANEL</h4>
            </div>
            <button class="btn text-white d-lg-none p-0" id="mobileMenuClose">
                <i class="bi bi-x-lg fs-4"></i>
            </button>
        </div>

        <a href="#" class="nav-link active">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard Overview
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-check2-square"></i> Validasi Pengajuan
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-graph-up-arrow"></i> Analisis Logistik
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-people"></i> Manajemen User
        </a>

        <div class="mt-auto">
            <hr class="opacity-10">
            <div class="px-2 mb-3 d-flex align-items-center">
                <div class="bg-secondary rounded-circle me-2" style="width: 35px; height: 35px; background: url('https://via.placeholder.com/150') center/cover;"></div>
                <div class="overflow-hidden">
                    <p class="small fw-bold m-0 text-truncate">{{ Auth::user()->name ?? 'Kepala Umum' }}</p>
                    <span class="text-white-50 p-0 m-0" style="font-size: 0.65rem;">General Manager</span>
                </div>
            </div>

            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left"></i> Sign Out
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">

            <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold m-0 text-transparent bg-clip-text" style="background: linear-gradient(to right, #a855f7, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Sistem Kontrol Kepala Umum
                    </h2>
                    <p class="text-muted small mb-0">Selamat datang kembali. Berikut ringkasan aktivitas logistik db_inventaris hari ini.</p>
                </div>
                <span class="badge bg-dark border border-secondary px-3 py-2 rounded-3 text-white-50">
                    <i class="bi bi-calendar3 me-2 text-purple" style="color: #a855f7;"></i>{{ date('d M Y') }}
                </span>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success rounded-4 mb-4 py-3 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="row g-4 mb-5">
                <div class="col-6 col-lg-3">
                    <div class="metric-card d-flex align-items-center">
                        <div class="p-3 rounded-3 me-3" style="background: rgba(234, 179, 8, 0.1); color: #eab308;">
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
                        <div class="p-3 rounded-3 me-3" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
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
                        <div class="p-3 rounded-3 me-3" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
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
                        <div class="p-3 rounded-3 me-3" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="bi bi-exclamation-octagon fs-3"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-1">Stok Kritis</p>
                            <h3 class="fw-bold m-0">{{ $countKritis ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12 col-xl-7">
                    <div class="stat-card p-4 h-100">
                        <h5 class="fw-bold mb-3"><i class="bi bi-activity me-2 text-purple" style="color: #a855f7;"></i>Tren Grafik Pengajuan</h5>
                        <div style="height: 250px; position: relative;">
                            <canvas id="trenChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="stat-card p-4 h-100">
                        <h5 class="fw-bold mb-3"><i class="bi bi-diagram-3 me-2 text-info"></i>Konektivitas Jalur Role</h5>
                        <p class="text-muted small">Sistem ini menghubungkan arus persetujuan logistik terpusat:</p>
                        <div class="vstack gap-3 mt-4">
                            <div class="p-3 rounded-3 border border-secondary bg-dark bg-opacity-40 d-flex align-items-center justify-content-between">
                                <span class="small"><i class="bi bi-person me-2 text-info"></i> Karyawan</span>
                                <span class="badge bg-info bg-opacity-10 text-info">Input Request</span>
                            </div>
                            <div class="text-center py-0 my-0"><i class="bi bi-arrow-down text-muted"></i></div>
                            <div class="p-3 rounded-3 border border-purple bg-dark bg-opacity-40 d-flex align-items-center justify-content-between" style="border-color: rgba(168, 85, 247, 0.4) !important;">
                                <span class="small"><i class="bi bi-shield-lock me-2" style="color: #a855f7;"></i> Kepala Umum</span>
                                <span class="badge bg-purple bg-opacity-10" style="color: #a855f7; background-color: rgba(168, 85, 247, 0.1)">Validasi & ACC</span>
                            </div>
                            <div class="text-center py-0 my-0"><i class="bi bi-arrow-down text-muted"></i></div>
                            <div class="p-3 rounded-3 border border-secondary bg-dark bg-opacity-40 d-flex align-items-center justify-content-between">
                                <span class="small"><i class="bi bi-person-gear me-2 text-success"></i> Admin / Finance</span>
                                <span class="badge bg-success bg-opacity-10 text-success">Cetak & Kurangi Stok</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="px-4 py-3 border-b border-secondary bg-white bg-opacity-5 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Antrean Validasi Pengajuan Terbaru</h5>
                    <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 small">Real-time Request</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
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
                                <td>
                                    <span class="fw-bold">{{ $p->user->name ?? 'Karyawan Tanpa Nama' }}</span>
                                </td>
                                <td>
                                    <span class="text-info">{{ $p->barang->nama_barang ?? 'Barang Terhapus' }}</span>
                                </td>
                                <td class="text-center fw-bold text-warning">{{ $p->jumlah }}</td>
                                <td class="text-muted small">
                                    {{ $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-' }} WIB
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('kepala_umum.pengajuan.setujui', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success rounded-3 px-3 me-1" onclick="return confirm('Apakah Anda yakin ingin MENYETUJUI pengajuan barang ini?')">
                                            <i class="bi bi-check-lg"></i> Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('kepala_umum.pengajuan.tolak', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger rounded-3 px-3" onclick="return confirm('Apakah Anda yakin ingin MENOLAK pengajuan barang ini?')">
                                            <i class="bi bi-x"></i> Tolak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-clipboard-check fs-1 d-block mb-3 opacity-20"></i>
                                    Besih! Tidak ada antrean pengajuan yang perlu divalidasi.
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // JS Toggle Menu Mobile
        const menuToggle = document.getElementById('mobileMenuToggle');
        const menuClose = document.getElementById('mobileMenuClose');
        const sidebarContainer = document.getElementById('sidebarContainer');

        if (menuToggle && sidebarContainer) {
            menuToggle.addEventListener('click', () => sidebarContainer.classList.add('show'));
        }
        if (menuClose && sidebarContainer) {
            menuClose.addEventListener('click', () => sidebarContainer.classList.remove('show'));
        }

        // Render Grafik Tren Pengajuan menggunakan Chart.js dengan tema gelap
        const ctx = document.getElementById('trenChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: [12, 19, 3, 5, 2, 3], // Isikan data dinamis dari Controller nanti
                    borderColor: '#a855f7',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } }
                }
            }
        });
    </script>
</body>
</html>
