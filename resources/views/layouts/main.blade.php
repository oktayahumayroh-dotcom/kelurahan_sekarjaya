<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelurahan Sekarjaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    padding: 0;
    background: #F4F7F5;
    padding-top: 85px; /* supaya konten tidak ketutup navbar */
}

/* ===== NAVBAR ===== */
.main-header {
     background: linear-gradient(135deg, #2F5D50, #3E7C6F);
    padding: 12px 0;
    transition: 0.3s ease;
    z-index: 1000;
}

/* Efek saat scroll */
.main-header.scrolled {
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    padding: 6px 0;
}

/* Logo */
.navbar-brand {
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    color: white !important;
}

/* HP */
.navbar-brand img {
    width: 50px;
    height: 50px;
}

/* DESKTOP */
@media (min-width: 992px) {
    .navbar-brand img {
        width: 75px;
        height: 75px;
    }
}

/* Nav link */
.navbar-nav .nav-link {
    color: white !important;
    font-weight: 500;
    margin-left: 20px;
    position: relative;
    transition: 0.3s;
}

/* 🔻 SEGITIGA MENU */
/* 🔻 SEGITIGA SELALU ADA */
/* LINK */
.navbar-nav .nav-link {
    position: relative;
    transition: 0.3s;
}

/* 🔻 SEGITIGA BESAR (DEFAULT SUDAH KELIHATAN) */
.navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -12px;
    transform: translateX(-50%);

    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 8px solid rgba(255,255,255,0.6); /* lebih jelas */

    transition: 0.3s ease;
}

/* ✨ HOVER */
.navbar-nav .nav-link:hover {
    color: #8FBF9F !important;
    transform: translateY(-2px);
}

.navbar-nav .nav-link:hover::after {
    border-top-color: #8FBF9F;
    bottom: -16px; /* turun dikit biar hidup */
}

/* 🔥 ACTIVE */
.navbar-nav .nav-link.active {
    color: #8FBF9F !important;
}

.navbar-nav .nav-link.active::after {
    border-top-color: #8FBF9F;
    bottom: -16px;
}
/* ===== DROPDOWN ===== */
.dropdown-menu {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    opacity: 0;
    transform: translateY(10px);
    transition: 0.3s ease;
    display: block;
    visibility: hidden;
}

/* Hover desktop */
@media (min-width: 992px) {
    .dropdown:hover .dropdown-menu {
        opacity: 1;
        transform: translateY(0);
        visibility: visible;
    }

    .dropdown:hover .dropdown-toggle::after {
        transform: rotate(180deg);
        transition: 0.3s;
    }
}

/* Mobile tetap klik */
@media (max-width: 991px) {
    .dropdown-menu {
        position: static;
        float: none;

        opacity: 1 !important;
        transform: none !important;
        visibility: visible !important;

        display: none; /* tetap hidden awal */
        box-shadow: none;
        border-radius: 0;
        background: rgba(255,255,255,0.95);
    }

    .dropdown.show .dropdown-menu {
        display: block !important;
    }
}

/* Dropdown item */
.dropdown-item {
    font-weight: 500;
    transition: 0.2s;
}

.dropdown-item:hover {
    background-color: #8FBF9F;
    color: #2F5D50;
}


/* Toggler */
.navbar-toggler {
    border: none;
}

.navbar-toggler:focus {
    box-shadow: none;
}

/* Content */
main {
    min-height: 85vh;
}

.footer-custom {
    background: linear-gradient(135deg, #1f4037, #2c7744);
    color: #fff;
    padding: 30px 15px;
    margin-top: 50px;

    /* 🔥 GARIS ATAS */
    border-top: 4px solid #8FBF9F;
}

/* Judul */
.footer-custom h5 {
    color: #f4c430;
}

/* Text */
.footer-custom p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
}

.footer-link {
    color: #ddd;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 5px;
    transition: 0.3s;
}

.footer-link:hover {
    color: #f4c430;
    padding-left: 5px;
}

.footer-line {
    border-color: rgba(255,255,255,0.2);
}

/* LOGO DEFAULT (HP) */
/* HP */
.navbar-brand img {
    width: 55px;
    height: 55px;
    object-fit: contain;
}

/* DESKTOP */
@media (min-width: 992px) {
    .navbar-brand img {
        width: 90px;   /* 🔥 ini baru kelihatan gede */
        height: 90px;
    }

    .navbar-brand {
        font-size: 24px;
        font-weight: 700;
        gap: 15px;
    }
}

/* DESKTOP */


@media (min-width: 992px) {
    .navbar-nav .nav-link {
        margin-left: 28px;
        font-size: 16px;
    }
}

