@extends('admin.layout')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4 py-md-5 d-flex justify-content-center">

<div class="card form-card shadow-lg border-0 w-100">

<form id="form-generate"
      method="POST"
      action="{{ route('admin.update', ['jenis' => 'kelahiran', 'id' => $surat->id]) }}">
    @csrf
<div class="card-body p-4 p-md-5">

<h3 class="text-center fw-bold mb-4 judul-form">
    <i class="bi bi-person-badge-fill text-primary"></i> 
    Edit Surat Keterangan Kelahiran
</h3>



<!-- MODAL ZOOM -->
<div id="modalZoom" onclick="tutupZoom()">
    <span class="close-btn">&times;</span>
    <img id="imgZoom">
</div>


<!-- ================= DATA ANAK ================= -->
<h5 class="mt-4 fw-bold text-primary">Data Anak</h5>
<hr>

<div class="row g-3">
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="nama" class="form-control" required value="{{ $surat->nama }}">
            <label>Nama</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="tempat_lahir" class="form-control" required value="{{ $surat->tempat_lahir }}">
            <label>Tempat Lahir</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" name="tanggal_lahir" class="form-control" required value="{{ $surat->tanggal_lahir }}">
            <label>Tanggal Lahir</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ $surat->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $surat->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <label>Jenis Kelamin</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="bangsa" class="form-control" required value="{{ $surat->bangsa }}">
            <label>Bangsa</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <select name="agama" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Islam" {{ $surat->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ $surat->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ $surat->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ $surat->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ $surat->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ $surat->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
            <label>Agama</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="pekerjaan" class="form-control" required value="{{ $surat->pekerjaan }}">
            <label>Pekerjaan</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <textarea name="alamat" class="form-control" style="height:100px" required>{{ $surat->alamat }}</textarea>
            <label>Alamat</label>
        </div>
    </div>
</div>

<!-- ================= AYAH ================= -->
<h5 class="mt-5 fw-bold">1. Ayah Kandung</h5>
<hr>

<div class="row g-3">
    <!-- NIK Ayah -->
    <div class="col-md-6 mb-3">
        <div class="form-floating">
            <input type="text" name="nik_ayah" class="form-control" maxlength="16" required value="{{ $surat->nik_ayah }}">
            <label>NIK Ayah</label>
        </div>
    </div>

    <!-- Nama Ayah -->
    <div class="col-md-6 mb-3">
        <div class="form-floating">
            <input type="text" name="nama_ayah" class="form-control" required value="{{ $surat->nama_ayah }}">
            <label>Nama Ayah</label>
        </div>
    </div>

    <!-- Tempat Lahir Ayah -->
    <div class="col-md-6 mb-3">
        <div class="form-floating">
            <input type="text" name="tempat_lahir_ayah" class="form-control" required value="{{ $surat->tempat_lahir_ayah }}">
            <label>Tempat Lahir</label>
        </div>
    </div>

    <!-- Tanggal Lahir Ayah -->
    <div class="col-md-6 mb-3">
        <div class="form-floating">
            <input type="date" name="tanggal_lahir_ayah" class="form-control" required value="{{ $surat->tanggal_lahir_ayah }}">
            <label>Tanggal Lahir</label>
        </div>
    </div>

    <!-- Pekerjaan Ayah -->
    <div class="col-md-6 mb-3">
        <div class="form-floating">
            <input type="text" name="pekerjaan_ayah" class="form-control" required value="{{ $surat->pekerjaan_ayah }}">
            <label>Pekerjaan</label>
        </div>
    </div>

    <!-- Alamat Ayah -->
    <div class="col-12 mb-3">
        <div class="form-floating">
            <textarea name="alamat_ayah" class="form-control" style="height:100px" required>{{ $surat->alamat_ayah }}</textarea>
            <label>Alamat</label>
        </div>
    </div>
</div>

<!-- ================= IBU ================= -->
<h5 class="mt-5 fw-bold">2. Ibu Kandung</h5>
<hr>
<div class="row g-3">
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="nama_ibu" class="form-control" required value="{{ $surat->nama_ibu }}">
            <label>Nama Ibu</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="tempat_lahir_ibu" class="form-control" required value="{{ $surat->tempat_lahir_ibu }}">
            <label>Tempat Lahir</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" name="tanggal_lahir_ibu" class="form-control" required value="{{ $surat->tanggal_lahir_ibu }}">
            <label>Tanggal Lahir</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" name="pekerjaan_ibu" class="form-control" required value="{{ $surat->pekerjaan_ibu }}">
            <label>Pekerjaan</label>
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating">
            <textarea name="alamat_ibu" class="form-control" style="height:100px" required>{{ $surat->alamat_ibu }}</textarea>
            <label>Alamat</label>
        </div>
    </div>
