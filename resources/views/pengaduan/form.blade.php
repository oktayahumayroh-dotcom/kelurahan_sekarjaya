@extends('layouts.main')

@section('content')
<div class="container py-5">

    <div class="card shadow-lg border-0">
        <div class="card-body p-4 p-md-5">

            <h3 class="text-center fw-bold mb-4">Form Pengaduan Masyarakat</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- NIK -->
            <div class="row g-3">

    <!-- NIK -->
    <div class="col-md-6">
        <label class="form-label">NIK <span class="text-danger">*</span></label>
        <input type="text" name="nik" id="nik"
            class="form-control"
            value="{{ old('nik') }}"
            maxlength="16"
            pattern="[0-9]{16}"
            required>
        <div class="invalid-feedback">NIK wajib 16 digit angka.</div>
    </div>

    <!-- Nama -->
    <div class="col-md-6">
        <label class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" name="nama" id="nama"
            class="form-control"
            value="{{ old('nama') }}"
            required>
        <div class="invalid-feedback">Nama wajib diisi.</div>
    </div>

    <!-- Telepon -->
    <div class="col-md-6">
        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
        <input type="tel" name="telepon" id="telepon"
            class="form-control"
            value="{{ old('telepon') }}"
            pattern="[0-9]+"
            required>
        <div class="invalid-feedback">Nomor telepon harus angka.</div>
    </div>

    <!-- Jenis -->
    <div class="col-md-6">
        <label class="form-label">Jenis Pengaduan <span class="text-danger">*</span></label>
        <select name="jenis_pengaduan" id="jenis_pengaduan"
            class="form-select"
            required onchange="toggleLainnya(this)">
            <option value="">-- Pilih --</option>
            <option value="kebersihan">Kebersihan Lingkungan</option>
            <option value="jalan">Jalan Rusak</option>
            <option value="lampu">Lampu Jalan Mati</option>
            <option value="drainase">Drainase Tersumbat</option>
            <option value="keamanan">Gangguan Keamanan</option>
            <option value="sampah">Penumpukan Sampah</option>
            <option value="lainnya">Lainnya</option>
        </select>
        <div class="invalid-feedback">Pilih jenis pengaduan.</div>
    </div>

    <!-- Lainnya -->
    <div class="col-12" id="lainnyaDiv" style="display:none;">
        <label class="form-label">Pengaduan Lainnya <span class="text-danger">*</span></label>
        <input type="text" name="lainnya" id="lainnya" class="form-control">
    </div>

    <!-- Alamat -->
    <div class="col-12">
        <label class="form-label">Lokasi / Alamat <span class="text-danger">*</span></label>
        <input type="text" name="alamat" id="alamat"
            class="form-control"
            value="{{ old('alamat') }}"
            required>
        <div class="invalid-feedback">Alamat wajib diisi.</div>
    </div>

    <!-- RT -->
    <div class="col-md-6">
        <label class="form-label">
            RT <span class="text-danger">*</span>
            <small class="text-muted">(contoh: 01)</small>
        </label>
        <input type="number" name="rt" id="rt"
            class="form-control"
            value="{{ old('rt') }}"
            min="1"
            required>
        <div class="invalid-feedback">RT Wajib Diisi.</div>
    </div>

    <!-- RW -->
    <div class="col-md-6">
        <label class="form-label">
            RW <span class="text-danger">*</span>
            <small class="text-muted">(contoh: 02)</small>
        </label>
        <input type="number" name="rw" id="rw"
            class="form-control"
            value="{{ old('rw') }}"
            min="1"
            required>
        <div class="invalid-feedback">RW wajib diisi.</div>
    </div>

    <!-- Keterangan -->
    <div class="col-12">
        <label class="form-label">Detail Pengaduan <span class="text-danger">*</span></label>
        <textarea name="keterangan" id="keterangan"
            class="form-control"
            rows="4"
            required>{{ old('keterangan') }}</textarea>
        <div class="invalid-feedback">Detail wajib diisi.</div>
    </div>

    <!-- Foto -->
    <div class="col-12">
        <label class="form-label">Foto Pendukung</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
    </div>

