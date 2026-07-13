@extends('admin.layout')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-12">

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">

                    <h4 class="mb-3 text-center">Form Tolak Pengajuan</h4>
                    <p class="text-muted text-center mb-4">
                        Berikan alasan penolakan pengajuan surat ini dengan jelas.
                    </p>

                    <form id="formTolak"
                          action="{{ route('admin.tolak', ['jenis' => $jenis, 'id' => $surat->id]) }}"
                          method="POST">
                        @csrf

                        <input type="hidden" name="jenis" value="{{ $jenis }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alasan Penolakan</label>
                            <textarea name="catatan"
                                      class="form-control"
                                      rows="5"
                                      placeholder="Contoh: Berkas tidak lengkap / data tidak sesuai"
                                      required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button"
                                    onclick="konfirmasiTolak()"
                                    class="btn btn-danger py-2">
                                Tolak Pengajuan
                            </button>

                            <a href="{{ route('admin.pengajuan') }}"
                               class="btn btn-outline-secondary py-2">
                                Kembali ke Pengajuan
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@section('scripts')

<script>
function konfirmasiTolak() {
    Swal.fire({
        title: 'Tolak Pengajuan?',
        text: "Pengajuan ini akan ditolak dan tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formTolak').submit();
        }
    });
}
</script>

<style>
.card {
    border-radius: 12px;
}

textarea.form-control {
    resize: none;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

@media (max-width: 576px) {
    h4 {
        font-size: 18px;
    }
}
</style>

@endsection