</div>

@if($surat->upload_ktp)
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <h6 class="fw-bold text-primary mb-2">
            <i class="bi bi-file-earmark-text"></i>
            Surat Pengantar RT/RW
        </h6>

        <small class="text-muted d-block mb-3">
            Dokumen pendukung yang diunggah oleh pemohon.
        </small>

        <a href="{{ asset($surat->upload_ktp) }}"
           target="_blank"
           class="btn btn-success btn-sm">
            <i class="bi bi-eye"></i>
            Lihat Dokumen
        </a>

    </div>
</div>
@endif

<!-- ================= INFORMASI SURAT (PINDAHAN) ================= -->
<h5 class="mt-5 fw-bold text-primary">Informasi Surat</h5>
<hr>

<div class="row g-3">

    <!-- NOMOR URUT -->
    <div class="col-12 col-md-6">

        <label class="fw-semibold">
            Nomor Urut <span class="text-danger">*</span>
        </label>

        <input type="number"
               name="nomor_urut"
               id="nomor_manual"
               class="form-control"
               value="{{ old('nomor_urut', $surat->nomor_urut) }}">

        <small class="text-muted d-block mt-1">
            Isi sesuai buku register surat keluar
        </small>

        <div id="error-nomor"
             class="text-danger mt-1"
             style="display:none;">
            Nomor urut sudah dipakai di surat lain
        </div>

    </div>

    <!-- TANGGAL -->
    <div class="col-12 col-md-6">

        <label class="fw-semibold">
            Tanggal Surat <span class="text-danger">*</span>
        </label>

        <input type="date"
               name="tanggal_surat"
               class="form-control"
               value="{{ $surat->tanggal_surat ?? date('Y-m-d') }}"
               required>

        <small class="text-muted d-block mt-1">
            Tanggal ini akan digunakan sebagai tanggal resmi pada surat
        </small>

    </div>

    <!-- PREVIEW -->
    <div class="col-12">

        <label class="fw-bold">Preview Nomor Surat</label>

        <div class="p-3 border rounded bg-light text-center">
            <small class="text-muted">Format sistem</small>

            <div id="preview_nomor" class="fw-bold fs-5 text-success mt-1">
                {{ $surat->nomor_surat ?? '-' }}
            </div>
        </div>

    </div>

</div>

<!-- HIDDEN FINAL -->
<input type="hidden" name="nomor_surat" id="nomor_surat" value="{{ $surat->nomor_surat }}">

<!-- BUTTONS -->
<div class="mt-4">
    <div class="row g-2">

        <!-- KIRI -->
        <div class="col-12 col-md-6 d-flex gap-2">

            <a href="{{ route('admin.pengajuan') }}"
               class="btn btn-light">
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
        <div class="col-12 col-md-6 d-flex justify-content-md-end gap-2">

          

            <button type="button" onclick="konfirmasiGenerate()"
                    class="btn btn-primary">
                Simpan & Lanjut
            </button>

        </div>

    </div>
</div>

</div>
</form>



</div>
</div>
</div>

<style>
.form-card { border-radius: 20px; animation: fadeIn 0.5s ease-in-out; }
.btn { border-radius: 8px; transition: 0.3s; }
.btn:hover { transform: scale(1.02); }



.is-invalid {
    border: 2px solid #dc3545 !important;
    background-color: #fff5f5;
}

#preview_nomor {
    font-size: 15px;
    letter-spacing: 0.5px;
}


    #preview-ktp button{
    position:absolute;
    top:5px;
    right:5px;
    border:none;
    background:red;
    color:white;
    width:22px;
    height:22px;
    border-radius:50%;
    font-size:12px;
    cursor:pointer;
}

/* MODAL ZOOM */
#modalZoom{
    display:none;
    position:fixed;
    z-index:999999;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.9);
    justify-content:center;
    align-items:center;
}

#modalZoom img{
    max-width:90%;
    max-height:90%;
}

