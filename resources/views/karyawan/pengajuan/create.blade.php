<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan | INV-UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent: #3b82f6;
            --bg: #0f172a;
            --glass: rgba(30, 41, 59, 0.7);
        }
        body {
            background: radial-gradient(circle at top right, #1e293b, var(--bg));
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(15px);
            height: 100vh;
            position: fixed;
            border-right: 1px solid rgba(255,255,255,0.08);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 5px 15px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(59, 130, 246, 0.1);
            color: var(--accent);
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 260px;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }

        /* Top Navbar Mini Mobile */
        .mobile-nav {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: none;
        }

        /* Form Custom Premium Input Styles */
        .custom-input {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important; /* Menaikkan kontras border input */
            color: #ffffff !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        /* Penyesuaian warna teks placeholder agar tidak samar */
        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.45) !important;
            opacity: 1;
        }
        .custom-addon {
            background-color: rgba(15, 23, 42, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
        }
        .custom-input:focus {
            background-color: rgba(15, 23, 42, 0.9) !important;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.18) !important;
            color: #ffffff !important;
        }
        .input-group:focus-within .custom-addon {
            border-color: #3b82f6 !important;
        }
        .custom-btn-submit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            transition: all 0.3s ease;
        }
        .custom-btn-submit:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35) !important;
            transform: translateY(-1px);
        }
        .custom-btn-back {
            transition: all 0.3s ease;
        }
        .custom-btn-back:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #f8fafc !important;
            border-color: rgba(255, 255, 255, 0.3);
        }
        .custom-input.is-invalid {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15) !important;
        }

        /* Responsive Breakpoints */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .mobile-nav { display: flex; }
        }
    </style>
</head>
<body>

    <div class="mobile-nav w-100 p-3 justify-content-between align-items-center d-md-none">
        <h5 class="fw-bold m-0"><i class="bi bi-box-seam-fill text-primary me-2"></i>INV-UNIBA</h5>
        <button class="btn btn-outline-light btn-sm" id="menuToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>

    <div class="sidebar d-flex flex-column p-3" id="layoutSidebar">
        <h4 class="fw-bold text-center my-4">
            <i class="bi bi-box-seam-fill me-2 text-primary"></i>INV-UNIBA
        </h4>
        <hr class="opacity-10 mb-4">

        <a href="{{ route('karyawan.dashboard') }}" class="nav-link {{ Request::is('karyawan/dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link {{ Request::is('karyawan/pengajuan*') ? 'active' : '' }} active"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link {{ Request::is('karyawan/laporan*') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>

        <div class="mt-auto mb-3">
            <hr class="opacity-10">
            <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid px-0">

            <div class="mb-4">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}" class="text-decoration-none text-white-50 small">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('karyawan.pengajuan.index') }}" class="text-decoration-none text-white-50 small">Pengajuan</a></li>
                        <li class="breadcrumb-item active text-info small fw-semibold" aria-current="page">Buat Permohonan</li>
                    </ol>
                </nav>
                <h3 class="fw-bold m-0 text-white">Formulir Permohonan Logistik</h3>
            </div>

            <div class="row">
                <div class="col-12 col-xl-6 col-lg-8">
                    <div class="card p-4 shadow-lg position-relative border-0"
                         style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.75)); backdrop-filter: blur(15px); border-radius: 24px;">

                        <div class="position-absolute top-0 start-0 w-100 rounded-top-5" style="height: 4px; background: linear-gradient(90deg, #3b82f6, #00f2fe);"></div>

                        <div class="d-flex align-items-center mb-4 mt-2">
                            <div class="p-3 rounded-4 me-3 d-flex align-items-center justify-content-center"
                                 style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.25); color: #3b82f6;">
                                <i class="bi bi-file-earmark-plus fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold m-0 text-white">Detail Permohonan</h5>
                                <p class="text-white-50 small m-0">Silakan tentukan logistik yang ingin Anda ajukan.</p>
                            </div>
                        </div>

                        <form action="{{ route('karyawan.pengajuan.store') }}" method="POST" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="barang_id" class="form-label text-light small fw-bold tracking-wider text-uppercase">Pilih Komoditas / Barang</label>
                                <select name="barang_id"
                                        id="barang_id"
                                        class="form-select custom-input p-3 text-white rounded-3 @error('barang_id') is-invalid @enderror"
                                        required>
                                    <option value="" disabled selected hidden class="text-white-50">-- Pilih Inventaris Tersedia --</option>
                                    @foreach($barangs as $b)
                                        <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }} class="bg-dark text-white">
                                            {{ $b->nama_barang }} (Tersedia: {{ $b->stok }} Unit)
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label text-light small fw-bold tracking-wider text-uppercase">Kuantitas Permintaan</label>
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 px-3 custom-addon">
                                        <i class="bi bi-calculator-fill text-primary"></i>
                                    </span>
                                    <input type="number"
                                           name="jumlah"
                                           id="jumlah"
                                           class="form-control custom-input p-3 text-white rounded-end-3 @error('jumlah') is-invalid @enderror"
                                           placeholder="Contoh: 2"
                                           min="1"
                                           value="{{ old('jumlah') }}"
                                           required>
                                </div>
                                @error('jumlah')
                                    <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alasan" class="form-label text-light small fw-bold tracking-wider text-uppercase">Justifikasi / Alasan Keperluan</label>
                                <textarea name="alasan"
                                          id="alasan"
                                          class="form-control custom-input p-3 text-white rounded-3 @error('alasan') is-invalid @enderror"
                                          placeholder="Tuliskan alasan operasional penggunaan secara rinci..."
                                          rows="4"
                                          style="resize: none;"
                                          required>{{ old('alasan') }}</textarea>
                                @error('alasan')
                                    <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row g-3 pt-2">
                                <div class="col-md-4 order-md-1">
                                    <a href="{{ route('karyawan.pengajuan.index') }}"
                                       class="btn btn-outline-secondary w-100 p-3 fw-semibold rounded-3 text-white border-secondary border-opacity-40 custom-btn-back">
                                        Batal
                                    </a>
                                </div>
                                <div class="col-md-8 order-md-2">
                                    <button type="submit"
                                            class="btn btn-primary w-100 p-3 fw-bold rounded-3 shadow d-flex align-items-center justify-content-center gap-2 custom-btn-submit">
                                        <i class="bi bi-send-check"></i> Submit Permohonan
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const layoutSidebar = document.getElementById('layoutSidebar');
        if(menuToggle && layoutSidebar) {
            menuToggle.addEventListener('click', function() {
                layoutSidebar.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
