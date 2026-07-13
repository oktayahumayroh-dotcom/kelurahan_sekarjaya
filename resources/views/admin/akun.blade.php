@extends('admin.layout')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold text-success">
            <i class="bi bi-gear"></i> Pengaturan Akun
        </h4>
        <p class="text-muted mb-0">Kelola username dan password admin</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow rounded-4 border-0">

                <div class="card-header text-white text-center rounded-top-4"
                     style="background: linear-gradient(135deg, #2F5D50, #3E7C6F);">
                    <h5 class="mb-0"><i class="bi bi-person"></i> Profil Admin</h5>
                </div>

                <div class="card-body p-4">

                    <form id="formAkun" method="POST" action="{{ route('admin.akun.update') }}">
                        @csrf

                        <!-- USERNAME -->
                        <div class="mb-3">
                            <label class="fw-semibold">Username</label>
                            <input type="text" name="username"
                                   value="{{ old('username', $admin->username) }}"
                                   class="form-control custom-input" required>
                        </div>

                        <!-- PASSWORD LAMA -->
                        <div class="mb-3">
                            <label class="fw-semibold">Password Lama</label>
                            <input type="password" name="old_password"
                                   id="old_password"
                                   class="form-control custom-input">
                            <small class="text-danger d-none" id="errOld">
                                Password lama wajib diisi jika ingin mengganti password
                            </small>
                        </div>

                        <!-- PASSWORD BARU -->
                        <div class="mb-3">
                            <label class="fw-semibold">Password Baru</label>
                            <input type="password" name="password"
                                   id="password"
                                   class="form-control custom-input">
                            <small class="text-danger d-none" id="errPassword">
                                Minimal 6 karakter
                            </small>
                        </div>

                        <!-- KONFIRMASI -->
                        <div class="mb-3">
                            <label class="fw-semibold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                   id="confirm"
                                   class="form-control custom-input">
                            <small class="text-danger d-none" id="errConfirm">
                                Password tidak cocok
                            </small>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-success"
                                    onclick="openModal()">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="modalConfirm" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3">

      <div class="modal-header">
        <h5 class="modal-title">
            <i class="bi bi-exclamation-circle"></i> Konfirmasi
        </h5>
      </div>

      <div class="modal-body">
        Simpan perubahan akun?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-success" onclick="submitForm()">Ya, Simpan</button>
      </div>

    </div>
  </div>
</div>

<style>
.custom-input {
    border-radius: 10px;
    transition: 0.2s;
}
.custom-input:focus {
    border-color: #2F5D50;
    box-shadow: 0 0 0 0.2rem rgba(47,93,80,.2);
}
.is-invalid {
    border-color: red !important;
}
</style>

<script>
function openModal() {

    let oldPass = document.getElementById('old_password');
    let password = document.getElementById('password');
    let confirm  = document.getElementById('confirm');

    let errOld = document.getElementById('errOld');
    let errPass = document.getElementById('errPassword');
    let errConf = document.getElementById('errConfirm');

    let valid = true;

    // RESET
    [oldPass, password, confirm].forEach(el => el.classList.remove('is-invalid'));
    [errOld, errPass, errConf].forEach(el => el.classList.add('d-none'));

    // kalau isi password baru → wajib isi password lama
    if(password.value !== "" && oldPass.value === ""){
        oldPass.classList.add('is-invalid');
        errOld.classList.remove('d-none');
        valid = false;
    }

    // password minimal 6
    if(password.value !== "" && password.value.length < 6){
        password.classList.add('is-invalid');
        errPass.classList.remove('d-none');
        valid = false;
    }

    // konfirmasi
    if(password.value !== confirm.value){
        confirm.classList.add('is-invalid');
        errConf.classList.remove('d-none');
        valid = false;
    }

    if(!valid) return;

    let modal = new bootstrap.Modal(document.getElementById('modalConfirm'));
    modal.show();
}

function submitForm(){
    document.getElementById('formAkun').submit();
}
</script>

@endsection