<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --dark-sidebar: #1e293b; }
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        #sidebar { min-width: 250px; max-width: 250px; min-height: 100vh; background: var(--dark-sidebar); color: white; }
        #sidebar ul li a { padding: 12px 25px; display: block; color: #94a3b8; text-decoration: none; }
        #sidebar ul li.active > a { color: white; background: #334155; border-left: 4px solid #0d6efd; }
        #content { width: 100%; padding: 20px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header text-center py-4">
                <i class="bi bi-box-seam-fill fs-2 text-primary"></i>
                <h5 class="mt-2 fw-bold">INV-KEL04</h5>
            </div>
            <ul class="list-unstyled">
                <li><a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.barang.create') }}"><i class="bi bi-plus-circle"></i> Tambah Barang</a></li>
                <li class="active"><a href="{{ route('admin.barang.index') }}"><i class="bi bi-archive"></i> Semua Barang</a></li>
                <li><a href="{{ route('admin.category.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
            </ul>
        </nav>

        <div id="content">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Semua Daftar Barang</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Merk</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allBarang as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->nama_barang }}</td>
                                    <td>{{ $row->category->nama_kategori ?? '-' }}</td>
                                    <td>{{ $row->merk }}</td>
                                    <td>{{ $row->stok }}</td>
                                    <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
