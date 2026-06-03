<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan Anggaran - Kelompok 04</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #0c0c0e;
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }
     
        .cyber-sidebar {
            min-height: 100vh;
            background-color: #111116;
            border-right: 1px solid #2d3748;
            padding-top: 20px;
            position: fixed;
            z-index: 100;
        }
        .sidebar-brand {
            color: #00ffcc;
            text-shadow: 0 0 10px rgba(0,255,204,0.3);
            font-weight: 800;
            font-size: 18px;
            letter-spacing: 1px;
            padding: 10px 15px;
            border-bottom: 1px solid #2d3748;
            margin-bottom: 20px;
        }
        .nav-link-cyber {
            color: #a0aec0;
            font-weight: 600;
            padding: 12px 20px;
            display: block;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.3s;
            text-decoration: none !important;
        }
        .nav-link-cyber:hover, .nav-link-cyber.active {
            color: #00ffcc;
            background-color: rgba(0, 255, 204, 0.08);
            border-left: 4px solid #00ffcc;
            box-shadow: -5px 0 10px rgba(0, 255, 204, 0.05);
        }
        .nav-link-cyber i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        /* MAIN CONTENT AREA */
        .main-content-cyber {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
        }
        @media (max-width: 768px) {
            .cyber-sidebar {
                position: static;
                min-height: auto;
                border-right: none;
                border-bottom: 1px solid #2d3748;
            }
            .main-content-cyber {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row no-gutters">

        <div class="col-12 col-md-3 col-xl-2 cyber-sidebar">
            <div class="sidebar-brand text-center text-md-left">
                <i class="fas fa-cube text-warning"></i> INV-APP Kel04
            </div>
            <div class="px-2">
                <div class="text-muted small px-3 mb-3">
                    <i class="fas fa-circle text-success mr-1" style="font-size: 9px;"></i> Keuangan Aktif
                </div>

                <a href="{{ route('keuangan.dashboard') }}" class="nav-link-cyber">
                    <i class="fas fa-th-large"></i> Dashboard Financial
                </a>
                <a href="{{ route('keuangan.anggaran.index') }}" class="nav-link-cyber active">
                    <i class="fas fa-file-invoice-dollar"></i> Data Pengajuan
                </a>
                <a href="{{ route('keuangan.laporan.index') }}" class="nav-link-cyber">
                    <i class="fas fa-history"></i> Laporan Audit
                </a>

                <hr style="border-top: 1px solid #2d3748; margin: 15px 10px;">

                <a href="{{ route('logout') }}" class="nav-link-cyber text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <div class="col-12 col-md-9 col-xl-10 main-content-cyber">
            <div class="mb-4">
                <div style="border-left: 4px solid #00ffcc; padding-left: 15px; background: linear-gradient(90deg, #141419 0%, transparent 100%); padding-top: 10px; padding-bottom: 10px; border-radius: 0 8px 8px 0;">
                    <h1 class="m-0" style="color: #00ffcc; text-shadow: 0 0 12px rgba(0,255,204,0.4); font-weight: 800; letter-spacing: 1px; font-size: 26px;">
                        ANALISIS ANGGARAN & RESTOCK
                    </h1>
                    <p class="text-muted mb-0" style="font-size: 13px;">Monitoring Kebutuhan Belanja Logistik Kritis • UNIBA Madura</p>
                </div>
            </div>

            <div class="card shadow-lg" style="background-color: #141419; border: 1px solid #2d3748; border-radius: 12px; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-hover table-dark text-nowrap m-0">
                        <thead>
                            <tr style="color: #00ffcc; background-color: #1a1a24; border-bottom: 2px solid #2d3748; font-size: 13px;">
                                <th>Nama Barang</th>
                                <th>Stok Saat Ini</th>
                                <th>Status Anggaran</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                            @forelse($barangBelanja as $b)
                            <tr style="border-bottom: 1px solid #2d3748;">
                                <td class="align-middle font-weight-bold" style="color: #edf2f7;">{{ $b->nama_barang }}</td>
                                <td class="align-middle text-danger font-weight-bold">{{ $b->stok }} Unit</td>
                                <td class="align-middle">
                                    <span class="badge badge-danger" style="padding: 6px 12px; border-radius: 6px;">Butuh Alokasi Dana</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-5" style="background-color: #111116;">
                                    <span style="font-size: 13px; color: #718096;">Aman. Tidak ada inventaris dengan stok kritis.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
