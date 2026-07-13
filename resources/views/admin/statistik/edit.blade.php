@extends('admin.layout')

@section('content')

<div class="container-fluid py-3">

    <!-- HEADER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="fw-bold mb-1">📊 Edit Statistik Kelurahan</h4>
            <small class="text-muted">Update data penduduk, RT, dan RW</small>
        </div>

        <a href="/admin/statistik" class="btn btn-outline-secondary btn-sm rounded-3">
            ← Kembali
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow-lg border-0 rounded-4 stat-card">
        <div class="card-body p-4 p-md-5">

            <form action="/admin/statistik/update" method="POST" id="formStat">
                @csrf

                <div class="row g-4">

                    <div class="col-12 col-md-4">
                        <label class="form-label fw-semibold">👥 Jumlah Penduduk</label>
                        <input type="text" name="penduduk" class="form-control valueInput"
                            value="{{ number_format($penduduk->value ?? 0,0,',','.') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label fw-semibold">🏠 Jumlah RT</label>
                        <input type="text" name="rt" class="form-control valueInput"
                            value="{{ number_format($rt->value ?? 0,0,',','.') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label fw-semibold">🏢 Jumlah RW</label>
                        <input type="text" name="rw" class="form-control valueInput"
                            value="{{ number_format($rw->value ?? 0,0,',','.') }}">
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="/admin/statistik"
                       class="btn btn-light border rounded-3">
                        Kembali
                    </a>

                    <button type="button"
                            class="btn btn-success px-4 rounded-3 shadow-sm"
                            onclick="openConfirm()">
                        💾 Simpan Semua
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- ================= MODAL KONFIRMASI ================= -->
<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">

      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Perubahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Apakah kamu yakin ingin menyimpan perubahan data statistik ini?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Batal
        </button>

        <button type="button" class="btn btn-success" onclick="submitForm()">
            Ya, Simpan
        </button>
      </div>

    </div>
  </div>
</div>

@endsection


@section('scripts')

<style>
body {
    background: #f6f8fb;
}

.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}

.form-control {
    border-radius: 12px;
    padding: 12px;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25,135,84,0.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputs = document.querySelectorAll('.valueInput');

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            let angka = this.value.replace(/\D/g, '');
            if (!angka) return this.value = '';
            this.value = new Intl.NumberFormat('id-ID').format(angka);
        });
    });

    document.getElementById('formStat').addEventListener('submit', function () {
        inputs.forEach(input => {
            input.value = input.value.replace(/\D/g, '');
        });
    });

});

// OPEN MODAL
function openConfirm() {
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
}

// SUBMIT FORM
function submitForm() {
    document.getElementById('formStat').submit();
}
</script>

@endsection