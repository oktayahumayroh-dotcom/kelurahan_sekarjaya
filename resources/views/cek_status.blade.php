@extends('layouts.main')

@section('content')

<div class="cek-wrapper">

    <div class="card-cek">

        <div class="header-cek text-center">
            <h4>Cek Status Surat</h4>
            <p>Masukkan NIK untuk melihat status pengajuan surat Anda</p>
        </div>

        <form id="formCek" method="POST" action="/cek-status">
            @csrf

            <div class="form-group">
                <label>NIK</label>
                <input type="text" id="nik" name="nik"
                       class="form-control text-center"
                       placeholder="Contoh: 160xxxxxxxxxxxxx"
                       maxlength="16"
                       required>

                <small id="errorNik" class="text-danger"></small>
            </div>

            <button type="submit" class="btn-cek">
                <i class="bi bi-search"></i> Cek Status
            </button>

        </form>

    </div>

</div>

<style>

/* WRAPPER */
.cek-wrapper {
    min-height: 75vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* CARD */
.card-cek {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: 16px;
    padding: 30px 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid #eee;
}

/* HEADER */
.header-cek h4 {
    font-weight: 600;
    margin-bottom: 5px;
}

.header-cek p {
    font-size: 14px;
    color: #777;
    margin-bottom: 20px;
}

/* FORM */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
}

.form-control {
    border-radius: 10px;
    height: 45px;
    border: 1px solid #ddd;
    transition: 0.2s;
    font-size: 14px;
}

.form-control:focus {
    border-color: #0d4d2c;
    box-shadow: 0 0 0 2px rgba(13,77,44,0.1);
}

/* BUTTON */
.btn-cek {
    width: 100%;
    background: #d4a017;
    color: #0d4d2c;
    padding: 11px;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    font-size: 15px;
    transition: 0.3s;
}

.btn-cek:hover {
    background: #b88a12;
}

/* ERROR */
#errorNik {
    font-size: 12px;
}

/* RESPONSIVE */
@media (max-width: 576px) {

    .card-cek {
        padding: 25px 18px;
    }

    .header-cek h4 {
        font-size: 18px;
    }

    .header-cek p {
        font-size: 13px;
    }
}

</style>

@endsection


@section('scripts')
<script>

// hanya angka + max 16
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);

    const error = document.getElementById('errorNik');

    if (this.value.length > 0 && this.value.length < 16) {
        error.innerText = "NIK harus 16 digit";
    } else {
        error.innerText = "";
    }
});

// submit validation
document.getElementById('formCek').addEventListener('submit', function(e) {
    const nik = document.getElementById('nik').value;
    const error = document.getElementById('errorNik');

    if (nik.length !== 16) {
        e.preventDefault();
        error.innerText = "NIK harus 16 digit";

        Swal.fire({
            icon: 'error',
            title: 'NIK Tidak Valid',
            text: 'NIK harus terdiri dari 16 digit angka'
        });
    }
});

</script>
@endsection