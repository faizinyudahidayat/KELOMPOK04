<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Inventaris UNIBA</title>
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
            transition: all 0.3s ease-in-out;
            color: white;
            position: relative;
            z-index: 1005;
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
        #content { width: 100%; padding: 20px; transition: all 0.3s ease-in-out; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .stat-card { color: white; border-radius: 15px; }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
        }
        .sidebar-overlay.show { display: block; }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
            }
            #sidebar.active { margin-left: 0; }
            #content { padding: 15px; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <i class="bi bi-shield-lock-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold">INV-ADMIN</h5>
                <small class="text-muted text-uppercase tracking-wider" style="font-size: 10px;">Kelompok 04</small>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/barang*') ? 'active' : '' }}">
                    <a href="{{ route('admin.barang.index') }}"><i class="bi bi-box-seam"></i> Kelola Barang</a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}"><i class="bi bi-tags"></i> Kelola Kategori</a>
                </li>

                <li class="mt-5">
                    <a href="{{ route('logout') }}" class="text-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
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
                        Sistem Inventaris UNIBA Madura — Panel Utama Admin
                    </span>
                    <div class="ms-auto">
                        <span class="badge bg-light text-dark p-2 rounded-pill shadow-sm border">
                            <i class="bi bi-person-badge me-1 text-primary"></i> {{ Auth::user()->name ?? 'Administrator' }}
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
                                    <small class="opacity-75">Total Barang</small>
                                    <h2 class="fw-bold mb-0">{{ $totalBarang }}</h2>
                                </div>
                                <i class="bi bi-box fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-info p-3 text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Total Kategori</small>
                                    <h2 class="fw-bold mb-0">{{ $totalKategori }}</h2>
                                </div>
                                <i class="bi bi-tags fs-1 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card stat-card bg-warning p-3 text-dark">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="opacity-75">Total Pengajuan</small>
                                    <h2 class="fw-bold mb-0">{{ $totalPengajuan }}</h2>
                                </div>
                                <i class="bi bi-file-earmark-text fs-1 opacity-25"></i>
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
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="card bg-white p-3 border-start border-warning border-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted d-block small">Pengajuan Menunggu Konfirmasi</span>
                                    <h4 class="fw-bold text-warning mb-0">{{ $pengajuanPending }} <span class="fs-6 fw-normal text-muted">Kasus</span></h4>
                                </div>
                                <i class="bi bi-hourglass-split text-warning fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-white p-3 border-start border-danger border-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted d-block small">Pengajuan Telah Ditolak</span>
                                    <h4 class="fw-bold text-danger mb-0">{{ $pengajuanDitolak }} <span class="fs-6 fw-normal text-muted">Kasus</span></h4>
                                </div>
                                <i class="bi bi-x-circle text-danger fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0 text-dark">5 Barang yang Baru Ditambahkan</h5>
                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori Baru
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Nama Barang</th>
                                        <th>Merek</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th class="pe-4 text-end">Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allBarang as $index => $barang)
                                    <tr>
                                        <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                                        <td class="fw-medium text-dark">{{ $barang->nama_barang }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $barang->merk }}</span></td>
                                        <td>{{ $barang->category->nama_kategori ?? 'Tanpa Kategori' }}</td>
                                        <td>
                                            @if($barang->stok <= 5)
                                                <span class="badge bg-danger-subtle text-danger border border-danger">{{ $barang->stok }} Unit (Kritis)</span>
                                            @else
                                                <span class="badge bg-success-subtle text-success border border-success">{{ $barang->stok }} Unit</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end fw-bold text-secondary">
                                            Rp {{ number_format($barang->harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 text-opacity-50"></i>
                                            Belum ada data inventaris barang terdaftar di sistem.
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

    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalTambahKategoriLabel"><i class="bi bi-tags-fill text-primary me-2"></i>Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-4">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold text-secondary">Nama Kategori</label>
                            <input type="text" class="form-control rounded-3" id="nama_kategori" name="nama_kategori" required placeholder="Contoh: ATK, Elektronik, Medis">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if(sidebarCollapse && sidebar && sidebarOverlay) {
            sidebarCollapse.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('show');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('show');
            });
        }
    </script>
</body>
</html>