@media (min-width: 992px) {
    .navbar {
        padding-left: 20px;
        padding-right: 20px;
    }
}

@media (min-width: 992px) {
    .dropdown-menu {
        right: 0 !important;
        left: auto !important;

        min-width: 240px;
        max-width: 280px;

        transform: translateY(10px);
    }

    .dropdown:hover .dropdown-menu {
        transform: translateY(0);
    }
}

.main-header {
    height: 100px; /* 🔥 kunci tinggi navbar */
    display: flex;
    align-items: center;
}


@media (max-width: 991px) {

    .dropdown-menu {
        opacity: 1 !important;
        visibility: visible !important;
        transform: none !important;

        background: #ffffff !important; /* 🔥 ini bikin tidak transparan */
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);

        display: none; /* default tetap hidden */
    }

    .dropdown.show .dropdown-menu {
        display: block !important;
    }
}

@media (max-width: 991px) {

    .navbar-collapse {
        background: #2F5D50; /* atau putih */
        padding: 15px 20px;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .navbar-nav .nav-link {
        margin-left: 0;
        padding: 10px 0;
        color: white !important;
    }
}
.mobile-float-nav {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);

    width: 92%;
    max-width: 420px;

    background: #0d632c; /* hijau modern */
    border-radius: 18px;

    display: flex;
    justify-content: space-around;
    padding: 10px 8px;

    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    z-index: 9999;

    backdrop-filter: blur(10px);
}

.mobile-float-nav .nav-item {
    text-align: center;
    color: #eaffea;
    text-decoration: none;
    font-size: 11px;
    flex: 1;
}

.mobile-float-nav .nav-item i {
    display: block;
    font-size: 20px;
    margin-bottom: 3px;
    color: #ffffff;
}

.mobile-float-nav .nav-item:hover {
    transform: translateY(-3px);
    transition: 0.2s;
    color: #ffffff;
}
@media (max-width: 991px) {

    .navbar-nav .nav-link,
    .navbar-nav .dropdown-toggle {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;

        width: 100%;
    }

    .navbar-nav .dropdown-toggle::after {
        margin-left: auto !important;
        position: static !important;
    }

    /* MATIKAN SEGITIGA BAWAH DI MOBILE */
    .navbar-nav .nav-link::after {
        display: none !important;
    }
}

@media (max-width: 991px) {

    .navbar-nav .dropdown-toggle::after {
        content: "\F282";
        font-family: "bootstrap-icons";

        border: none !important;

        margin-left: auto;
        font-size: 14px;
    }

    .navbar-nav .dropdown-toggle {
        display: flex;
        align-items: center;
    }

}
    #mobileMenu .nav-link{
    font-size: 11px;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg main-header fixed-top">
    <div class="container-fluid px-3"> <!-- 🔥 GANTI DI SINI -->

        <!-- LOGO -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/gambar2.png') }}" alt="Logo">
            Kelurahan Sekarjaya
        </a>

        <!-- TOGGLER -->
<button class="navbar-toggler bg-light d-lg-none"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileMenu">

    <span class="navbar-toggler-icon"></span>

</button>

        <!-- MENU -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#"
       role="button"
       data-bs-toggle="dropdown">
        Profil
    </a>

    <ul class="dropdown-menu">

        <li>
           <a class="dropdown-item" href="/sejarah">
    <i class="bi bi-building"></i> Sejarah Kelurahan
            </a>
        </li>

<li>
    <a class="dropdown-item" href="/visi-misi">
        <i class="bi bi-bullseye"></i> Visi & Misi
    </a>
</li>

<li>
    <a class="dropdown-item" href="/statistik">
        <i class="bi bi-bar-chart-line"></i> Statistik Kelurahan
    </a>
</li>
    </ul>
</li>
              <li class="nav-item">
    <a class="nav-link" href="/peta">Peta Wilayah</a>
</li>

                <li class="nav-item dropdown dropdown-end">
                    <a class="nav-link dropdown-toggle" href="#"
                       role="button"
                       data-bs-toggle="dropdown">
                        Layanan
                    </a>

                   <ul class="dropdown-menu">

    <!-- 🔹 LAYANAN SURAT -->
    <li class="dropdown-header">Layanan Surat</li>

    <li>
        <a class="dropdown-item" href="/pendaftaran">
            <i class="bi bi-file-earmark-text"></i> Surat Menyurat
        </a>
    </li>

    <li>
        <a class="dropdown-item" href="/cek-status">
            <i class="bi bi-search"></i> Cek Status Surat
        </a>
    </li>

    <li><hr class="dropdown-divider"></li>

    <!-- 🔹 PENGADUAN -->
    <li class="dropdown-header">Layanan Pengaduan</li>

    <li>
        <a class="dropdown-item" href="/pengaduan">
            <i class="bi bi-chat-dots"></i> Pengaduan Masyarakat
        </a>
    </li>

    <li>
        <a class="dropdown-item" href="/cek-status-pengaduan">
            <i class="bi bi-bar-chart-line"></i> Cek Status Pengaduan
        </a>
    </li>
                   </ul>


        </div>

    </div>
