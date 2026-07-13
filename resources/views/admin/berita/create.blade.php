@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">📝 Tambah Berita</h4>
            <small class="text-muted">Isi data berita dengan lengkap</small>
        </div>
        <a href="/admin/berita" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <!-- FORM -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <form action="/admin/berita/store" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control form-control-lg" placeholder="Masukkan judul berita..." required>
                        </div>

                        <!-- TANGGAL -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Upload</label>
                            <input type="date" name="tanggal_upload" class="form-control" required>
                        </div>

                        <!-- ISI -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Isi Berita</label>
                            <textarea name="isi" id="isi" rows="8" class="form-control" placeholder="Tulis isi berita..." required></textarea>
                        </div>

                        <!-- GAMBAR -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Gambar</label>
                            <input type="file" name="gambar" class="form-control" onchange="previewGambar(event)">
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Simpan
                            </button>

                            <a href="/admin/berita" class="btn btn-light border">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- PREVIEW -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">

                    <h6 class="fw-bold mb-3">Preview Gambar</h6>

                    <img id="preview" src="https://via.placeholder.com/300x200?text=Preview"
                        class="img-fluid rounded shadow-sm">

                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('scripts')
<script>
function previewGambar(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection