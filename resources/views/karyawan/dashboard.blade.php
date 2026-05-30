@extends('layouts.karyawan')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold m-0 text-white">Selamat Datang, {{ Auth::user()->name ?? 'Karyawan' }} 👋</h3>
            <p class="m-0 small" style="color: #94a3b8;">Panel pemantauan dan pengajuan logistik internal UNIBA Madura.</p>
        </div>
        <div>
            <a href="{{ route('karyawan.pengajuan.create') }}"
                class="btn btn-primary p-3 fw-bold rounded-3 shadow d-flex align-items-center gap-2"
                style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none;">
                <i class="bi bi-plus-lg"></i> Buat Pengajuan Baru
            </a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-4 h-100 position-relative overflow-hidden"
                style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.65)); border: 1px solid rgba(255,255,255,0.05); border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="small fw-bold tracking-wider text-uppercase mb-1" style="color: #94a3b8;">Total Pengajuan
                        </p>
                        <h2 class="fw-bold text-white m-0">{{ $totalPengajuan ?? 0 }}</h2>
                    </div>
                    <div class="p-3 rounded-4"
                        style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2);">
                        <i class="bi bi-folder-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-4 h-100 position-relative overflow-hidden"
                style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.65)); border: 1px solid rgba(255,255,255,0.05); border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="small fw-bold tracking-wider text-uppercase mb-1" style="color: #94a3b8;">Menunggu
                            Verifikasi</p>
                        <h2 class="fw-bold text-warning m-0">{{ $pengajuanPending ?? 0 }}</h2>
                    </div>
                    <div class="p-3 rounded-4"
                        style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2);">
                        <i class="bi bi-hourglass-split fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-4 h-100 position-relative overflow-hidden"
                style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.65)); border: 1px solid rgba(255,255,255,0.05); border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="small fw-bold tracking-wider text-uppercase mb-1" style="color: #94a3b8;">Disetujui /
                            Terverifikasi</p>
                        <h2 class="fw-bold text-success m-0">{{ $pengajuanDisetujui ?? 0 }}</h2>
                    </div>
                    <div class="p-3 rounded-4"
                        style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2);">
                        <i class="bi bi-check-circle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card p-4 h-100 position-relative overflow-hidden"
                style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.65)); border: 1px solid rgba(255,255,255,0.05); border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="small fw-bold tracking-wider text-uppercase mb-1" style="color: #94a3b8;">Permohonan
                            Ditolak</p>
                        <h2 class="fw-bold text-danger m-0">{{ $pengajuanDitolak ?? 0 }}</h2>
                    </div>
                    <div class="p-3 rounded-4"
                        style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);">
                        <i class="bi bi-x-circle-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-4 border-0"
                style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.75)); backdrop-filter: blur(15px); border-radius: 24px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-white m-0">Riwayat Permohonan Terkini</h5>
                    </div>
                    <a href="{{ route('karyawan.pengajuan.index') }}"
                        class="btn btn-outline-secondary btn-sm rounded-3 text-white border-secondary border-opacity-40 px-3 py-2 small">
                        Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle m-0"
                        style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                        <thead>
                            <tr class="small text-uppercase tracking-wider" style="color: #94a3b8;">
                                <th class="py-3 border-0">Tanggal</th>
                                <th class="py-3 border-0">Nama Barang</th>
                                <th class="py-3 border-0 text-center">Jumlah</th>
                                <th class="py-3 border-0">Catatan / Alasan Tolak</th>
                                <th class="py-3 border-0 text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            @forelse($riwayatPengajuans ?? [] as $p)
                                <tr>
                                    <td class="py-3 fw-medium" style="color: #e2e8f0;">
                                        {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="py-3 fw-semibold text-white">
                                        {{ $p->barang->nama_barang ?? 'Barang Terhapus' }}
                                    </td>
                                    <td class="py-3 text-center text-info fw-bold">{{ $p->jumlah }} Unit</td>

                                    <td class="py-3 text-truncate" style="max-width: 250px; color: #cbd5e1;">
                                        @if ($p->status == 'ditolak')
                                            <span class="text-danger fw-bold"
                                                style="background: rgba(239, 68, 68, 0.1); padding: 2px 6px; border-radius: 4px;">
                                                {{ $p->alasan_tolak ?? 'Ditolak Kepala Umum' }}
                                            </span>
                                        @else
                                            {{ $p->alasan ?? '-' }}
                                        @endif
                                    </td>
                                    <td class="py-3 text-end">
                                        @if ($p->status == 'pending')
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-2 rounded-pill">Menunggu</span>
                                        @elseif($p->status == 'verifikasi' || $p->status == 'selesai')
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-pill">Disetujui</span>
                                        @elseif($p->status == 'ditolak')
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-pill">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-white-50">
                                        <i class="bi bi-inbox fs-2 d-block mb-2 text-primary opacity-75"></i>
                                        Belum ada riwayat pengajuan barang yang terdata.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
