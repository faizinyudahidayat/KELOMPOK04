<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --bg-body: #0f172a; --bg-sidebar: #1e293b; --bg-card: #1e293b; --text-main: #f8fafc; --text-muted: #94a3b8; --primary-accent: #6366f1; }
        body { background-color: var(--bg-body) !important; color: var(--text-main) !important; font-family: 'Inter', sans-serif; }
        #sidebar { min-width: 250px; max-width: 250px; min-height: 100vh; background: var(--bg-sidebar); border-right: 1px solid #334155; }
        #sidebar .sidebar-header { padding: 20px; background: #0f172a; }
        #sidebar ul li a { padding: 12px 25px; display: block; color: var(--text-muted); text-decoration: none; transition: 0.3s; }
        #sidebar ul li a:hover, #sidebar ul li.active > a { color: white; background: #334155; border-left: 4px solid var(--primary-accent); }
        .card { background-color: var(--bg-card) !important; border: 1px solid #334155 !important; border-radius: 15px; color: white !important; }
        .table { color: white !important; }
        .btn-primary { background-color: var(--primary-accent) !important; border: none; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <i class="bi bi-shield-lock-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold text-white">INV-ADMIN</h5>
            </div>
            <ul class="list-unstyled">
                <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.barang.index') }}"><i class="bi bi-box-seam me-2"></i> Kelola Barang</a></li>
                <li><a href="{{ route('admin.category.index') }}"><i class="bi bi-tags me-2"></i> Kelola Kategori</a></li>
                <li class="active"><a href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Kelola User</a></li>
                <li class="mt-5"><a href="{{ route('logout') }}" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
            </ul>
        </nav>

        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between mb-4 align-items-center">
                <h3 class="fw-bold">Daftar Pengguna</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                    <i class="bi bi-plus-lg"></i> Tambah User
                </button>
            </div>

            <div class="card p-4 shadow-sm">
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
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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

    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content" style="background: #1e293b;">
                @csrf
                <div class="modal-header border-0 text-white"><h5>Tambah User Baru</h5></div>
                <div class="modal-body text-white">
                    <div class="mb-3"><label>Nama</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="kepala-umum">Kepala Umum</option>
                            <option value="keuangan">Keuangan</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary">Simpan User</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
