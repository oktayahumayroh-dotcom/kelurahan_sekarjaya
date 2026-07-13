@extends('admin.layout')

@section('content')

<div class="halaman-edit">

<div class="container py-4">

    <div class="card edit-card shadow-sm border-0">

        <div class="card-body p-4 p-md-5">

            <h4 class="fw-bold mb-4 text-center">
                Edit Surat Domisili
            </h4>

            <!-- PREVIEW KTP -->



{{-- 🔴 ALERT ERROR --}}
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>❌ Error!</strong> {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- 🟢 ALERT SUCCESS (opsional tapi bagus) --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <strong>✅ Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

            <form id="form-generate"
                  action="{{ route('admin.update', ['jenis' => 'domisili', 'id' => $surat->id]) }}"
                  method="POST">

                @csrf

                <!-- USER DATA -->
                <h6 class="section-title">Data Pemohon</h6>

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ $surat->nik }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $surat->nama }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Bin / Binti</label>
                        <input type="text" name="bin_binti" class="form-control" value="{{ $surat->bin_binti }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $surat->tanggal_lahir }}">
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Laki-laki" {{ $surat->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $surat->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Agama</label>
                        <select name="agama" class="form-control">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Kewarganegaraan</label>
                        <select name="kewarganegaraan" class="form-control">
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" value="{{ $surat->pekerjaan }}">
                    </div>

            <div class="col-12">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control">{{ $surat->alamat }}</textarea>
</div>

<!-- 🔥 PENGANTAR RT/RW (STYLE FILE) -->
@if($surat->pengantar_rt_rw)
<div class="col-12 mt-3">

    <label class="fw-semibold mb-2 d-block">
        📄 Surat Pengantar RT/RW
    </label>

    <div class="file-box d-flex align-items-center justify-content-between flex-wrap gap-2">

        <!-- KIRI -->
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-file-earmark-text fs-2 text-primary"></i>

            <div>
                <div class="fw-semibold">
                    {{ basename($surat->pengantar_rt_rw) }}
                </div>
                <small class="text-muted">
                    File pengantar dari RT/RW
                </small>
            </div>
        </div>

        <!-- KANAN -->
        <div>
            <a href="{{ asset($surat->pengantar_rt_rw) }}" 
               target="_blank"
               class="btn btn-sm btn-primary">
               👁 Lihat
            </a>
        </div>

    </div>

    <small class="text-muted d-block mt-2">
        Digunakan sebagai bukti pengantar dari RT/RW untuk verifikasi domisili pemohon.
    </small>

</div>
@endif

                

                <hr class="my-4">

                <!-- ADMIN DATA -->
                <h6 class="section-title">Data Administrasi</h6>

              <div class="row g-3">

    <!-- NOMOR URUT -->
    <div class="col-12 col-md-6">

    <label class="fw-bold">
        <i class="bi bi-hash"></i> Nomor Urut
    </label>

    <input type="number"
           name="nomor_urut"
           id="nomor_manual"
           class="form-control {{ session('error') ? 'is-invalid' : '' }}"
           value="{{ old('nomor_urut', $surat->nomor_urut) }}"
           {{ $surat->status_surat == 'selesai' ? 'readonly' : '' }}>

    <small class="text-muted d-block mt-1">
        Isi sesuai nomor pada buku register surat keluar
    </small>

</div>

    <!-- TANGGAL SURAT -->
    <div class="col-12 col-md-6">

        <label class="fw-semibold">
            <i class="bi bi-calendar"></i> Tanggal Surat
            <span class="text-danger">*</span>
        </label>

        <input type="date"
               name="tanggal_surat"
               class="form-control"
               value="{{ $surat->tanggal_surat ?? date('Y-m-d') }}"
               required>

        <small class="text-muted d-block mt-1">
            Tanggal resmi yang akan tercetak pada surat
        </small>

    </div>

    <!-- PREVIEW (FULL WIDTH) -->
    <div class="col-12">

        <label class="fw-bold mb-2">
            <i class="bi bi-eye"></i> Preview Nomor Surat
        </label>

        <div class="p-3 border rounded bg-light text-center shadow-sm">

            <small class="text-muted d-block">
                Format otomatis sistem
            </small>

            <div id="preview_nomor"
                 class="fw-bold fs-5 mt-1 text-primary">
                -
            </div>

        </div>

    </div>

