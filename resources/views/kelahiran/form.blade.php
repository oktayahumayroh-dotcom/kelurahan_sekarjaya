@extends('layouts.main')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4 py-md-5 d-flex justify-content-center">

<div class="card form-card shadow-lg border-0 w-100">
<div class="card-body p-4 p-md-5">

<h3 class="text-center fw-bold mb-4 judul-form">
    <i class="bi bi-person-badge-fill text-primary"></i> 
    Surat Keterangan Kelahiran
</h3>

<form id="formKelahiran" action="{{ route('kelahiran.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<!-- ================= DATA ANAK ================= -->
<h5 class="fw-bold text-primary">Data Anak</h5>
<hr>

<div class="row g-3">

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="nama" class="form-control" required>
<label>Nama</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="tempat_lahir" class="form-control" required>
<label>Tempat Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="date" name="tanggal_lahir" class="form-control" required>
<label>Tanggal Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<select name="jenis_kelamin" class="form-control" required>
<option value="">Pilih</option>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
<label>Jenis Kelamin</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="bangsa" class="form-control" required>
<label>Bangsa</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<select name="agama" class="form-control" required>
<option value="">Pilih</option>
<option>Islam</option>
<option>Kristen</option>
<option>Katolik</option>
<option>Hindu</option>
<option>Buddha</option>
<option>Konghucu</option>
</select>
<label>Agama</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="pekerjaan" class="form-control" required>
<label>Pekerjaan</label>
</div>
</div>

<div class="col-12">
<div class="form-floating">
<textarea name="alamat" class="form-control" style="height:100px" required></textarea>
<label>Alamat</label>
<small class="text-muted">
Tuliskan alamat tempat tinggal keluarga saat ini.
</small>
</div>
</div>

</div>

<!-- ================= AYAH ================= -->
<h5 class="mt-5 fw-bold">1. Ayah Kandung</h5>
<hr>

<div class="row g-3">

    <div class="col-md-6">
  <div class="form-floating">
    <input type="text" name="nik_ayah" class="form-control" maxlength="16" required>
    <label>NIK Ayah</label>
  </div>
</div>


<div class="col-md-6">
<div class="form-floating">
<input type="text" name="nama_ayah" class="form-control" required>
<label>Nama Ayah</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="tempat_lahir_ayah" class="form-control" required>
<label>Tempat Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="date" name="tanggal_lahir_ayah" class="form-control" required>
<label>Tanggal Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="pekerjaan_ayah" class="form-control" required>
<label>Pekerjaan</label>
</div>
</div>

<div class="col-12">
<div class="form-floating">
<textarea name="alamat_ayah" class="form-control" style="height:100px" required></textarea>
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
<input type="text" name="nama_ibu" class="form-control" required>
<label>Nama Ibu</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="tempat_lahir_ibu" class="form-control" required>
<label>Tempat Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="date" name="tanggal_lahir_ibu" class="form-control" required>
<label>Tanggal Lahir</label>
</div>
</div>

<div class="col-md-6">
<div class="form-floating">
<input type="text" name="pekerjaan_ibu" class="form-control" required>
<label>Pekerjaan</label>
</div>
</div>

<div class="col-12">
<div class="form-floating">
<textarea name="alamat_ibu" class="form-control" style="height:100px" required></textarea>
<label>Alamat</label>
</div>
</div>

</div>
<div class="col-12 mt-3">
    <div class="form-floating">
        <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
        <label>No WhatsApp</label>
    </div>

    <small class="text-muted">
        Nomor ini digunakan untuk notifikasi saat surat selesai diproses.
    </small>
</div>

<!-- ================= UPLOAD ================= -->
<        <!-- Upload -->
<div class="col-md-6">
    <label class="fw-semibold">Upload Surat Pengantar RT/RW  <span class="text-danger">*</span></label>

    <input type="file"
        name="upload_ktp"
        class="form-control"
        accept=".pdf,image/png,image/jpeg,image/webp"
        required>

    <small class="text-muted">
       Upload surat pengantar RT/RW (JPG, PNG, atau PDF).
</small><br>
   <small class="text-muted">
      Silakan unggah surat pengantar RT/RW yang telah ditandatangani oleh RT dan RW setempat.
</small>
    </small>

</div>
            
</div>
<!-- BUTTON -->
<div class="mt-4">
<button type="button" onclick="konfirmasiSubmit()" class="btn btn-primary btn-lg w-100 btn-modern">
<i class="bi bi-send-fill"></i> Kirim Sekarang
</button>
</div>

</form>

</div>
</div>
</div>

<style>
.form-card {
border-radius: 20px;
animation: fadeIn 0.5s ease-in-out;
}
.btn-modern {
border-radius: 30px;
transition: 0.3s;
}
.btn-modern:hover {
transform: scale(1.02);
}
@keyframes fadeIn {
from {opacity:0; transform: translateY(20px);}
to {opacity:1; transform: translateY(0);}
}
</style>

@endsection

@section('scripts')
<script>

 const inputKtp = document.querySelector('input[name="upload_ktp"]');

if (inputKtp) {
    inputKtp.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
            'application/pdf'
        ];

        if (!allowedTypes.includes(file.type)) {
            Swal.fire('Error', 'Format harus JPG, PNG, WEBP, atau PDF', 'error');
            this.value = '';
            return;
        }

        // limit 5MB
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            Swal.fire('Error', 'File maksimal 5MB', 'error');
            this.value = '';
            return;
        }

        // PDF langsung skip (tanpa kompres)
        if (file.type === 'application/pdf') return;

        // IMAGE compression ringan (langsung)
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = new Image();
            img.src = e.target.result;

            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                const maxWidth = 1000;
                const scale = maxWidth / img.width;

                canvas.width = maxWidth;
                canvas.height = img.height * scale;

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob(function (blob) {
                    if (!blob) return;

                    const compressedFile = new File([blob], file.name, {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });

                    const dt = new DataTransfer();
                    dt.items.add(compressedFile);
                    inputKtp.files = dt.files;

                }, 'image/jpeg', 0.7);
            };
        };

        reader.readAsDataURL(file);
    });
}
// SUBMIT
function konfirmasiSubmit() {

let valid = true;

document.querySelectorAll('#formKelahiran [required]').forEach(function(input) {
if (!input.value) {
valid = false;
}
});

if (!valid) {
Swal.fire('Error','Semua field wajib diisi','error');
return;
}

Swal.fire({
title: 'Kirim Data?',
icon: 'question',
showCancelButton: true,
confirmButtonText: 'Kirim',
cancelButtonText: 'Cek Lagi'
}).then((result) => {
if (result.isConfirmed) {
document.getElementById('formKelahiran').submit();
}
});

}

</script>

@if(session('success'))
<script>
Swal.fire({
title: 'Berhasil!',
text: 'Permohonan berhasil dikirim',
icon: 'success',
confirmButtonText: 'Cek Status'
}).then(() => {
window.location.href = "/cek-status";
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    title: 'Gagal!',
    text: '{{ session('error') }}',
    icon: 'error',
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'OK'
});
</script>
@endif

@endsection