</div>

                <!-- BUTTON -->
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold">
                        Kirim Pengaduan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>

// FILTER NIK: hanya angka + max 16
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);
});

// TOGGLE LAINNYA
function toggleLainnya(select) {
    const div = document.getElementById('lainnyaDiv');
    const input = document.getElementById('lainnya');

    if(select.value === 'lainnya') {
        div.style.display = 'block';
        input.required = true;
    } else {
        div.style.display = 'none';
        input.required = false;
        input.value = '';
    }
}

// VALIDASI BOOTSTRAP

</script>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// 🔥 POPUP SETELAH BERHASIL KIRIM
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Pengaduan Berhasil!',
        text: 'Pengaduan berhasil dikirim. Silakan cek status pengaduan Anda.',
        confirmButtonColor: '#198754',
        confirmButtonText: 'Cek Status'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/cek-status-pengaduan";
        }
    });
@endif

// FILTER NIK: hanya angka + max 16
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);
});

// TOGGLE LAINNYA
function toggleLainnya(select) {
    const div = document.getElementById('lainnyaDiv');
    const input = document.getElementById('lainnya');

    if(select.value === 'lainnya') {
        div.style.display = 'block';
        input.required = true;
    } else {
        div.style.display = 'none';
        input.required = false;
        input.value = '';
    }
}

// VALIDASI BOOTSTRAP + VALIDASI NIK
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {

            const nik = document.getElementById('nik').value;

            if (nik.length !== 16) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'NIK Tidak Valid',
                    text: 'NIK harus 16 digit angka!',
                });
                return;
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})();
// NOTE: paksa hanya angka (extra safety)
document.querySelectorAll('input[name="rt"], input[name="rw"]').forEach(el => {
    el.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

// realtime merah/hijau
document.querySelectorAll('input, select, textarea').forEach(el => {
    el.addEventListener('input', function () {
        if (this.checkValidity()) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }
    });
});

// khusus select
document.getElementById('jenis_pengaduan').addEventListener('change', function () {
    if (this.value === '') {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
    }
});


const inputFoto = document.querySelector('input[name="foto"]');

if (inputFoto) {

    inputFoto.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        // VALIDASI FORMAT
        if (!allowedTypes.includes(file.type)) {

            Swal.fire(
                'Error',
                'Format harus JPG, PNG, atau WEBP',
                'error'
            );

            this.value = '';
            return;
        }

        // VALIDASI MAX 10MB
        if (file.size > 10 * 1024 * 1024) {

            Swal.fire(
                'Error',
                'Ukuran foto maksimal 10MB',
                'error'
            );

            this.value = '';
            return;
        }

        // =========================
        // AUTO COMPRESS
        // =========================

        const reader = new FileReader();

        reader.onload = function (e) {

            const img = new Image();

            img.src = e.target.result;

            img.onload = function () {

                const canvas = document.createElement('canvas');

                const ctx = canvas.getContext('2d');

                // resize aman untuk HP
                const maxWidth = 800;

                const scale = maxWidth / img.width;

                canvas.width = maxWidth;

                canvas.height = img.height * scale;

                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                // compress pertama
                canvas.toBlob(function (blob) {

                    if (!blob) return;

                    // kalau masih besar compress lagi
                    if (blob.size > 900 * 1024) {

                        canvas.toBlob(function (blob2) {

                            setCompressedFile(blob2);

                        }, 'image/jpeg', 0.5);

                    } else {

                        setCompressedFile(blob);

                    }

                }, 'image/jpeg', 0.7);
            };
        };

        reader.readAsDataURL(file);

        // SET FILE BARU
        function setCompressedFile(blob) {

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

            inputFoto.files = dt.files;
        }

    });

}

   
// auto angka NIK
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);
});

// auto angka RT RW
document.querySelectorAll('#rt, #rw').forEach(el => {
    el.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // format 01
    el.addEventListener('blur', function() {
        if (this.value.length === 1) {
            this.value = '0' + this.value;
        }
    });
});


</script>

@endsection