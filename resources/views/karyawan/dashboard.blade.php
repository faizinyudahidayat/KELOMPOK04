<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Dashboard | UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --accent: #3b82f6; --bg: #0f172a; --glass: rgba(30, 41, 59, 0.7); }
        body { background: var(--bg); color: white; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { width: 260px; background: var(--glass); backdrop-filter: blur(10px); height: 100vh; position: fixed; border-right: 1px solid rgba(255,255,255,0.1); }
        .main-content { margin-left: 260px; padding: 2rem; }
        .nav-link { color: #94a3b8; padding: 12px 20px; border-radius: 12px; margin: 5px 15px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: rgba(59, 130, 246, 0.1); color: var(--accent); }
        .stat-card { background: var(--glass); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 1.5rem; }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="fw-bold text-center mb-4"><i class="bi bi-box-seam-fill me-2"></i>INV-UNIBA</h4>
        <hr class="opacity-10">
        <a href="{{ route('karyawan.dashboard') }}" class="nav-link active"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
        <a href="{{ route('karyawan.pengajuan.index') }}" class="nav-link"><i class="bi bi-send-fill me-2"></i> Pengajuan</a>
        <a href="{{ route('karyawan.laporan.index') }}" class="nav-link"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan Stok</a>
        <div class="mt-auto">
            <a href="{{ route('logout') }}" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0">Halo, {{ Auth::user()->name }}!</h2>
                <p class="text-muted">Selamat datang di panel karyawan.</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3b82f6&color=fff" class="rounded-circle" width="50">
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="text-muted small text-uppercase fw-bold">Total Pengajuan</div>
                    <h2 class="fw-bold mt-2">{{ $totalPengajuan }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-left: 4px solid orange;">
                    <div class="text-muted small text-uppercase fw-bold">Menunggu Verifikasi</div>
                    <h2 class="fw-bold mt-2 text-warning">{{ $pengajuanPending }}</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
