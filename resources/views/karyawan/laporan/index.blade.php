@extends('layouts.karyawan')

@section('title', 'Laporan Stok Barang')

@section('content')
    <div class="mb-5">
        <h3 class="fw-bold m-0 text-white">Laporan Stok Barang</h3>
        <p class="text-muted m-0 small">Pantau ketersediaan logistik dan stok gudang secara real-time.</p>
    </div>

    <div class="stat-card p-4">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle m-0" style="--bs-table-bg: transparent; --bs-table-border-color: rgba(255,255,255,0.05);">
                <thead>
                    <tr class="text-secondary small text-uppercase tracking-wider">
                        <th class="py-3 border-0">Barang</th>
                        <th class="py-3 border-0">Kategori</th>
                        <th class="py-3 border-0 text-center">Stok</th>
                        <th class="py-3 border-0">Status Ketersediaan</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($barangs as $b)
                        <tr>
                            <td class="py-3">
                                <span class="fw-bold text-info">{{ $b->nama_barang }}</span>
                            </td>
                            <td class="py-3">
                                <span class="badge bg-white bg-opacity-10 text-white-50 fw-normal">
                                    {{ $b->category->nama_kategori ?? 'Tanpa Kategori' }}
                                </span>
                            </td>
                            <td class="py-3 text-center">
                                <span class="fs-5 fw-bold">{{ $b->stok }}</span>
                            </td>
                            <td class="py-3" style="min-width: 200px;">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    @if($b->stok > 10)
                                        <span class="text-success small fw-bold">
                                            <i class="bi bi-check-circle-fill me-1"></i> Tersedia
                                        </span>
                                        <span class="text-muted small">{{ $b->stok }} unit</span>
                                    @elseif($b->stok > 0)
                                        <span class="text-warning small fw-bold">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Menipis
                                        </span>
                                        <span class="text-muted small">{{ $b->stok }} unit</span>
                                    @else
                                        <span class="text-danger small fw-bold">
                                            <i class="bi bi-x-circle-fill me-1"></i> Habis
                                        </span>
                                        <span class="text-muted small">0 unit</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-white-50">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-primary opacity-75"></i>
                                Tidak ada data barang yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
