@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Detail Pengaduan</h4>

        {{-- STATUS --}}
        @if($data->status == 'pending')
    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
@elseif($data->status == 'proses')
    <span class="badge bg-primary px-3 py-2">Proses</span>
@elseif($data->status == 'ditolak')
    <span class="badge bg-danger px-3 py-2">Ditolak</span>
@else
    <span class="badge bg-success px-3 py-2">Selesai</span>
@endif
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- FOTO (KECIL + TOMBOL) -->
            @if($data->foto)
            <div class="mb-4 text-center">
               <img src="{{ asset('pengaduan_foto/' . $data->foto) }}"
                     class="img-thumbnail mb-2"
                     style="max-width:200px;">

                <br>

               <button onclick="zoomImage('{{ asset('pengaduan_foto/' . $data->foto) }}')" 
                        class="btn btn-sm btn-outline-dark">
                    🔍 Lihat Foto
                </button>
            </div>
            @endif

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">NIK</label>
                    <input type="text" class="form-control" value="{{ $data->nik }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Nama</label>
                    <input type="text" class="form-control" value="{{ $data->nama }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Telepon</label>
                    <input type="text" class="form-control" value="{{ $data->telepon }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-semibold">Jenis Pengaduan</label>
                    <input type="text" class="form-control" value="{{ $data->jenis_pengaduan }}" readonly>
                </div>

                <div class="col-12 mb-3">
                    <label class="fw-semibold">Alamat</label>
                    <textarea class="form-control" rows="2" readonly>{{ $data->alamat }}</textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="fw-semibold">Keterangan</label>
                    <textarea class="form-control" rows="3" readonly>{{ $data->keterangan }}</textarea>
                </div>

                @if($data->catatan)
                <div class="col-12 mb-3">
                    <label class="fw-semibold">Catatan Admin</label>
                    <textarea class="form-control" rows="3" readonly>{{ $data->catatan }}</textarea>
                </div>
                @endif

            </div>

            <!-- ACTION -->
            <div class="mt-4 action-wrapper">

    <a href="/admin/pengaduan" class="btn btn-secondary">
        ← Kembali
    </a>

    <div class="action-right">

        {{-- STATUS PENDING --}}
        @if($data->status == 'pending')
            <a href="/admin/pengaduan/tanggapi/{{ $data->id }}" 
               class="btn btn-primary">
                Tanggapi
            </a>

            <a href="{{ route('admin.pengaduan.tolak', $data->id) }}" 
               class="btn btn-danger">
                Tolak
            </a>
        @endif

        {{-- STATUS PROSES --}}
        @if($data->status == 'proses')
            <a href="/admin/pengaduan/tanggapi/{{ $data->id }}" 
               class="btn btn-success">
                Lanjutkan Proses Ke Tahap Penyelesaian
            </a>

            <a href="{{ route('admin.pengaduan.tolak', $data->id) }}" 
               class="btn btn-danger">
                Tolak
            </a>
        @endif

    </div>

</div>

        </div>
    </div>

</div>

{{-- MODAL --}}
<div id="imageModal" class="image-modal" onclick="closeModal()">
    <img id="modalImg">
</div>

@endsection


@section('scripts')

<style>

/* ================= MODAL ================= */
.image-modal {
    display: none; /* ✅ tetap hidden awal */

    position: fixed;
    z-index: 9999;
    inset: 0;
    background: rgba(0,0,0,0.9);

    justify-content: center;
    align-items: center;

    padding: 20px;
    overflow: auto;
}

/* gambar */
.image-modal img {
    max-width: 95%;
    max-height: 90vh;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

/* teks bawah */
.image-modal::after {
    content: "Klik dimana saja untuk menutup";
    position: absolute;
    bottom: 20px;
    color: #ccc;
    font-size: 13px;
}

/* ================= LABEL ================= */
label {
    font-size: 14px;
}

/* ================= ACTION BUTTON ================= */
.action-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}

/* kanan */
.action-right {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* tombol */
.action-wrapper a {
    padding: 14px 18px;
    font-size: 14px;
    font-weight: 600;

    display: flex;
    align-items: center;
    justify-content: center;

    min-height: 48px;
    border-radius: 10px;
    white-space: nowrap;
}

/* ================= MOBILE ================= */
@media (max-width: 768px) {

    .action-wrapper {
        flex-direction: column;
    }

    .action-right {
        flex-direction: column;
        width: 100%;
    }

    .action-wrapper a,
    .action-right a {
        width: 100%;
        font-size: 15px;
        padding: 16px;
        min-height: 52px;
    }

    .image-modal img {
        max-width: 100%;
        max-height: 80vh;
    }
}

/* ================= LOCK BACKGROUND ================= */
body.modal-open {
    overflow: hidden;
}

</style>

<script>

function zoomImage(src) {
    const modal = document.getElementById("imageModal");

    modal.style.display = "flex";
    document.getElementById("modalImg").src = src;

    document.body.classList.add("modal-open");
}

function closeModal() {
    const modal = document.getElementById("imageModal");

    modal.style.display = "none";
    document.body.classList.remove("modal-open");
}

</script>

@endsection