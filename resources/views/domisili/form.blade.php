@extends('layouts.main')

@section('content')

<!-- 🔥 BOOTSTRAP ICON -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<div class="container py-4 py-md-5 d-flex justify-content-center">

<div class="card form-card shadow-lg border-0 w-100">
<div class="card-body p-4 p-md-5">

    <h3 class="text-center fw-bold mb-4 judul-form">
        <i class="bi bi-house-door-fill text-success"></i> 
        Surat Domisili
    </h3>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

<form id="formDomisili" action="{{ route('domisili.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row g-3">

    <!-- NIK -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" maxlength="16" required>
            <label>NIK</label>
        </div>
        <small id="errorNik"></small>
    </div>

    <!-- Nama -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
            <label>Nama</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- BIN -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="text" name="bin_binti" class="form-control" placeholder="Bin/Binti" required>
            <label>Bin / Binti</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Tempat Lahir -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
            <label>Tempat Lahir</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Tanggal -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="date" name="tanggal_lahir" class="form-control" required>
            <label>Tanggal Lahir</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Gender -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
            </select>
            <label>Jenis Kelamin</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Agama -->
    <div class="col-12 col-md-6">
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
        <small class="error"></small>
    </div>

    <!-- Status -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <select name="status" class="form-control" required>
                <option value="">Pilih</option>
                <option>Belum Menikah</option>
                <option>Menikah</option>
            </select>
            <label>Status</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Warga -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <select name="kewarganegaraan" class="form-control" required>
                <option value="">Pilih</option>
                <option>WNI</option>
                <option>WNA</option>
            </select>
            <label>Kewarganegaraan</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Pekerjaan -->
    <div class="col-12 col-md-6">
        <div class="form-floating">
            <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
            <label>Pekerjaan</label>
        </div>
        <small class="error"></small>
    </div>

    <!-- Alamat -->
    <div class="col-12">
        <div class="form-floating">
            <textarea name="alamat" class="form-control" style="height:100px" required></textarea>
            <label>Alamat Domisili</label>
        </div>
        <small class="error"></small>
    </div>
    <small class="text-muted">
Isi alamat tempat tinggal saat ini (wilayah kelurahan). KTP digunakan untuk verifikasi.
</small>
<div class="col-12 mt-3">
    <div class="form-floating">
        <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
        <label>No WhatsApp</label>
    </div>
    <small class="text-muted">
        Nomor digunakan untuk notifikasi saat surat selesai
    </small>
    <small class="error"></small>
</div>

</div>

<!-- Upload Pengantar RT/RW -->
<div class="col-12 mt-3">
    <label class="mb-1 fw-semibold">
        <i class="bi bi-folder2-open"></i> Upload Surat Pengantar RT/RW
        <span class="text-danger">*</span>
    </label>

    <input type="file"
           name="pengantar_rt_rw"
           class="form-control @error('pengantar_rt_rw') is-invalid @enderror"
           accept=".pdf,image/png,image/jpeg"
           required>

    @error('pengantar_rt_rw')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

    <small class="text-muted">
        Wajib diunggah sebagai syarat awal pengajuan Surat Domisili.
    </small>

    <small class="text-muted d-block mt-1">
        Dapat berupa hasil scan atau foto surat pengantar dari RT/RW
        (PDF/JPG/PNG, maks 4MB).
    </small>
</div>
<div class="mt-4">
    <button type="button" onclick="konfirmasiSubmit()" class="btn btn-success btn-lg w-100 btn-modern">
        <i class="bi bi-send-fill"></i> Kirim Sekarang
    </button>
</div>

</form>

</div>
</div>

</div>

<style>

/* CARD */
.form-card {
    border-radius: 20px;
    animation: fadeIn 0.5s ease-in-out;
}

/* BUTTON */
.btn-modern {
    border-radius: 30px;
    transition: 0.3s;
}
.btn-modern:hover {
    transform: scale(1.02);
}

/* ERROR */
.error {
    color: red;
    font-size: 12px;
}
#errorNik {
    font-size: 12px;
}

/* ANIMATION */
@keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}
.error {
    color: red;
    font-size: 12px;
    display: block;
    margin-top: 2px;
}
</style>

@endsection

@section('scripts')
<script>

// VALIDASI NIK
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
    const error = document.getElementById('errorNik');

    if (this.value.length > 0 && this.value.length < 16) {
        error.innerText = "NIK harus 16 digit!";
        error.style.color = "red";
    } else if (this.value.length == 16) {
        error.innerText = "✔ NIK valid";
        error.style.color = "green";
    } else {
        error.innerText = "";
    }
});