</div>

<input type="hidden" name="nomor_surat" id="nomor_surat" value="{{ $surat->nomor_surat }}">
<!-- HIDDEN INPUT -->


       <!-- BUTTON -->
<div class="mt-4">
    <div class="row g-2">

        <!-- KIRI -->
        <div class="col-12 col-md-6 d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.pengajuan') }}"
               class="btn btn-light d-none d-md-inline-flex">
                ← Kembali
            </a>

            @if($surat->status_surat == 'proses')
            <a href="{{ route('admin.tolak.form', [
                'jenis' => request()->route('jenis'),
                'id' => $surat->id
            ]) }}"
               class="btn btn-danger">
                ❌ Tolak
            </a>
            @endif
        </div>

        <!-- KANAN -->
        <div class="col-12 col-md-6 d-flex justify-content-md-end gap-2 flex-wrap">

       

            <button type="button" onclick="konfirmasiGenerate()"
                    class="btn btn-primary">
                Simpan & Lanjut
            </button>

        </div>

    </div>
</div>

</div>

    </div>

</div>

            </form>

        </div>
    </div>

</div>

</div>

@endsection

@section('scripts')

<style>

/* BACKGROUND */
.halaman-edit{
    min-height:100vh;
    background: linear-gradient(135deg,#f5f7fa,#eef2f7);
}

/* CARD */
.edit-card{
    border-radius:16px;
}

/* SECTION */
.section-title{
    font-weight:600;
    margin-bottom:10px;
}

/* PREVIEW KTP */


/* MODAL ZOOM */
#modalZoom {
    display: none;
    position: fixed;
    z-index: 99999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    background: rgba(0,0,0,0.9);

    justify-content: center;
    align-items: center;
}

#modalZoom img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}

/* tombol close */
#modalZoom .close-btn {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 30px;
    color: white;
    cursor: pointer;
}

.is-invalid {
    border: 2px solid #dc3545 !important;
    background-color: #fff5f5;
}

.file-box {
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 12px 15px;
    background: #f8f9fa;
    transition: 0.3s;
}

.file-box:hover {
    background: #eef3ff;
    border-color: #0d6efd;
}

/* RESPONSIVE */
@media (max-width: 576px) {
    .file-box {
        flex-direction: column;
        align-items: flex-start !important;
    }

    .file-box a {
        width: 100%;
    }
}
</style>



<script>

// =========================
// GENERATE NOMOR (FIXED CLEAN)
// =========================
function generateNomor(jenis) {

    let manual = prompt("Masukkan nomor urut (contoh: 001)");
    if (!manual) return;

    let nomor = String(manual).padStart(3, '0');
    let tanggalInput = document.querySelector('[name="tanggal_surat"]').value;
let tahun = new Date(tanggalInput).getFullYear();

    let kodeMap = {
        domisili: 100,
        usaha: 500,
        tidak_mampu: 400,
        kelahiran: 100
    };

    let kode = kodeMap[jenis] ?? 100;

    let hasil = `${kode} / ${nomor} / LXIX / ${tahun}`;

    let elSurat = document.getElementById('nomor_surat');
    let elUrut = document.getElementById('nomor_manual');
    let elPreview = document.getElementById('preview_nomor');

    if (elSurat) elSurat.value = hasil;
    if (elUrut) elUrut.value = manual;
    if (elPreview) elPreview.innerText = hasil;

    // 🔥 SIMPAN BIAR TIDAK HILANG SAAT REFRESH
    let id = "{{ $surat->id }}";
    localStorage.setItem("nomor_surat_" + id, hasil);
    localStorage.setItem("nomor_urut_" + id, manual);

    Swal.fire({
        icon: 'success',
        title: 'Nomor berhasil diset',
        text: hasil,
        timer: 1200,
        showConfirmButton: false
    });
}


