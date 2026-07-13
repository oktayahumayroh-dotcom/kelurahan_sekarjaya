@extends('admin.layout')

@section('content')

<div class="container py-4" style="max-width: 650px;">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">
                <i class="bi bi-plus-circle"></i> Tambah Data Statistik
            </h5>

            <form action="/admin/statistik/store" method="POST">
                @csrf

                <!-- JENIS DATA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-tags"></i> Jenis Data
                    </label>

                    <select name="key" class="form-select" required>
                        <option value="">-- Pilih Jenis Data --</option>
                        <option value="penduduk">Penduduk</option>
                        <option value="rt">RT</option>
                        <option value="rw">RW</option>
                    </select>
                </div>

                <!-- JUMLAH -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-bar-chart-line"></i> Jumlah
                    </label>

                    <input type="text"
                           id="valueInput"
                           name="value"
                           class="form-control"
                           placeholder="Contoh: 11.111"
                           required>

                    <small class="text-muted">
                        Ketik angka, sistem otomatis format ribuan
                    </small>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between mt-4">

                    <a href="/admin/statistik" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
const input = document.getElementById('valueInput');

// format ribuan
input.addEventListener('input', function () {
    let angka = this.value.replace(/\D/g, '');
    this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});

// sebelum submit → kirim angka polos ke backend
document.querySelector('form').addEventListener('submit', function () {
    input.value = input.value.replace(/\D/g, '');
});
</script>

@endsection