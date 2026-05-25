<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Control Panel - Kelompok 04</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #0c0c0e;
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }
        /* SIDEBAR STYLING (CYBERPUNK DARK) */
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
        /* CARD & BOX COMPONENT */
        .info-box-cyber {
            background-color: #141419;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .btn-action-cair:hover {
            background-color: #00cca3 !important;
            box-shadow: 0 0 15px rgba(0,255,204,0.6) !important;
            transform: translateY(-1px);
        }
        /* RESPONSIVE BREAKPOINT UNTUK HANDPHONE */
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

                <a href="{{ route('keuangan.dashboard') }}" class="nav-link-cyber active">
                    <i class="fas fa-th-large"></i> Dashboard Financial
                </a>
                <a href="{{ route('keuangan.anggaran.index') }}" class="nav-link-cyber">
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
                        FINANCIAL CONTROL PANEL
                    </h1>
                    <p class="text-muted mb-0" style="font-size: 13px;">Sistem Integrasi Keuangan Modern • UNIBA Madura</p>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success border-0 shadow-lg mb-4" style="background-color: rgba(72,187,120,0.15); color: #48bb78; border-left: 4px solid #48bb78 !important; font-size: 14px;">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="info-box-cyber" style="border: 1px solid #3182ce;">
                        <span class="info-box-icon shadow text-primary float-left mr-3">
                            <i class="fas fa-hourglass-half fa-2x"></i>
                        </span>
                        <div>
                            <span class="d-block text-uppercase font-weight-bold" style="font-size: 11px; color: #a0aec0;">Antrean Karyawan (Pending)</span>
                            <span style="font-size: 26px; font-weight: 700; color: #fff;">{{ $countPending }} <small style="font-size: 14px; color: #a0aec0; font-weight: 400;">Berkas</small></span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="info-box-cyber" style="border: 1px solid #d69e2e;">
                        <span class="info-box-icon shadow text-warning float-left mr-3">
                            <i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </span>
                        <div>
                            <span class="d-block text-uppercase font-weight-bold" style="font-size: 11px; color: #a0aec0;">Disetujui Kepala (Siap Bayar)</span>
                            <span style="font-size: 26px; font-weight: 700; color: #ecc94b;">{{ $countVerified }} <small style="font-size: 14px; color: #a0aec0; font-weight: 400;">Valid</small></span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <div class="info-box-cyber" style="border: 1px solid #e53e3e;">
                        <span class="info-box-icon shadow text-danger float-left mr-3">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </span>
                        <div>
                            <span class="d-block text-uppercase font-weight-bold" style="font-size: 11px; color: #a0aec0;">Stok Kritis Gudang (Admin)</span>
                            <span style="font-size: 26px; font-weight: 700; color: #e53e3e;">
                                {{ is_countable($countKritis) ? count($countKritis) : $countKritis }}
                                <small style="font-size: 14px; color: #a0aec0; font-weight: 400;">Item</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card shadow-lg" style="background-color: #141419; border: 1px solid #2d3748; border-radius: 12px; overflow: hidden;">
                        <div class="card-header" style="border-bottom: 1px solid #2d3748; background-color: #1a1a24; padding: 15px 20px;">
                            <h3 class="card-title text-white font-weight-bold m-0" style="font-size: 15px;">
                                <i class="fas fa-exchange-alt text-info mr-2"></i> Manifestasi Anggaran Pengajuan Logistik Valid (Siap Cair)
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-dark text-nowrap m-0">
                                <thead>
                                    <tr style="color: #00ffcc; background-color: #1a1a24; border-bottom: 2px solid #2d3748; font-size: 13px;">
                                        <th>Karyawan (Pemohon)</th>
                                        <th>Nama Aset Barang</th>
                                        <th>Kuantitas</th>
                                        <th>Otoritas Verifikasi</th>
                                        <th class="text-center">Aksi Finansial</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 14px;">
                                    @forelse($approvedPengajuans as $p)
                                    <tr style="border-bottom: 1px solid #2d3748;">
                                        <td class="align-middle font-weight-bold" style="color: #edf2f7;">
                                            <i class="fas fa-user-circle text-muted mr-2"></i> {{ $p->user->name ?? 'Karyawan Unit' }}
                                        </td>
                                        <td class="align-middle" style="color: #cbd5e0;">
                                            {{ $p->barang->nama_barang ?? 'Barang Gudang' }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge" style="background-color: #2d3748; color: #a0aec0; padding: 6px 12px; border-radius: 6px;">{{ $p->jumlah }} Unit</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge" style="background-color: rgba(72,187,120,0.15); color: #48bb78; border: 1px solid rgba(72,187,120,0.3); padding: 6px 12px; border-radius: 6px;">
                                                <i class="fas fa-check-circle mr-1"></i> Di-ACC Kepala Umum
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="{{ route('keuangan.pengajuan.cairkan', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin data valid dan ingin mencairkan alokasi dana belanja untuk barang ini?');" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm font-weight-bold shadow-sm btn-action-cair" style="background-color: #00ffcc; color: #0b0b0e; border-radius: 6px; padding: 6px 16px; border: none; font-size: 12px;">
                                                    <i class="fas fa-money-bill-wave mr-1"></i> Cairkan Dana
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5" style="background-color: #111116;">
                                            <div class="mb-2"><i class="fas fa-folder-open fa-3x" style="color: #2d3748;"></i></div>
                                            <span style="font-size: 13px; color: #718096;">Belum ada berkas pengajuan logistik yang dikirim oleh Kepala Umum.</span>
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
    </div>
</div>

</body>
</html>
