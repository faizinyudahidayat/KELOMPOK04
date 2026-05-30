@extends('layouts.karyawan')

@section('title', 'Riwayat Pengajuan')

@section('content')
    <div class="d-flex justify-content-between align-items-sm-end flex-column flex-sm-row gap-3 mb-5">
        <div>
            <h3 class="fw-bold m-0 text-white">Riwayat Pengajuan</h3>
            <p class="m-0 small" style="color: #94a3b8;">Pantau status permohonan inventaris Anda di sini.</p>
        </div>
        <a href="{{ route('karyawan.pengajuan.create') }}"
            class="btn btn-primary p-3 fw-bold rounded-3 shadow d-flex align-items-center gap-2"
            style="background: linear-gradient(135deg, #3b82f6, #2563eb); border: none;">
            <i class="bi bi-plus-lg"></i> Buat Pengajuan
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mb-4 text-white" role="alert"
            style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.3) !important;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="stat-card p-4"
        style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.75)); backdrop-filter: blur(15px); border-radius: 24px;">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle m-0"
                style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                <thead>
                    <tr class="small text-uppercase tracking-wider" style="color: #94a3b8;">
                        <th class="py-3 border-0">Barang</th>
                        <th class="py-3 border-0 text-center">Jumlah</th>
                        <th class="py-3 border-0">Status Verifikasi</th>
                        <th class="py-3 border-0">Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($pengajuans as $p)
                        <tr>
                            <td class="py-3">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="fw-semibold text-white">{{ $p->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}</span>
                                </div>
                            </td>
                            <td class="py-3 text-center fw-bold text-info">{{ $p->jumlah }} Unit</td>
                            <td class="py-3">
                                @if ($p->status == 'pending')
                                    <span
                                        class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-2 rounded-pill">
                                        <i class="bi bi-clock-history me-1"></i> Menunggu
                                    </span>
                                @elseif($p->status == 'verifikasi' || $p->status == 'selesai')
                                    <span
                                        class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2 rounded-pill">
                                        <i class="bi bi-check2-circle me-1"></i> Disetujui
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 fw-medium" style="color: #e2e8f0;">
                                {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                <div class="fw-normal mt-0.5" style="font-size: 0.7rem; color: #cbd5e1; opacity: 0.8;">
                                    <i
                                        class="bi bi-clock me-1"></i>{{ $p->created_at ? $p->created_at->format('H:i') : '--:--' }}
                                    WIB
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-white-50">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-primary opacity-75"></i>
                                Belum ada riwayat pengajuan barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
