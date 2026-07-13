@extends('admin.layout')

@section('content')

<div class="halaman-edit">

<div class="container py-4">

    <div class="card edit-card shadow-sm border-0">

        <div class="card-body p-4 p-md-5">

            <h4 class="fw-bold mb-4 text-center">
                Edit Surat Usaha
            </h4>

            <!-- PREVIEW KTP -->
    

            <!-- MODAL ZOOM -->
<div id="modalZoom"
     onclick="this.style.display='none'">

    <span style="
        position:absolute;
        top:20px;
        right:30px;
        font-size:40px;
        color:white;
        z-index:9999999;
        cursor:pointer;
    ">
        &times;
    </span>

    <img id="imgZoom">
</div>

            <form id="form-generate"
                  action="{{ route('admin.update', ['jenis' => 'usaha', 'id' => $surat->id]) }}"
                  method="POST">

                @csrf

                <!-- DATA PEMOHON -->
                <h6 class="section-title">Data Pemohon</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" value="{{ $surat->nik }}">
                    </div>

                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $surat->nama }}">
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
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Belum Menikah" {{ $surat->status == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ $surat->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
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

                <hr class="my-4">

                <!-- DATA USAHA -->
                <h6 class="section-title">Data Usaha</h6>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" class="form-control" value="{{ $surat->jenis_usaha }}">
                    </div>

                    <div class="col-md-6">
                        <label>Tempat Usaha</label>
                        <input type="text" name="tempat_usaha" class="form-control" value="{{ $surat->tempat_usaha }}">
                    </div>

                </div>


                @if($surat->upload_ktp)
<div class="alert alert-light border mb-4">
    <div class="d-flex justify-content-between align-items-center">

        <div>
            <strong>Surat Pengantar RT/RW</strong><br>
            <small class="text-muted">
                Dokumen pendukung yang diunggah pemohon.
            </small>
        </div>

        <a href="{{ asset($surat->upload_ktp) }}"
           target="_blank"
           class="btn btn-success btn-sm">
            Lihat Dokumen
        </a>

    </div>
</div>
@endif

                <hr class="my-4">

                <!-- ADMIN -->
          <!-- NOMOR URUT -->
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
    </div> <!-- ✅ INI YANG KURANG -->

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
                Generate
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

/* PREVIEW FLOAT (INI KUNCI BIAR GA GESER) */

/* HP FIX */


/* MODAL */
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
    cursor: zoom-in;
}

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
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
}

</style>

<script>

// =========================
// INPUT MANUAL (PREVIEW)
// =========================
document.addEventListener("DOMContentLoaded", function () {

    let input = document.getElementById('nomor_manual');
    let preview = document.getElementById('preview_nomor');

    if (!input) return;

    input.addEventListener('input', function () {

        let val = this.value;
        if (!val) {
            if (preview) preview.innerText = "-";
            return;
        }

        let nomor = String(parseInt(val)).padStart(3, '0');
        let tanggal = document.querySelector('[name="tanggal_surat"]').value;
        let tahun = tanggal ? new Date(tanggal).getFullYear() : new Date().getFullYear();

        let hasil = `500 / ${nomor} / LXIX / ${tahun}`;

        document.getElementById('nomor_surat').value = hasil;
        if (preview) preview.innerText = hasil;
    });

});


// =========================
// KONFIRMASI GENERATE
// =========================
function konfirmasiGenerate() {

    let nomor = document.getElementById('nomor_manual').value;
    let tanggal = document.querySelector('[name="tanggal_surat"]').value;

    if (!nomor || !tanggal) {
        Swal.fire({
            icon: 'warning',
            title: 'Data belum lengkap',
            text: 'Nomor urut dan tanggal wajib diisi'
        });
        return;
    }

    let id = "{{ $surat->id }}";

    fetch(`/admin/cek-nomor?nomor_urut=${nomor}&tanggal_surat=${tanggal}&id=${id}`)
        .then(res => {

            // 🔥 CEK RESPONSE DULU
            if (!res.ok) {
                throw new Error('Route / server error');
            }

            return res.json();
        })
        .then(data => {

            // 🔥 VALIDASI DUPLIKAT
            if (data.duplikat) {

                Swal.fire({
                    icon: 'error',
                    title: 'Nomor Duplikat!',
                    text: 'Nomor urut sudah dipakai di tahun ini'
                });

                return; // ⛔ STOP
            }

            // ✅ LANJUT
            lanjutSubmit();

        })
        .catch(err => {

            console.error(err);

            // ❗ JANGAN LANJUT SUBMIT
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal cek nomor (route / server bermasalah)'
            });

        });
}


// =========================
// SUBMIT FINAL
// =========================
function lanjutSubmit() {

    Swal.fire({
        title: 'Lanjut proses?',
        text: 'Data akan digenerate',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (!result.isConfirmed) return;

        let form = document.getElementById('form-generate');

        // hapus action lama kalau ada
        let old = form.querySelector('input[name="action"]');
        if (old) old.remove();

        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "action";
        input.value = "generate";

        form.appendChild(input);
        form.submit();
    });
}

</script>

@endsection