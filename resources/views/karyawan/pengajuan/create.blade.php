<div class="main-content">
    <div class="col-lg-6">
        <div class="stat-card">
            <h4 class="fw-bold mb-4">Buat Permohonan Barang</h4>
            <form action="{{ route('karyawan.pengajuan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small">PILIH BARANG</label>
                    <select name="barang_id" class="form-select bg-dark border-secondary text-white p-3">
                        @foreach($barangs as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">JUMLAH</label>
                    <input type="number" name="jumlah" class="form-control bg-dark border-secondary text-white p-3" min="1" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small">ALASAN PENGGUNAAN</label>
                    <textarea name="alasan" class="form-control bg-dark border-secondary text-white" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-3 fw-bold rounded-3">KIRIM PENGAJUAN</button>
            </form>
        </div>
    </div>
</div>
