@extends('layouts.main')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card pengaduan-card">

                <div class="card-body p-4">

                    <!-- ICON -->
                    <div class="text-center mb-3 icon-box">
                        <i class="bi bi-search"></i>
                    </div>

                    <h4 class="fw-bold text-center mb-2">
                        Cek Status Pengaduan
                    </h4>

                    <p class="text-center text-muted mb-4">
                        Masukkan NIK untuk memantau proses pengaduan Anda
                    </p>

                    {{-- ERROR --}}
                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form id="formPengaduan" action="{{ route('pengaduan.cek.proses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person-vcard me-1"></i> NIK
                            </label>

                            <input type="text" 
                                   id="nik"
                                   name="nik" 
                                   class="form-control input-nik text-center"
                                   placeholder="Masukkan 16 digit NIK"
                                   maxlength="16"
                                   required>

                            <small id="errorNik" class="text-danger"></small>
                        </div>

                        <button type="submit" class="btn btn-cek w-100">
                            <i class="bi bi-search me-1"></i> Cek Status
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<style>

/* CARD */
.pengaduan-card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    animation: fadeInUp 0.6s ease;
    transition: 0.3s;
}

.pengaduan-card:hover {
    transform: translateY(-4px);
}

/* ICON */
.icon-box {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0d4d2c, #1b7a46);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    color: white;
    font-size: 22px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

/* INPUT */
.input-nik {
    border-radius: 10px;
    padding: 10px;
    transition: 0.3s;
    border: 1px solid #ddd;
}

.input-nik:focus {
    border-color: #d4a017;
    box-shadow: 0 0 0 3px rgba(212,160,23,0.2);
}

/* BUTTON */
.btn-cek {
    background: linear-gradient(135deg, #d4a017, #b88a12);
    color: #0d4d2c;
    font-weight: 600;
    padding: 10px;
    border-radius: 10px;
    border: none;
    transition: 0.3s;
}

.btn-cek:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

/* ANIMATION */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* RESPONSIVE */
@media (max-width: 576px) {
    .pengaduan-card {
        margin: 0 10px;
    }
}

</style>

@endsection

@section('scripts')
<script>

// 🔥 AUTO ANGKA + LIMIT
document.getElementById('nik').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');

    if (this.value.length > 16) {
        this.value = this.value.slice(0, 16);
    }

    const error = document.getElementById('errorNik');

    if (this.value.length > 0 && this.value.length < 16) {
        error.innerText = "NIK harus 16 digit";
    } else {
        error.innerText = "";
    }
});

// 🔥 VALIDASI SUBMIT + POPUP
document.getElementById('formPengaduan').addEventListener('submit', function(e) {
    const nik = document.getElementById('nik').value;

    if (nik.length !== 16) {
        e.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'NIK Tidak Valid',
            text: 'NIK harus terdiri dari 16 digit angka'
        });
    }
});

</script>
@endsection