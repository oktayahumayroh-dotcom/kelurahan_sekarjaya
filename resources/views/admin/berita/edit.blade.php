@extends('admin.layout')

@section('content')
<div class="container">

    <h4 class="mb-3">✏️ Edit Berita</h4>

    <div class="card shadow-lg border-0">
        <div class="card-body">

            <form action="/admin/berita/update/{{ $berita->id }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- KIRI -->
                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" class="form-control"
                                value="{{ $berita->judul }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea name="isi" rows="8" class="form-control" required>{{ $berita->isi }}</textarea>
                        </div>

                    </div>

                    <!-- KANAN -->
                    <div class="col-md-4">

                        <div class="mb-3">
                            <label class="form-label">Tanggal Upload</label>
                            <input type="date" name="tanggal_upload"
                                value="{{ $berita->tanggal_upload }}"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar</label>

                            @if($berita->gambar)
                                <img src="{{ asset('storage/'.$berita->gambar) }}"
                                     class="img-fluid mb-2 rounded"
                                     id="preview">
                            @endif

                            <input type="file" name="gambar"
                                   class="form-control"
                                   onchange="previewImage(event)">
                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update
                    </button>

                    <a href="/admin/berita" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection