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
            --bg-body: #0f172a;
            --bg-sidebar: #1e293b;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --primary-accent: #6366f1;
        }

        body { background-color: var(--bg-body) !important; color: var(--text-main) !important; font-family: 'Inter', sans-serif; overflow-x: hidden; }

        /* Sidebar Styling */
        #sidebar {
            min-width: 250px; max-width: 250px; min-height: 100vh;
            background: var(--bg-sidebar);
            transition: all 0.3s ease-in-out;
            position: relative; z-index: 1005; border-right: 1px solid #334155;
        }
        #sidebar .sidebar-header { padding: 20px; background: #0f172a; }
        #sidebar ul li a { padding: 12px 25px; display: block; color: var(--text-muted); text-decoration: none; transition: 0.3s; }
        #sidebar ul li a:hover, #sidebar ul li.active > a { color: white; background: #334155; border-left: 4px solid var(--primary-accent); }

        /* Main Content Styling */
        #content { width: 100%; padding: 20px; transition: all 0.3s ease-in-out; }
        .card { background-color: var(--bg-card) !important; border: 1px solid #334155 !important; border-radius: 15px; color: white !important; }
        .navbar { background-color: var(--bg-card) !important; border-bottom: 1px solid #334155; }
        .table { color: white !important; }
        .table-light { background-color: #334155 !important; color: var(--text-muted) !important; }
        .btn-primary { background-color: var(--primary-accent) !important; border: none; }

        .sidebar-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.5); z-index: 1000; display: none; }
        .sidebar-overlay.show { display: block; }

        @media (max-width: 768px) {
            #sidebar { margin-left: -250px; position: fixed; }
            #sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <i class="bi bi-shield-lock-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold text-white">INV-ADMIN</h5>
                <small class="text-muted text-uppercase">Kelompok 04</small>
            </div>
            <ul class="list-unstyled">
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li class="{{ Request::is('admin/barang*') ? 'active' : '' }}"><a href="{{ route('admin.barang.index') }}"><i class="bi bi-box-seam me-2"></i> Kelola Barang</a></li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}"><a href="{{ route('admin.category.index') }}"><i class="bi bi-tags me-2"></i> Kelola Kategori</a></li>
                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Kelola User</a></li>
                <li class="mt-5"><a href="{{ route('logout') }}" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-dark rounded-4 mb-4 shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary d-md-none"><i class="bi bi-list"></i></button>
                    <span class="navbar-text fw-bold">Panel Utama Admin</span>
                    <span class="badge bg-dark border border-secondary p-2">{{ Auth::user()->name ?? 'Administrator' }}</span>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3"><div class="card p-3"><h6>Total Barang</h6><h3>{{ $totalBarang }}</h3></div></div>
                    <div class="col-6 col-md-3"><div class="card p-3"><h6>Total Kategori</h6><h3>{{ $totalKategori }}</h3></div></div>
                    <div class="col-6 col-md-3"><div class="card p-3"><h6>Pengajuan</h6><h3>{{ $totalPengajuan }}</h3></div></div>
                    <div class="col-6 col-md-3"><div class="card p-3"><h6>Disetujui</h6><h3>{{ $pengajuanDisetujui }}</h3></div></div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Data Barang</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr><th>No</th><th>Nama</th><th>Merek</th><th>Stok</th><th>Harga</th></tr>
                            </thead>
                            <tbody>
                                @forelse($allBarang as $index => $barang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->merk }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center">Data kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header border-0">
                        <h5 class="fw-bold mb-0">Daftar Pengguna</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-info">{{ $user->role }}</span></td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahKategori" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: #1e293b;">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required minlength="3" maxlength="50">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const s = document.getElementById('sidebar'), c = document.getElementById('sidebarCollapse'), o = document.getElementById('sidebarOverlay');
        c.addEventListener('click', () => { s.classList.toggle('active'); o.classList.toggle('show'); });
        o.addEventListener('click', () => { s.classList.remove('active'); o.classList.remove('show'); });
    </script>
</body>
</html>