// FILE VALIDATION
// ===============================
// VALIDASI KTP
// ===============================
// ===============================
// VALIDASI KTP
// ===============================
// ===============================
// VALIDASI + AUTO COMPRESS KTP
// ===============================


// ===============================
// VALIDASI PENGANTAR RT/RW (TETAP)
// ===============================
const inputPengantar = document.querySelector('input[name="pengantar_rt_rw"]');

if (inputPengantar) {

    inputPengantar.addEventListener('change', function () {

        const file = this.files[0];
        if (!file) return;

        const maxSize = 5 * 1024 * 1024; // 5MB

        // ❌ CEK UKURAN HARUS DI SINI (SEBELUM APAPUN)
        if (file.size > maxSize) {

            this.value = '';

            Swal.fire(
                'File terlalu besar!',
                'Maksimal ukuran file 5MB',
                'error'
            );

            return; // ⛔ STOP DI SINI, JANGAN LANJUT KOMPRES
        }

        // PDF, JPG, PNG, WEBP
        const allowedTypes = [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            this.value = '';

            Swal.fire(
                'Error',
                'Hanya file PDF, JPG, PNG, atau WEBP',
                'error'
            );

            return;
        }

        // 🔥 PDF tidak dikompres
        if (file.type === 'application/pdf') {
            return;
        }

        // 🔥 Gambar dikompres (LANJUTAN KODE KAMU TETAP)

        // 🔥 Gambar dikompres
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

                ctx.drawImage(
                    img,
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );

                canvas.toBlob(function (blob) {

                    if (!blob) return;

                    const compressedFile = new File(
                        [blob],
                        file.name,
                        {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        }
                    );

                    const dt = new DataTransfer();
                    dt.items.add(compressedFile);

                    inputPengantar.files = dt.files;

                }, 'image/jpeg', 0.7);

            };

        };

        reader.readAsDataURL(file);

    });

}

    
// SUBMIT
function konfirmasiSubmit() {

    let valid = true;

    // VALIDASI REQUIRED FIELD
    document.querySelectorAll('#formDomisili [required]').forEach(function(input) {
        const error = input.parentElement.parentElement.querySelector('.error');

        if (!input.value) {
            valid = false;
            if (error) error.innerText = "Wajib diisi!";
        } else {
            if (error) error.innerText = "";
        }
    });

    // VALIDASI NIK
    const nik = document.getElementById('nik').value;
    if (nik.length !== 16) {
        valid = false;
        document.getElementById('errorNik').innerText = "NIK harus 16 digit!";
    }

    // 🔥 VALIDASI FILE SIZE (BIAR CEPAT & TIDAK ERROR PUTIH)
    const maxSize = 5 * 1024 * 1024; // 4MB

    const ktpInput = document.querySelector('input[name="upload_ktp"]');
const ktp = ktpInput ? ktpInput.files[0] : null;
    const pengantar = document.querySelector('input[name="pengantar_rt_rw"]').files[0];

    if (ktp && ktp.size > maxSize) {
        Swal.fire(
            'Upload Gagal',
            'Ukuran file KTP maksimal 10MB',
            'error'
        );
        return;
    }

    if (pengantar && pengantar.size > maxSize) {
        Swal.fire(
            'Upload Gagal',
            'Ukuran surat pengantar maksimal 10MB',
            'error'
        );
        return;
    }

    // JIKA ADA ERROR FORM
    if (!valid) {
        Swal.fire('Error','Isi semua data dengan benar','error');
        return;
    }

    // KONFIRMASI KIRIM
    Swal.fire({
        title: 'Kirim Data?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Cek Lagi'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formDomisili').submit();
        }
    });
}
</script>

@if(session('success'))
<script>
Swal.fire({
    title: 'Permohonan Berhasil',
text: 'Data telah berhasil dikirim. Silakan cek status surat Anda untuk melihat progres permohonan.',
    icon: 'success',
    showCancelButton: true,
    confirmButtonText: 'Cek Status',
    cancelButtonText: 'Tutup'
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = "/cek-status";
    }
});


</script>

@endif

@if(session('error'))
<script>
Swal.fire({
    title: 'Gagal!',
    text: '{{ session('error') }}',
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>

@endif
@if($errors->any())
<script>
Swal.fire({
    title: 'Upload Gagal!',
    html: `
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    `,
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>
@endif
@endsection