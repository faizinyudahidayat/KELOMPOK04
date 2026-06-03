<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang | Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --accent: #3b82f6;
            --bg: #0f172a;
            --glass: rgba(30, 41, 59, 0.7);
            --bg-card: #151e2f;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.1);
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, var(--bg));
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- SIDEBAR STYLING --- */
        .sidebar {
            width: 280px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin: 5px 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link i {
            font-size: 1.15rem;
            margin-right: 14px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(59, 130, 246, 0.12);
            color: #3b82f6;
            font-weight: 600;
        }

        /* --- KONTEN UTAMA --- */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 2.5rem;
            transition: all 0.3s ease-in-out;
        }

        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        /* --- CARD STYLING --- */
        .card {
            background-color: var(--bg-card);
            border: none;
            border-radius: 12px;
        }

        /* --- FORM STYLING (DARK MODE) --- */
        .form-control,
        .form-select {
            background-color: var(--bg);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--bg);
            color: var(--text-main);
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }

        .form-select option {
            background-color: var(--bg-card);
            color: var(--text-main);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* --- RESPONSIVE MEDIA QUERIES --- */
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
    </style>
</head>

<body>

    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-ADMIN</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="d-flex">

        <div class="sidebar d-flex flex-column p-4" id="layoutSidebar">
            <div class="d-flex align-items-center mb-5 px-2">
                <div class="p-2 rounded-3 me-3" style="background: rgba(59, 130, 246, 0.1);">
                    <i class="bi bi-box-seam-fill fs-4" style="color: #3b82f6;"></i>
                </div>
                <div>
                    <h4 class="fw-bold m-0 text-white" style="font-size: 1.2rem; letter-spacing: 1px;">INV-UNIBA</h4>
                </div>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.barang.index') }}" class="nav-link active">
                <i class="bi bi-box-seam"></i> Kelola Barang
            </a>
            <a href="{{ route('admin.category.index') }}"
                class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Kelola Kategori
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola User
            </a>

            <div class="mt-auto">
                <hr class="opacity-10" style="border-color: rgba(255,255,255,0.08);">
                <div class="px-2 mb-3 d-flex align-items-center">
                    <div class="rounded-circle me-3"
                        style="width: 42px; height: 42px; background: rgba(59, 130, 246, 0.12); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(59,130,246,0.15);">
                        <i class="bi bi-person-fill text-white-50"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="small fw-bold m-0 text-white text-truncate">
                            {{ Auth::user()->name ?? 'Admin Faizin' }}
                        </p>
                        <span class="text-white-50" style="font-size: 0.72rem;">Administrator</span>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="nav-link text-danger m-0 p-2">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </div>

        <div class="main-content" id="content">

            <nav class="navbar navbar-expand-lg rounded-3 mb-4 shadow-sm px-3 d-none d-md-block"
                style="background-color: var(--bg-card);">
                <div class="container-fluid p-0">
                    <span class="navbar-text fw-semibold text-white">
                        Sistem Inventaris UNIBA Madura — Tambah Data Barang
                    </span>
                    <div class="ms-auto">
                        <span class="badge p-2 px-3 rounded-pill shadow-sm"
                            style="background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: #fff; font-weight: 500;">
                            <i class="bi bi-person-fill me-1" style="color: #3b82f6;"></i> Panel Admin
                        </span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-0">
                <div class="card p-4 shadow-sm" style="border: 1px solid var(--border-color);">
                    <h5 class="fw-bold text-white mb-4 border-bottom pb-3"
                        style="border-color: var(--border-color) !important;">
                        <i class="bi bi-plus-circle-fill text-primary me-2"></i>Form Tambah Inventaris Barang Baru
                    </h5>

                    <form action="{{ route('admin.barang.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: var(--text-muted);">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control rounded-3" required
                                placeholder="Contoh: Laptop ASUS ROG">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: var(--text-muted);">Merek</label>
                            <input type="text" name="merk" class="form-control rounded-3" required
                                placeholder="Contoh: ASUS">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: var(--text-muted);">Kategori</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                <option value="" selected disabled hidden>-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" style="color: var(--text-muted);">Stok
                                    Awal</label>
                                <input type="number" name="stok" class="form-control rounded-3" min="1"
                                    required placeholder="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold" style="color: var(--text-muted);">Harga Satuan
                                    (Rp)</label>
                                <input type="number" name="harga" class="form-control rounded-3" min="0"
                                    required placeholder="0">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold" style="color: var(--text-muted);">Spesifikasi
                                Singkat</label>
                            <textarea name="spesifikasi" class="form-control rounded-3" rows="4"
                                placeholder="Tuliskan spesifikasi teknis barang di sini..."></textarea>
                        </div>

                        <div class="d-flex gap-2 pt-2 border-top mt-2"
                            style="border-color: var(--border-color) !important; padding-top: 20px !important;">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm fw-medium">
                                <i class="bi bi-save me-1"></i> Simpan Barang
                            </button>
                            <a href="{{ route('admin.barang.index') }}" class="btn px-4 rounded-pill fw-medium"
                                style="background-color: rgba(255,255,255,0.05); color: var(--text-main); border: 1px solid var(--border-color);">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>
                </div>

                <footer class="mt-4 mb-3 py-3 text-center" style="color: var(--text-muted);">
                    <small>Dibuat oleh Kelompok 04 &copy; 2026 Informatika - UNIBA Madura</small>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sistem Toggle Mobile Standar
        const menuToggle = document.getElementById('menuToggle');
        const layoutSidebar = document.getElementById('layoutSidebar');

        if (menuToggle && layoutSidebar) {
            menuToggle.addEventListener('click', function() {
                layoutSidebar.classList.toggle('active');
            });
        }
    </script>
</body>

</html>
