@extends('admin.layout')

@section('content')

<div class="halaman-edit">

<div class="container py-4">

    <div class="card edit-card shadow-sm border-0">

        <div class="card-body p-4 p-md-5">

            <h4 class="fw-bold mb-4 text-center">
                Edit Surat Tidak Mampu
            </h4>

            <!-- PREVIEW KTP -->
            

            <form id="form-generate"
                  action="{{ route('admin.update', ['jenis' => 'tidak_mampu', 'id' => $surat->id]) }}"
                  method="POST">

                @csrf

                <!-- DATA PEMOHON -->
                <h6 class="section-title">Data Pemohon</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $surat->nama }}">
                    </div>

                    <div class="col-md-6">
                        <label>Bin / Binti</label>
                        <input type="text" name="bin_binti" class="form-control" value="{{ $surat->bin_binti }}">
                    </div>

                    <div class="col-md-6">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ $surat->nik }}">
                    </div>

                    <div class="col-md-6">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $surat->tempat_lahir }}">
                    </div>

                    <div class="col-md-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $surat->tanggal_lahir }}">
                    </div>

                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Laki-laki" {{ $surat->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $surat->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Agama</label>
                        <select name="agama" class="form-control">
                            <option value="Islam" {{ $surat->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $surat->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $surat->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $surat->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $surat->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ $surat->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Kewarganegaraan</label>
                        <select name="kewarganegaraan" class="form-control">
                            <option value="WNI" {{ $surat->kewarganegaraan == 'WNI' ? 'selected' : '' }}>WNI</option>
                            <option value="WNA" {{ $surat->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" value="{{ $surat->pekerjaan }}">
                    </div>

                    <div class="col-12">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $surat->alamat }}</textarea>
                    </div>

                </div>

                @if($surat->upload_ktp)
<div class="mb-3">

    <label class="fw-bold">
        Surat Pengantar RT/RW
    </label>

    <div class="border rounded p-3 bg-light d-flex justify-content-between align-items-center">

        <span class="text-muted">
            File sudah diupload
        </span>

        <a href="{{ asset($surat->upload_ktp) }}"
           target="_blank"
           class="btn btn-success btn-sm">
            Lihat File
        </a>

    </div>

</div>
@endif

                <hr class="my-4">

                <!-- ADMIN -->
             <div class="row g-3">

    <!-- NOMOR URUT -->
    <div class="col-md-6">
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
    <div class="col-md-6">
        <label class="fw-semibold">
            Tanggal Surat <span class="text-danger">*</span>
        </label>

        <input type="date"
               name="tanggal_surat"
               class="form-control"
               value="{{ $surat->tanggal_surat ?? date('Y-m-d') }}">
    </div>

    <!-- PREVIEW -->
    <div class="col-12">
        <label class="fw-bold">Preview Nomor Surat</label>

        <div class="p-3 border rounded bg-light text-center">
            <small class="text-muted">Format sistem</small>

            <div id="preview_nomor" class="fw-bold fs-5 text-primary mt-1">
                {{ $surat->nomor_surat ?? '-' }}
            </div>
        </div>
    </div>

</div>

<!-- HIDDEN FINAL -->
<input type="hidden" name="nomor_surat" id="nomor_surat" value="{{ $surat->nomor_surat }}">

                <!-- BUTTON -->
              <div class="mt-4">
    <div class="row g-2">

        <!-- KIRI -->
        <div class="col-12 col-md-6 d-flex gap-2">
            <a href="{{ route('admin.pengajuan') }}" class="btn btn-light">
                ← Kembali
            </a>

            @if($surat->status_surat == 'proses')
            <a href="{{ route('admin.tolak.form', [
                'jenis' => request()->route('jenis'),
                'id' => $surat->id
            ]) }}" class="btn btn-danger">
                ❌ Tolak
            </a>
            @endif
        </div>

        <!-- KANAN -->


            <button type="button" onclick="konfirmasiGenerate()"
                    class="btn btn-primary">
                Simpan & Lanjut
            </button>
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

/* PREVIEW FLOAT */

.close-btn{
    position:absolute;
    top:20px;
    right:30px;
    font-size:30px;
    color:white;
}

.is-invalid {
    border: 2px solid #dc3545 !important;
    background-color: #fff5f5;
}

</style>

<script>

// =========================
// VALIDASI FORM + CEK DUPLIKAT
// =========================
function konfirmasiGenerate(){

    let form = document.getElementById('form-generate');
    let inputs = form.querySelectorAll('input, textarea, select');
    let kosong = false;

    // reset border
    inputs.forEach(el => el.style.border = '');

    // cek kosong
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

    // =========================
    // CEK DUPLIKAT
    // =========================
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
            input.type="hidden";
            input.name="action";
            input.value="generate";

            form.appendChild(input);
            form.submit();
        }

    });
}


// =========================
// PREVIEW + SAVE (REALTIME)
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

        let hasil = `400 / ${nomor} / LXIX / ${tahun}`;

        document.getElementById('nomor_surat').value = hasil;
        if (preview) preview.innerText = hasil;

    });

});


// =========================
// LOAD SAAT REFRESH
// =========================



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