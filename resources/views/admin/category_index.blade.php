<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* --- CSS PERSIS DARI KODE ACUAN --- */
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

        /* --- SIDEBAR STYLING (MENGIKUTI KODE 1) --- */
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

        /* --- CARD & TABLES STYLING --- */
        .card {
            background-color: var(--bg-card);
            border: none;
            border-radius: 12px;
        }

        .stat-card {
            color: white;
            border-radius: 12px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .table-dark-custom th {
            color: var(--text-muted) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color) !important;
            background-color: transparent !important;
        }

        .table-dark-custom td {
            background-color: transparent !important;
            color: var(--text-main) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            padding: 16px 8px;
            vertical-align: middle;
        }

        .table-dark-custom tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.02) !important;
        }

        .badge-kategori {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--text-main);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* --- MODAL DARK THEME --- */
        .modal-content {
            background-color: var(--bg-card);
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }

        .form-control {
            background-color: var(--bg);
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .form-control:focus {
            background-color: var(--bg);
            color: var(--text-main);
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }

        .btn-close {
            filter: invert(1);
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

    {{-- MOBILE NAV --}}
    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-ADMIN</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="d-flex">
        {{-- SIDEBAR PERSIS DARI KODE ACUAN --}}
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
            <a href="{{ route('admin.barang.index') }}"
                class="nav-link {{ Request::is('admin/barang*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Kelola Barang
            </a>
            <a href="{{ route('admin.category.index') }}"
                class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i> Kelola Kategori
            </a>

            {{-- Bagian bawah --}}
            <div class="mt-auto">
                <hr class="opacity-10" style="border-color: rgba(255,255,255,0.08);">
                <div class="px-2 mb-3 d-flex align-items-center">
                    <div class="rounded-circle me-3"
                        style="
                            width: 42px;
                            height: 42px;
                            background: rgba(59, 130, 246, 0.12);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border: 1px solid rgba(59,130,246,0.15);
                        ">
                        <i class="bi bi-person-fill text-white-50"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="small fw-bold m-0 text-white text-truncate">
                            {{ Auth::user()->name ?? 'Admin Faizin' }}
                        </p>
                        <span class="text-white-50" style="font-size: 0.72rem;">
                            Administrator
                        </span>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="nav-link text-danger m-0 p-2">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </div>

        {{-- MAIN CONTENT (ISI TETAP SEPERTI KODE KATEGORI) --}}
        <div class="main-content" id="content">
            <nav class="navbar navbar-expand-lg rounded-3 mb-4 shadow-sm px-3"
                style="background-color: var(--bg-card);">
                <div class="container-fluid p-0">
                    <span class="navbar-text fw-semibold text-white">
                        Sistem Inventaris UNIBA Madura — Manajemen Kategori
                    </span>
                    <div class="ms-auto">
                        <span class="badge p-2 px-3 rounded-pill shadow-sm"
                            style="background-color: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: #fff; font-weight: 500;">
                            <i class="bi bi-tags-fill me-1" style="color: #3b82f6;"></i> Kategori
                        </span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-0">

                @if ($errors->any())
                    <div class="alert alert-dismissible fade show rounded-3 mb-4 border-0" role="alert"
                        style="background-color: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2) !important;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-dismissible fade show rounded-3 mb-4 border-0" role="alert"
                        style="background-color: rgba(34, 197, 94, 0.15); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.2) !important;">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row g-4">

                    <div class="col-md-8">
                        <div class="card shadow-sm" style="border: 1px solid var(--border-color);">
                            <div class="card-header bg-transparent py-3 border-bottom d-flex justify-content-between align-items-center"
                                style="border-color: var(--border-color) !important;">
                                <h5 class="fw-bold mb-0 text-white">Daftar Kategori Barang</h5>
                                <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm fw-medium"
                                    data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-dark-custom mb-0">
                                        <thead>
                                            <tr>
                                                <th class="ps-4" style="width: 80px;">No</th>
                                                <th>Nama Kategori</th>
                                                <th class="text-center" style="width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $key => $cat)
                                                <tr>
                                                    <td class="ps-4" style="color: var(--text-muted);">
                                                        {{ $key + 1 }}</td>
                                                    <td>
                                                        <span class="badge px-3 py-2 rounded-pill fw-medium"
                                                            style="background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2);">
                                                            <i class="bi bi-tag-fill me-1"></i>
                                                            {{ $cat->nama_kategori }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-inline-flex gap-2">
                                                            <a href="{{ route('admin.category.edit', $cat->id) }}"
                                                                class="btn btn-sm btn-outline-warning rounded-circle d-flex align-items-center justify-content-center"
                                                                style="width: 32px; height: 32px; padding: 0;">
                                                                <i class="bi bi-pencil"
                                                                    style="font-size: 0.85rem;"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('admin.category.destroy', $cat->id) }}"
                                                                method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center"
                                                                    style="width: 32px; height: 32px; padding: 0;">
                                                                    <i class="bi bi-trash"
                                                                        style="font-size: 0.85rem;"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-5"
                                                        style="color: var(--text-muted);">
                                                        <i class="bi bi-inbox fs-2 d-block mb-2 opacity-50"></i>
                                                        Belum ada kategori yang terdaftar.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stat card total kategori --}}
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm overflow-hidden h-100 d-flex flex-column justify-content-between"
                            style="background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%); border: 1px solid rgba(255,255,255,0.05) !important;">
                            <div class="card-body p-4 position-relative">
                                <h6 class="text-uppercase tracking-wider fw-medium" style="color: #93c5fd;">Total
                                    Kategori</h6>
                                <h1 class="fw-bold display-4 my-2 text-white">{{ count($categories) }}</h1>
                                <i class="bi bi-tags position-absolute end-0 bottom-0 opacity-10 me-3 mb-2"
                                    style="font-size: 5.5rem; color: #fff;"></i>
                            </div>
                            <div class="card-footer bg-black bg-opacity-20 border-0 py-3"
                                style="border-top: 1px solid rgba(255,255,255,0.05) !important;">
                                <p class="small mb-0" style="color: #94a3b8;"><i
                                        class="bi bi-info-circle me-1 text-primary"></i> Digunakan untuk pengelompokan
                                    komponen aset logistik.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <footer class="mt-5 py-4 text-center"
                    style="color: var(--text-muted); border-top: 1px solid var(--border-color);">
                    <small>Dibuat oleh Kelompok 04 &copy; 2026 Informatika - UNIBA Madura</small>
                </footer>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH KATEGORI --}}
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-white" id="modalTambahKategoriLabel">
                        <i class="bi bi-tags-fill text-primary me-2"></i>Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body py-4">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold"
                                style="color: var(--text-muted);">Nama Kategori</label>
                            <input type="text" class="form-control rounded-3" id="nama_kategori"
                                name="nama_kategori" required placeholder="Contoh: ATK, Elektronik, Medis">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn px-4 rounded-pill fw-medium" data-bs-dismiss="modal"
                            style="background-color: rgba(255,255,255,0.05); color: var(--text-main); border: 1px solid var(--border-color);">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm fw-medium">Simpan
                            Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle mobile sidebar persis seperti kode acuan
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
