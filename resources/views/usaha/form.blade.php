@extends('layouts.main')

@section('content')

<div class="container py-5">

    <h2 class="text-center mb-4 fw-bold">Form Surat Keterangan Usaha</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form id="formUsaha" action="{{ route('usaha.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            <!-- NIK -->
            <div class="col-md-6">
                <label>NIK <span class="text-danger">*</span></label>
                <input type="text" id="nik" name="nik" class="form-control" maxlength="16" required>
                <small class="text-muted">Harap diisi 16 digit</small><br>
                <small class="text-danger" id="errorNik"></small>
            </div>

            <!-- Nama -->
            <div class="col-md-6">
                <label>Nama <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" required>
                <small class="text-danger error"></small>
            </div>

            <!-- TEMPAT LAHIR -->
            <div class="col-md-6">
                <label>Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control" required>
                <small class="text-danger error"></small>
            </div>

            <!-- TANGGAL LAHIR -->
            <div class="col-md-6">
                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
                <small class="text-danger error"></small>
            </div>

            <!-- Jenis Kelamin -->
            <div class="col-md-6">
                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <small class="text-danger error"></small>
            </div>

            <!-- Agama -->
            <div class="col-md-6">
                <label>Agama <span class="text-danger">*</span></label>
                <select name="agama" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option>Islam</option>
                    <option>Kristen</option>
                    <option>Katolik</option>
                    <option>Hindu</option>
                    <option>Buddha</option>
                    <option>Konghucu</option>
                </select>
                <small class="text-danger error"></small>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <label>Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option>Belum Menikah</option>
                    <option>Menikah</option>
                </select>
                <small class="text-danger error"></small>
            </div>

            <!-- Kewarganegaraan -->
            <div class="col-md-6">
                <label>Kewarganegaraan <span class="text-danger">*</span></label>
                <select name="kewarganegaraan" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option>WNI</option>
                    <option>WNA</option>
                </select>
                <small class="text-danger error"></small>
            </div>

            <!-- Pekerjaan -->
            <div class="col-md-6">
                <label>Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" name="pekerjaan" class="form-control" required>
                <small class="text-danger error"></small>
            </div>

            <!-- Alamat -->
            <div class="col-12">
                <label>Alamat Domisili <span class="text-danger">*</span></label>
<textarea name="alamat" class="form-control" rows="3" required></textarea>

<small class="text-muted">
Tuliskan alamat lengkap sesuai domisili saat ini.
</small>

<small class="text-muted d-block">
Pastikan berada dalam wilayah Kelurahan Sekarjaya.
</small>

<small class="text-danger error"></small>
            </div>

            <!-- USAHA -->
            <div class="col-md-6">
                <label>Jenis Usaha <span class="text-danger">*</span></label>
                <input type="text" name="jenis_usaha" class="form-control" required>
                <small class="text-danger error"></small>
            </div>

            <div class="col-md-6">
                <label>Tempat Usaha <span class="text-danger">*</span></label>
                <input type="text" name="tempat_usaha" class="form-control" required>
                <small class="text-danger error"></small>
            </div>
            <div class="col-md-6">
    <label>No WhatsApp <span class="text-danger">*</span></label>
    <input type="text" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
    <small class="text-muted">Nomor untuk notifikasi surat selesai</small>
    <small class="text-danger error"></small>
</div>

        <!-- Upload -->
<div class="col-md-6">
    <label class="fw-semibold">Upload Surat Pengantar RT/RW <span class="text-danger">*</span></label>

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

        <div class="text-center mt-4">
            <button type="button" onclick="konfirmasiSubmit()" class="btn-keren">
                Kirim Permohonan
            </button>
        </div>

    </form>

</div>

<style>

label .text-danger {
    color: #dc3545 !important;
    font-weight: bold;
}

.form-control {
    border-radius: 10px;
    padding: 10px;
    transition: 0.2s;
}

.form-control:focus {
    border-color: #1b7a46;
    box-shadow: 0 0 0 0.15rem rgba(27,122,70,0.2);
}

.error {
    font-size: 13px;
}

.btn-keren {
    background: linear-gradient(135deg, #0d4d2c, #1b7a46);
    color: white;
    padding: 12px 35px;
    border-radius: 30px;
    border: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-keren:hover {
    transform: translateY(-2px);
}

@media (max-width: 576px) {
    .btn-keren {
        width: 100%;
    }
}

.shake {
    animation: shake 0.3s;
}

@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-4px); }
    50% { transform: translateX(4px); }
    75% { transform: translateX(-4px); }
    100% { transform: translateX(0); }
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
        error.innerText = "NIK harus terdiri dari 16 digit.";
        error.style.color = "red";
    } else if (this.value.length == 16) {
        error.innerText = "NIK valid";
        error.style.color = "green";
    } else {
        error.innerText = "";
    }
});
const inputKtp = document.querySelector('input[name="upload_ktp"]');

if (inputKtp) {
    inputKtp.addEventListener('change', function () {

        const file = this.files[0];
        if (!file) return;

        const maxSize = 5 * 1024 * 1024; // 5MB

        // ❌ CEK UKURAN DULU (SEBELUM KOMPRES)
        if (file.size > maxSize) {
            this.value = '';

            Swal.fire({
                icon: 'error',
                title: 'File terlalu besar!',
                text: 'Maksimal 5MB'
            });

            return;
        }

        // ❌ CEK FORMAT
        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
            'application/pdf'
        ];

        if (!allowedTypes.includes(file.type)) {
            this.value = '';

            Swal.fire({
                icon: 'error',
                title: 'Format tidak valid',
                text: 'Hanya JPG, PNG, WEBP, atau PDF'
            });

            return;
        }

        // PDF skip kompres
        if (file.type === 'application/pdf') return;

        // KOMPRES GAMBAR
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

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'File dikompres & siap upload',
                        timer: 1200,
                        showConfirmButton: false
                    });

                }, 'image/jpeg', 0.7);

            };

        };

        reader.readAsDataURL(file);
    });
}
function konfirmasiSubmit() {

    let valid = true;

    document.querySelectorAll('#formUsaha [required]').forEach(function(input) {
        const error = input.parentElement.querySelector('.error');

        if (!input.value) {
            valid = false;
            input.classList.add('shake');
            setTimeout(() => input.classList.remove('shake'), 300);
            if (error) error.innerText = "Field ini wajib diisi.";
        } else {
            if (error) error.innerText = "";
        }
    });

    const nik = document.getElementById('nik').value;
    if (nik.length !== 16) {
        valid = false;
        document.getElementById('errorNik').innerText = "NIK harus terdiri dari 16 digit.";
    }

    if (!valid) {
        Swal.fire({
            icon: 'error',
            title: 'Data belum lengkap',
            text: 'Silakan lengkapi seluruh data terlebih dahulu.'
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Pengiriman',
        text: 'Silakan periksa kembali data yang telah Anda isi.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d4d2c',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Kirim Permohonan',
        cancelButtonText: 'Periksa Kembali'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formUsaha').submit();
        }
    });
}

</script>

@if(session('success'))
<script>
Swal.fire({
    title: 'Permohonan Berhasil',
    text: 'Data telah berhasil dikirim. Silakan cek status surat Anda untuk melihat perkembangan.',
    icon: 'success',
    confirmButtonColor: '#1b7a46',
    confirmButtonText: 'Cek Status',
    allowOutsideClick: false
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