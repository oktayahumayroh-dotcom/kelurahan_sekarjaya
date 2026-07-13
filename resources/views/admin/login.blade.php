<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>

    body {
        min-height: 100vh;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #1f4037, #2c7744);
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 900px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        background: white;
        display: flex;
    }

    /* FORM */
    .login-form {
        flex: 1;
        padding: 50px 40px;
    }

    .login-form h3 {
        font-weight: 700;
        color: #2c7744;
        margin-bottom: 5px;
    }

    .login-form p {
        color: #777;
        font-size: 14px;
        margin-bottom: 30px;
    }

    /* INPUT */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #555;
    }

    .form-control {
        height: 50px;
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: #2c7744;
        box-shadow: 0 0 0 2px rgba(44,119,68,0.15);
    }

    /* INPUT GROUP ICON */
    .input-group-text {
        background: #f8f9fa;
        border-radius: 12px 0 0 12px;
        border-right: none;
    }

    .input-group .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }

    /* PASSWORD */
    .password-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 65%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
        font-size: 18px;
    }

    /* BUTTON */
    .btn-login {
        background: linear-gradient(135deg, #2c7744, #1f4037);
        border: none;
        height: 50px;
        border-radius: 12px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-1px);
        opacity: 0.95;
    }

    /* IMAGE */
    .login-image {
        flex: 1;
        background: url('{{ asset('images/gambar4.png') }}') center/cover no-repeat;
        position: relative;
    }

    .login-image::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(31,64,55,0.75), rgba(44,119,68,0.75));
    }

    .login-image-content {
        position: absolute;
        bottom: 40px;
        left: 30px;
        right: 30px;
        color: white;
        z-index: 2;
    }

    .login-image-content h5 {
        font-weight: 700;
    }

    .login-image-content p {
        font-size: 14px;
        opacity: 0.9;
    }

    /* ALERT */
    .alert {
        border-radius: 10px;
        font-size: 14px;
    }

    /* MOBILE */
    @media (max-width: 768px) {

        .login-card {
            flex-direction: column;
            max-width: 420px;
        }

        .login-image {
            display: none;
        }

        .login-form {
            padding: 35px 25px;
        }

        .login-form h3 {
            font-size: 22px;
        }
    }

    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- FORM -->
        <div class="login-form">

            <h3>Login Admin</h3>
            <p>Masuk untuk mengelola sistem pelayanan</p>

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle me-1"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/admin/login">
                @csrf

                <!-- USERNAME -->
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="mb-4 password-wrapper">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control pe-5" required>
                    <i class="bi bi-eye toggle-password" id="eye"></i>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>

            </form>

        </div>

        <!-- IMAGE -->
        <div class="login-image">
            <div class="login-image-content">
                <h5>Sistem Administrasi Kelurahan</h5>
                <p>Pelayanan lebih cepat, data lebih teratur</p>
            </div>
        </div>

    </div>

</div>

<script>
const password = document.getElementById('password');
const eye = document.getElementById('eye');

eye.addEventListener('click', () => {
    if (password.type === "password") {
        password.type = "text";
        eye.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        password.type = "password";
        eye.classList.replace("bi-eye-slash", "bi-eye");
    }
});
</script>

</body>
</html>