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
            --dark-color: #212529;
        }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background-color: var(--dark-color); box-shadow: 0 2px 4px rgba(0,0,0,.1); }
        .card { border: none; border-radius: 12px; transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .stat-card { color: white; }
        .menu-icon { font-size: 1.5rem; margin-right: 10px; }
        /* Style agar tabel bisa di-scroll di HP */
        .table-responsive { border-radius: 12px; background: white; padding: 15px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-box-seam-fill me-2"></i>
                <span class="fw-bold">INVENTARIS KEL 04</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-house-door"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-white p-4 rounded-4 shadow-sm d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-1">Selamat Datang, Admin! 👋</h4>
                        <p class="text-muted mb-0">Sistem Informasi Inventaris Barang - UNIBA Madura</p>
                    </div>
                    <div class="d-none d-md-block">
                        <span class="badge bg-primary px-3 py-2">Tahun Akademik 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-primary p-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Total Barang</p>
                            <h3 class="fw-bold mb-0">{{ $totalBarang }}</h3>
                        </div>
                        <i class="bi bi-box menu-icon opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-success p-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Kategori</p>
                            <h3 class="fw-bold mb-0">{{ $totalKategori }}</h3>
                        </div>
                        <i class="bi bi-tags menu-icon opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-warning p-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">Permintaan</p>
                            <h3 class="fw-bold mb-0 text-dark">5</h3>
                        </div>
                        <i class="bi bi-bell-fill menu-icon opacity-50 text-dark"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-info p-3 shadow-sm">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1 opacity-75">User</p>
                            <h3 class="fw-bold mb-0">12</h3>
                        </div>
                        <i class="bi bi-people-fill menu-icon opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Akses Cepat</h5>
                <div class="list-group shadow-sm border-0">
                    <a href="#" class="list-group-item list-group-item-action border-0 mb-1 rounded-3 p-3">
                        <i class="bi bi-plus-circle-fill text-primary me-2"></i> Tambah Barang Baru
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 mb-1 rounded-3 p-3">
                        <i class="bi bi-file-earmark-bar-graph text-success me-2"></i> Laporan Bulanan
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 mb-1 rounded-3 p-3">
                        <i class="bi bi-person-gear text-info me-2"></i> Pengaturan User
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <h5 class="fw-bold mb-3">Ringkasan Barang</h5>
                <div class="table-responsive shadow-sm">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Laptop ASUS ROG</td>
                                <td>ASUS</td>
                                <td><span class="badge bg-info">5 Unit</span></td>
                                <td><span class="badge bg-success">Tersedia</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Proyektor Epson</td>
                                <td>Epson</td>
                                <td><span class="badge bg-danger">0 Unit</span></td>
                                <td><span class="badge bg-danger">Habis</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted">
        <small>&copy; 2026 Kelompok 04 Informatika - UNIBA Madura</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
