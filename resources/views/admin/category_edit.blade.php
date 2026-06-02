<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* --- GAYA DASAR DARI KODE ACUAN --- */
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

        /* --- SIDEBAR STYLING (PERSIS KODE ACUAN) --- */
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: none;
        }

        /* --- CARD & FORM STYLING (DIADOPSI DARI ACUAN + TAMBAHAN) --- */
        .card {
            background-color: var(--bg-card);
            border: none;
            border-radius: 12px;
        }

        .edit-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 2.5rem !important;
        }

        .form-control {
            background-color: var(--bg);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 10px 15px;
        }

        .form-control:focus {
            background-color: var(--bg);
            color: var(--text-main);
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* --- CUSTOM INPUT WRAPPER UNTUK FORM EDIT --- */
        .custom-input-wrapper {
            display: flex;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .custom-input-wrapper:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            background-color: rgba(0, 0, 0, 0.3);
        }

        .custom-input-wrapper i {
            padding: 0 16px;
            color: var(--text-muted);
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .custom-input-wrapper:focus-within i {
            color: #3b82f6;
        }

        .custom-input-wrapper input {
            background: transparent;
            border: none;
            color: var(--text-main);
            padding: 14px 16px 14px 0;
            width: 100%;
            outline: none;
            font-size: 0.95rem;
        }

        .custom-input-wrapper input::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }

        /* --- ICON BOX --- */
        .icon-box {
            width: 52px;
            height: 52px;
            background: rgba(59, 130, 246, 0.12);
            color: #3b82f6;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        /* --- TOMBOL --- */
        .btn-primary-custom {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }

        .btn-batal-custom {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-batal-custom:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* --- MODAL DARK THEME (DIADOPSI DARI ACUAN) --- */
        .modal-content {
            background-color: var(--bg-card);
            color: var(--text-main);
            border: 1px solid var(--border-color);
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

            .edit-card {
                padding: 1.5rem !important;
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

        {{-- MAIN CONTENT (FORM EDIT TETAP UTUH) --}}
        <div class="main-content" id="content">

            {{-- Navbar minimal --}}
            <nav class="navbar navbar-expand-lg rounded-3 mb-2 px-3" style="background-color: transparent;">
                <div class="container-fluid p-0">
                    <span class="navbar-text fw-semibold text-white d-none d-md-block">
                        Sistem Inventaris UNIBA Madura — Edit Kategori
                    </span>
                </div>
            </nav>

            <div class="container-fluid flex-grow-1 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="w-100" style="max-width: 460px;">

                    <div class="card edit-card">
                        <div class="icon-box">
                            <i class="bi bi-pencil-square fs-4"></i>
                        </div>

                        <h4 class="fw-bold text-white mb-2">Edit Kategori</h4>
                        <p class="small mb-4 pb-2" style="color: var(--text-muted); line-height: 1.6;">
                            Ubah nama kategori untuk memperbarui kelompok klasifikasi barang inventaris.
                        </p>

                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-5">
                                <label class="form-label fw-bold small text-uppercase"
                                    style="color: var(--text-muted); letter-spacing: 1px; font-size: 0.75rem;">
                                    Nama Kategori
                                </label>
                                <div class="custom-input-wrapper mt-1">
                                    <i class="bi bi-tag-fill"></i>
                                    <input type="text" name="nama_kategori" value="{{ $category->nama_kategori }}"
                                        placeholder="Misal: Elektronik, Furniture..." required>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.category.index') }}"
                                    class="btn btn-batal-custom text-center text-decoration-none">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>

                    <p class="text-center mt-4 small" style="color: var(--text-muted); opacity: 0.6;">
                        &copy; 2026 Informatika - UNIBA Madura
                    </p>

                </div>
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
