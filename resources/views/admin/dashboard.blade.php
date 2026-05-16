<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Dashboard | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --dark-sidebar: #1e293b;
        }
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; overflow-x: hidden; }

        /* Sidebar Styling */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: var(--dark-sidebar);
            transition: all 0.3s;
            color: white;
        }
        #sidebar .sidebar-header { padding: 20px; background: #0f172a; }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a {
            padding: 12px 25px;
            display: block;
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
        }
        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: white;
            background: #334155;
            border-left: 4px solid var(--primary-color);
        }
        #sidebar ul li a i { margin-right: 10px; }

        /* Main Content Styling */
        #content { width: 100%; padding: 20px; transition: all 0.3s; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .stat-card { color: white; border-radius: 15px; }

        /* Responsive Sidebar */
        @media (max-width: 768px) {
            #sidebar { margin-left: -250px; position: fixed; z-index: 1000; }
            #sidebar.active { margin-left: 0; }
            #content { padding: 15px; }
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <i class="bi bi-box-seam-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold">INV-KEL04</h5>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Request::is('karyawan/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('karyawan.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('karyawan/pengajuan/create') ? 'active' : '' }}">
                    <a href="{{ route('karyawan.pengajuan.create') }}"><i class="bi bi-plus-circle"></i> Ajukan Barang</a>
                </li>
                <li class="{{ Request::is('karyawan/pengajuan') ? 'active' : '' }}">
                    <a href="{{ route('karyawan.pengajuan.index') }}"><i class="bi bi-clock-history"></i> Riwayat Pengajuan</a>
                </li>
                <li class="{{ Request::is('karyawan/laporan') ? 'active' : '' }}">
                    <a href="{{ route('karyawan.laporan.index') }}"><i class="bi bi-file-earmark-bar-graph"></i> Lihat Stok</a>
                </li>
                <li class="mt-5">
                    <a href="{{ route('logout') }}" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-4 mb-4 shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary d-md-none">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="navbar-text ms-2 d-none d-md-block fw-bold text-dark">
                        Sistem Inventaris UNIBA Madura — Panel Karyawan
                    </span>
                    <div class="ms-auto">
                        <span class="badge bg-light text-dark p-2 rounded-pill shadow-sm border">
                            <i class="bi bi-person-circle me-1 text-primary"></i> {{ Auth::user()->name ?? 'Karyawan' }}
                        </span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-primary p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Total Pengajuan</small>
                                    <h2 class="fw-bold mb-0">{{ $totalPengajuan }}</h2>
                                </div>
                                <i class="bi bi-folder fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-warning p-3 text-dark">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Menunggu</small>
                                    <h2 class="fw-bold mb-0">{{ $pengajuanPending }}</h2>
                                </div>
                                <i class="bi bi-hourglass-split fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-success p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Disetujui</small>
                                    <h2 class="fw-bold mb-0">{{ $pengajuanDisetujui }}</h2>
                                </div>
                                <i class="bi bi-patch-check fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-danger p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Ditolak</small>
                                    <h2 class="fw-bold mb-0">{{ $pengajuanDitolak }}</h2>
                                </div>
                                <i class="bi bi-x-circle fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0 text-dark">Riwayat Permohonan Terkini</h5>
                            <a href="{{ route('karyawan.pengajuan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                <i class="bi bi-plus-lg me-1"></i> Buat Pengajuan
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary">
                                    <tr>
                                        <th class="ps-4">Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Catatan/Alasan Tolak</th>
                                        <th class="pe-4 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatPengajuans as $row)
                                    <tr>
                                        <td class="ps-4 text-muted small">
                                            {{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}
                                        </td>
                                        <td class="fw-medium text-dark">
                                            {{ $row->barang->nama_barang ?? 'Barang Terhapus' }}
                                        </td>
                                        <td><span class="badge bg-light text-dark border">{{ $row->jumlah }} Unit</span></td>
                                        <td class="text-secondary small">
                                            @if($row->status == 'ditolak')
                                                <span class="text-danger fw-medium">{{ $row->alasan_tolak ?? 'Ditolak Kepala Umum' }}</span>
                                            @else
                                                {{ Str::limit($row->alasan, 40) }}
                                            @endif
                                        </td>
                                        <td class="pe-4 text-center">
                                            @if($row->status == 'pending')
                                                <span class="badge bg-warning-subtle text-warning border border-warning px-3 py-2 rounded-pill">Menunggu</span>
                                            @elseif($row->status == 'verifikasi' || $row->status == 'selesai')
                                                <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill">Disetujui</span>
                                            @elseif($row->status == 'ditolak')
                                                <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-2 rounded-pill">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 text-opacity-50"></i>
                                            Belum ada riwayat pengajuan barang yang kamu buat.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <footer class="mt-5 py-4 text-center text-muted border-top">
                    <small>Dibuat oleh Kelompok 04 &copy; 2026 Informatika - UNIBA Madura</small>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk Toggle Sidebar di HP
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