// =========================
// ZOOM GAMBAR
// =========================
function zoomGambar(src) {
    document.getElementById('imgZoom').src = src;
    document.getElementById('modalZoom').style.display = 'flex';
}

function tutupZoom() {
    document.getElementById('modalZoom').style.display = 'none';
}


// =========================
// INPUT MANUAL LISTENER (LIVE UPDATE + SAVE)
// =========================
document.addEventListener("DOMContentLoaded", function () {

    let input = document.getElementById('nomor_manual');
    let preview = document.getElementById('preview_nomor');

    if (!input) return;

    input.addEventListener('input', function () {

        let val = this.value;
        if (!val) return;

        let nomor = String(parseInt(val)).padStart(3, '0');
        let tahun = new Date().getFullYear();

        let jenis = "{{ $surat->jenis ?? 'domisili' }}";

        let kodeMap = {
            domisili: 100,
            usaha: 500,
            tidak_mampu: 400,
            kelahiran: 100
        };

        let kode = kodeMap[jenis] ?? 100;

        let hasil = `${kode} / ${nomor} / LXIX / ${tahun}`;

        document.getElementById('nomor_surat').value = hasil;
        if (preview) preview.innerText = hasil;

        // 🔥 SAVE LIVE STATE
        let id = "{{ $surat->id }}";
        localStorage.setItem("nomor_surat_" + id, hasil);
        localStorage.setItem("nomor_urut_" + id, val);
    });

});


// =========================
// LOAD STATE (DB + LOCALSTORAGE)
// =========================
document.addEventListener("DOMContentLoaded", function () {

    let id = "{{ $surat->id }}";

    let savedNomor = localStorage.getItem("nomor_surat_" + id);
    let savedUrut = localStorage.getItem("nomor_urut_" + id);

    let preview = document.getElementById("preview_nomor");
    let input = document.getElementById("nomor_manual");

    // 🔥 kalau ada localStorage → pakai itu
    if (savedNomor && preview) {
        preview.innerText = savedNomor;
        document.getElementById('nomor_surat').value = savedNomor;
    }

    if (savedUrut && input) {
        input.value = savedUrut;
    }

});


// =========================
// KONFIRMASI GENERATE
// =========================
function konfirmasiGenerate() {

    let nomor = document.getElementById('nomor_manual').value;
    let tanggal = document.querySelector('[name="tanggal_surat"]').value;
    let nomorSurat = document.getElementById('nomor_surat').value;

    if (!nomor || !tanggal) {
        Swal.fire({
            icon: 'warning',
            title: 'Data belum lengkap',
            text: 'Nomor urut dan tanggal wajib diisi'
        });
        return;
    }

    let id = "{{ $surat->id }}";

fetch(`/cek-nomor?nomor_urut=${nomor}&tanggal_surat=${tanggal}&id=${id}`)
        .then(res => res.json())
        .then(data => {

            if (data.duplikat) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor Duplikat!',
                    text: 'Nomor urut sudah dipakai di tahun ini'
                });
                return;
            }

            lanjutSubmit();

        })
        .catch(err => {
            console.error(err);

            // 🔥 fallback kalau API error
            lanjutSubmit();
        });

}

function lanjutSubmit() {

    Swal.fire({
        title: 'Lanjut simpan & generate?',
        text: 'Data akan diproses dan nomor disimpan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (!result.isConfirmed) return;

        let form = document.getElementById('form-generate');

        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'action';
        input.value = 'generate';

        form.appendChild(input);

        form.submit();
    });
}

</script>
@endsection