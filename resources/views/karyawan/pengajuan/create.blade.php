@extends('layouts.karyawan')

@section('title', 'Buat Pengajuan')

@section('content')
    <div class="mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.dashboard') }}" class="text-decoration-none text-white-50 small">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('karyawan.pengajuan.index') }}" class="text-decoration-none text-white-50 small">Pengajuan</a></li>
                <li class="breadcrumb-item active text-info small fw-semibold" aria-current="page">Buat Permohonan</li>
            </ol>
        </nav>
        <h3 class="fw-bold m-0 text-white">Formulir Permohonan Logistik</h3>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6 col-lg-8">
            <div class="card p-4 shadow-lg position-relative border-0"
                 style="background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.5)); backdrop-filter: blur(15px); border-radius: 24px; border: 1px solid rgba(255,255,255,0.05) !important;">

                <div class="position-absolute top-0 start-0 w-100 rounded-top-5" style="height: 4px; background: linear-gradient(90deg, #3b82f6, #00f2fe);"></div>

                <div class="d-flex align-items-center mb-4 mt-2">
                    <div class="p-3 rounded-4 me-3 d-flex align-items-center justify-content-center"
                         style="background: rgba(59, 130, 246, 0.15); border: 1px solid rgba(59, 130, 246, 0.25); color: #3b82f6;">
                        <i class="bi bi-file-earmark-plus fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0 text-white">Detail Permohonan</h5>
                        <p class="text-white-50 small m-0">Silakan tentukan logistik yang ingin Anda ajukan.</p>
                    </div>
                </div>

                <form action="{{ route('karyawan.pengajuan.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label for="barang_id" class="form-label text-white-50 small fw-bold tracking-wider text-uppercase">Pilih Komoditas / Barang</label>
                        <select name="barang_id"
                                id="barang_id"
                                class="form-select custom-input p-3 rounded-3 @error('barang_id') is-invalid @enderror"
                                required>
                            <option value="" disabled selected hidden>-- Pilih Inventaris Tersedia --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} (Tersedia: {{ $b->stok }} Unit)
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jumlah" class="form-label text-white-50 small fw-bold tracking-wider text-uppercase">Kuantitas Permintaan</label>
                        <div class="input-group">
                            <span class="input-group-text px-3 custom-addon">
                                <i class="bi bi-calculator-fill"></i>
                            </span>
                            <input type="number"
                                   name="jumlah"
                                   id="jumlah"
                                   class="form-control custom-input p-3 rounded-end-3 @error('jumlah') is-invalid @enderror"
                                   placeholder="Contoh: 2"
                                   min="1"
                                   value="{{ old('jumlah') }}"
                                   required>
                        </div>
                        @error('jumlah')
                            <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="alasan" class="form-label text-white-50 small fw-bold tracking-wider text-uppercase">Justifikasi / Alasan Keperluan</label>
                        <textarea name="alasan"
                                  id="alasan"
                                  class="form-control custom-input p-3 rounded-3 @error('alasan') is-invalid @enderror"
                                  placeholder="Tuliskan alasan operasional penggunaan secara rinci..."
                                  rows="4"
                                  style="resize: none;"
                                  required>{{ old('alasan') }}</textarea>
                        @error('alasan')
                            <div class="invalid-feedback d-block mt-2 small text-danger fw-medium">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row g-3 pt-2">
                        <div class="col-md-4 order-md-1">
                            <a href="{{ route('karyawan.pengajuan.index') }}"
                               class="btn btn-outline-secondary w-100 p-3 fw-semibold rounded-3 text-white-50 border-secondary border-opacity-20 custom-btn-back">
                                Batal
                            </a>
                        </div>
                        <div class="col-md-8 order-md-2">
                            <button type="submit"
                                    class="btn btn-primary w-100 p-3 fw-bold rounded-3 shadow d-flex align-items-center justify-content-center gap-2 custom-btn-submit">
                                <i class="bi bi-send-check"></i> Submit Permohonan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