</nav>
<!-- MOBILE MENU -->
<div class="offcanvas offcanvas-end d-lg-none"
     tabindex="-1"
     id="mobileMenu"
     style="
        width: 75%;
        background: linear-gradient(135deg, #2F5D50, #3E7C6F);
        color:white;
     ">

    <!-- HEADER -->
    <div class="offcanvas-header border-bottom border-light border-opacity-25">

        <h5 class="offcanvas-title fw-bold mb-0">
            Menu
        </h5>

        <button type="button"
                class="btn-close btn-close-white"
                data-bs-dismiss="offcanvas">
        </button>

    </div>

    <!-- BODY -->
    <div class="offcanvas-body">

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/">
                    Beranda
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/sejarah">
                    Sejarah Kelurahan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/visi-misi">
                    Visi & Misi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/statistik">
                    Statistik Kelurahan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/peta">
                    Peta Wilayah
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/pendaftaran">
                    Surat Menyurat
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/cek-status">
                    Cek Status Surat
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3 border-bottom border-light border-opacity-10"
                   href="/pengaduan">
                    Pengaduan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white fw-semibold py-3"
                   href="/cek-status-pengaduan">
                    Cek Status Pengaduan
                </a>
            </li>

        </ul>

    </div>

</div>


<!-- CONTENT -->
<main>
    @yield('content')
</main>

<footer class="footer-custom">
    <div class="container">

        <div class="row text-center text-md-start">

            <!-- KOLOM 1 -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">Kelurahan Sekarjaya</h5>
                <p>
                    Kelurahan Sekarjaya berlokasi di Jl. Imam Bonjol, Kecamatan Baturaja Timur, 
                    Kabupaten Ogan Komering Ulu (OKU), Sumatera Selatan. Kelurahan ini 
                    merupakan bagian dari wilayah
                     administratif Kota Baturaja dan aktif melayani masyarakat setempat. 
                </p>
            </div>

            <!-- KOLOM 2 -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Menu</h6>
                <p><a href="/" class="footer-link">Beranda</a></p>
                <p><a href="/sejarah" class="footer-link">Profil</a></p>
                <p><a href="/peta" class="footer-link">Peta Wilayah</a></p>
            </div>

            <!-- KOLOM 3 -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Ikuti Kami</h6>

                <a href="https://www.instagram.com/kelurahan_sekarjaya/" target="_blank" class="footer-link">
                    <i class="bi bi-instagram"></i> kelurahan_sekarjaya
                </a>
            </div>

        </div>

        <hr class="footer-line">

        <p class="text-center small mb-0">
            © 2026 Kelurahan Sekarjaya
        </p>

    </div>

  @if(!request()->is('profil*', 'sejarah*', 'visi-misi*', 'peta*', 'statistik*'))
<div class="mobile-float-nav d-md-none">
    <a href="/pengaduan" class="nav-item">
        <i class="bi bi-chat-dots"></i>
        <span>Pengaduan</span>
    </a>

    <a href="/pendaftaran" class="nav-item">
        <i class="bi bi-file-earmark-plus"></i>
        <span>Surat</span>
    </a>

    <a href="/cek-status-pengaduan" class="nav-item">
        <i class="bi bi-search"></i>
        <span>Cek Pengaduan</span>
    </a>

    <a href="/cek-status" class="nav-item">
        <i class="bi bi-clipboard-check"></i>
        <span>Cek Surat</span>
    </a>
</div>
@endif
</footer>

<!-- Bootstrap JS -->


<script>
// Navbar shadow saat scroll
window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".main-header");
    navbar.classList.toggle("scrolled", window.scrollY > 20);
});
</script>

<!-- 🔥 TAMBAH INI -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- 🔥 WAJIB AGAR SCRIPT PER HALAMAN JALAN -->
@yield('scripts')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".main-header");
    navbar.classList.toggle("scrolled", window.scrollY > 20);
});
</script>

<!-- 🔥 TAMBAH DI SINI -->


</body>
</html>