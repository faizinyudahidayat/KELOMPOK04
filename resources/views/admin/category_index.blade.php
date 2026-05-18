<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #0d6efd; --dark-sidebar: #1e293b; }
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; overflow-x: hidden; }

        /* Sidebar Styling */
        #sidebar { min-width: 250px; max-width: 250px; min-height: 100vh; background: var(--dark-sidebar); transition: all 0.3s; color: white; position: relative; z-index: 1005; }
        #sidebar .sidebar-header { padding: 20px; background: #0f172a; }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a { padding: 12px 25px; display: block; color: #94a3b8; text-decoration: none; transition: 0.3s; }
        #sidebar ul li a:hover, #sidebar ul li.active > a { color: white; background: #334155; border-left: 4px solid var(--primary-color); }
        #sidebar ul li a i { margin-right: 10px; }

        /* Content & Overlay */
        #content { width: 100%; padding: 20px; transition: all 0.3s; }
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
            #sidebar { margin-left: -250px; position: fixed; height: 100vh; }
            #sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <i class="bi bi-box-seam-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold">INV-KEL04</h5>
                <small class="text-muted text-uppercase tracking-wider" style="font-size: 10px;">UNIBA Madura</small>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/barang*') && !Request::is('admin/barang/create') ? 'active' : '' }}">
                    <a href="{{ route('admin.barang.index') }}"><i class="bi bi-archive"></i> Semua Barang</a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}"><i class="bi bi-tags"></i> Kategori</a>
                </li>
                <li class="mt-5">
                    <a href="{{ route('logout') }}" class="text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded-4 mb-4 shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary d-md-none"><i class="bi bi-list"></i></button>
                    <span class="navbar-text ms-2 fw-bold text-dark">Manajemen Kategori</span>
                </div>
            </nav>

            <div class="container-fluid">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0 text-dark">Daftar Kategori Barang</h5>
                                <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                    <i class="bi bi-plus-lg"></i> Tambah Kategori
                                </button>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light text-secondary small text-uppercase">
                                            <tr>
                                                <th class="ps-4" style="width: 80px;">No</th>
                                                <th>Nama Kategori</th>
                                                <th class="text-center" style="width: 150px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $key => $cat)
                                            <tr>
                                                <td class="ps-4 text-muted">{{ $key + 1 }}</td>
                                                <td>
                                                    <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-medium border border-info border-opacity-25">
                                                        <i class="bi bi-tag-fill me-1"></i> {{ $cat->nama_kategori }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex gap-1">
                                                        <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-sm btn-outline-warning rounded-circle shadow-sm" style="padding: 4px 8px;">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle shadow-sm" style="padding: 4px 8px;">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-5 text-muted">Belum ada kategori yang terdaftar.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-primary text-white border-0 shadow-sm overflow-hidden h-100 d-flex flex-column justify-content-between">
                            <div class="card-body p-4 position-relative">
                                <h6 class="opacity-75 text-uppercase tracking-wider">Total Kategori</h6>
                                <h1 class="fw-bold display-4 my-2">{{ count($categories) }}</h1>
                                <i class="bi bi-tags position-absolute end-0 bottom-0 opacity-25 me-3 mb-2" style="font-size: 5rem;"></i>
                            </div>
                            <div class="card-footer bg-dark bg-opacity-10 border-0 py-3">
                                <p class="small mb-0"><i class="bi bi-info-circle me-1"></i> Digunakan untuk pengelompokan komponen aset logistik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="mt-5 py-4 text-center text-muted border-top">
                <small>&copy; 2026 Informatika - UNIBA Madura</small>
            </footer>
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
