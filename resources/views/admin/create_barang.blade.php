<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang | Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --dark-sidebar: #1e293b;
        }
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; overflow-x: hidden; }

        /* Sidebar Styling (Sama Persis dengan Dashboard) */
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
                        Sistem Inventaris UNIBA Madura — Tambah Data
                    </span>
                    <div class="ms-auto">
                        <span class="badge bg-light text-dark p-2 rounded-pill shadow-sm border">
                            <i class="bi bi-box-seam me-1 text-primary"></i> Panel Admin
                        </span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="card p-4 shadow-sm">
                    <h5 class="fw-bold text-dark mb-4">
                        <i class="bi bi-plus-circle-fill text-primary me-2"></i>Form Tambah Inventaris Barang Baru
                    </h5>

                    <form action="{{ route('admin.barang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required placeholder="Contoh: Laptop ASUS ROG">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merek</label>
                            <input type="text" name="merk" class="form-control" required placeholder="Contoh: ASUS">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Stok Awal</label>
                                <input type="number" name="stok" class="form-control" min="1" required placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                                <input type="number" name="harga" class="form-control" min="0" required placeholder="0">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Spesifikasi Singkat</label>
                            <textarea name="spesifikasi" class="form-control" rows="3" placeholder="Spesifikasi teknis barang..."></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Simpan Barang</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light px-4 rounded-pill border">Kembali</a>
                        </div>
                    </form>
                </div>

                <footer class="mt-5 py-4 text-center text-muted border-top">
                    <small>Dibuat oleh Kelompok 04 &copy; 2026 Informatika - UNIBA Madura</small>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logika JavaScript agar Sidebar bisa dibuka-tutup dengan mulus di perangkat HP
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
