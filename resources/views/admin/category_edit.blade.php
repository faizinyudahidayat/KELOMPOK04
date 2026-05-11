<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --dark-sidebar: #1e293b;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }
        body {
            background: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: var(--dark-sidebar);
            color: white;
        }
        #sidebar .sidebar-header { padding: 20px; background: #0f172a; }
        #sidebar ul li a {
            padding: 12px 25px;
            display: block;
            color: #94a3b8;
            text-decoration: none;
            transition: 0.3s;
        }
        #sidebar ul li a:hover {
            color: white;
            background: #334155;
            border-left: 4px solid var(--primary-color);
        }

        /* Form Card Styling */
        .edit-card {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .form-control {
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            transition: all 0.3s shadow;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border-color: var(--primary-color);
        }
        .icon-box {
            width: 50px;
            height: 50px;
            background: rgba(13, 110, 253, 0.1);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <nav id="sidebar" class="d-none d-md-block">
        <div class="sidebar-header text-center">
            <i class="bi bi-box-seam-fill fs-2 text-primary"></i>
            <h5 class="mt-2 fw-bold">INV-KEL04</h5>
        </div>
        <ul class="list-unstyled components mt-3">
            <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.category.index') }}"><i class="bi bi-tags me-2"></i> Kembali</a></li>
        </ul>
    </nav>

    <div class="container-fluid p-4">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">

                <a href="{{ route('admin.category.index') }}" class="btn btn-link text-decoration-none text-muted mb-3 p-0">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>

                <div class="card edit-card p-4">
                    <div class="icon-box">
                        <i class="bi bi-pencil-square fs-4"></i>
                    </div>

                    <h4 class="fw-bold text-dark mb-1">Edit Kategori</h4>
                    <p class="text-muted small mb-4">Ubah nama kategori sesuai dengan kelompok barang.</p>

                    <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase tracking-wider">Nama Kategori</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag text-muted"></i></span>
                                <input type="text" name="nama_kategori"
                                       class="form-control border-start-0 ps-0 rounded-end-3"
                                       value="{{ $category->nama_kategori }}"
                                       placeholder="Misal: Elektronik, Furniture..."
                                       required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-3 rounded-3 fw-bold shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-light py-3 rounded-3 fw-bold">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>

                <p class="text-center text-muted mt-4 small">
                    &copy; 2026 Informatika - UNIBA Madura
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