.close-btn{
    position:absolute;
    top:20px;
    right:30px;
    font-size:30px;
    color:white;
    cursor:pointer;
}

/* HP */
@media(max-width:576px){
    #preview-ktp{
        width:120px;
        top:10px;
        right:10px;
    }
}
</style>
<script>

// =========================
// KONFIRMASI + VALIDASI + DUPLIKAT
// =========================
function konfirmasiGenerate(){

    let form = document.getElementById('form-generate');
    let inputs = form.querySelectorAll('input, textarea, select');
    let kosong = false;

    inputs.forEach(el => el.style.border = '');

    inputs.forEach(el => {

        if (el.type === 'hidden') return;

        if (!el.value || el.value.trim() === '') {

            el.style.border = '2px solid red';

            if (!kosong) el.focus();

            kosong = true;
        }
    });

    if (kosong) {
        Swal.fire({
            icon: 'warning',
            title: 'Masih ada data kosong',
            text: 'Lengkapi dulu sebelum lanjut'
        });
        return;
    }

    let nomor = document.getElementById('nomor_manual').value;
    let tanggal = document.querySelector('[name="tanggal_surat"]').value;
    let id = "{{ $surat->id }}";

    fetch(`/admin/cek-nomor?nomor_urut=${nomor}&tanggal_surat=${tanggal}&id=${id}`)
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
            lanjutSubmit();
        });
}


// =========================
// SUBMIT
// =========================
function lanjutSubmit(){

    Swal.fire({
        title: 'Lanjut ke proses generate?',
        text: 'Data akan disimpan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result)=>{

        if(result.isConfirmed){

            let form = document.getElementById('form-generate');

            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "action";
            input.value = "generate";

            form.appendChild(input);
            form.submit();
        }
    });
}


// =========================
// PREVIEW REALTIME (FIX TOTAL)
// =========================
document.addEventListener("DOMContentLoaded", function () {

    let input = document.getElementById('nomor_manual');
    let preview = document.getElementById('preview_nomor');
    let tanggalEl = document.querySelector('[name="tanggal_surat"]');
    let hidden = document.getElementById('nomor_surat');

    if (!input) return;

    function updatePreview(){

        let val = input.value;

        // 🔥 JIKA KOSONG → RESET TOTAL
        if (!val || val.trim() === '') {
            if (preview) preview.innerText = '-';
            if (hidden) hidden.value = '';

            let id = "{{ $surat->id }}";
            localStorage.removeItem("nomor_surat_" + id);
            localStorage.removeItem("nomor_urut_" + id);
            return;
        }

        let nomor = String(parseInt(val)).padStart(3, '0');

        let tahun = (tanggalEl && tanggalEl.value)
            ? new Date(tanggalEl.value).getFullYear()
            : new Date().getFullYear();

        let hasil = `100 / ${nomor} / LXIX / ${tahun}`;

        if (hidden) hidden.value = hasil;
        if (preview) preview.innerText = hasil;

        let id = "{{ $surat->id }}";
        localStorage.setItem("nomor_surat_" + id, hasil);
        localStorage.setItem("nomor_urut_" + id, val);
    }

    input.addEventListener('input', updatePreview);

    if (tanggalEl) {
        tanggalEl.addEventListener('change', updatePreview);
    }

});


// =========================
// LOAD SAAT REFRESH (SAFE)
// =========================
document.addEventListener("DOMContentLoaded", function () {

    let id = "{{ $surat->id }}";

    let savedNomor = localStorage.getItem("nomor_surat_" + id);
    let savedUrut = localStorage.getItem("nomor_urut_" + id);

    let preview = document.getElementById("preview_nomor");
    let input = document.getElementById("nomor_manual");
    let hidden = document.getElementById('nomor_surat');

    // ❗ jangan load kalau input kosong dari DB juga
    if (input && input.value.trim() === '') {
        return;
    }

    if (savedNomor && preview) {
        preview.innerText = savedNomor;
        if (hidden) hidden.value = savedNomor;
    }

    if (savedUrut && input) {
        input.value = savedUrut;
    }

});


// =========================
// ZOOM GAMBAR
// =========================
function zoomGambar(src){
    document.getElementById('imgZoom').src = src;
    document.getElementById('modalZoom').style.display='flex';
}

function tutupZoom(){
    document.getElementById('modalZoom').style.display='none';
}

</script>
@endsection