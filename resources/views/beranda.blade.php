@extends('layouts.main')

@section('content')

<!-- ================= HERO FULL SCREEN ================= -->
<!-- ================= HERO FULL SCREEN ================= -->
<section class="hero-section">
    <div class="hero-overlay"></div>

    <div class="container hero-content text-white">
        <div class="row align-items-center">
            <div class="col-md-7 text-start">
<h1 class="fw-bold hero-title">
    <span class="garis-selamat">Selamat</span> Datang
</h1>

<div class="subtitle-box">
    <p class="hero-subtitle mb-0">
        <span class="text-utama">Sistem Informasi Pelayanan Publik</span><br>
        Kelurahan Sekarjaya yang memudahkan masyarakat<br>
        dalam mengurus berbagai kebutuhan administrasi secara cepat dan praktis.
    </p>
</div>
<a href="#layanan" class="btn btn-warning btn-lg px-5 py-3 hero-btn mt-4 d-none d-md-inline-block">
    Lihat Layanan Kami
</a>

            </div>
        </div>
    </div>
</section>

<div class="menu-hp d-lg-none">

    <div class="judul-menu-hp">
    <span>Layanan Kelurahan</span>
</div>

    <div class="menu-grid">

        <a href="/" class="menu-item">
            <i class="bi bi-house-door"></i>
            <p>Beranda</p>
        </a>

        <a href="/sejarah" class="menu-item">
            <i class="bi bi-person"></i>
            <p>Profil</p>
        </a>

        <a href="/peta" class="menu-item">
            <i class="bi bi-map"></i>
            <p>Peta</p>
        </a>

      <a href="#jam-layanan" class="menu-item">
    <i class="bi bi-clock"></i>
    <p>Jam Layanan</p>
</a>

        <a href="/pendaftaran" class="menu-item">
            <i class="bi bi-file-earmark-plus"></i>
            <p>Pengajuan Surat</p>
        </a>

        <a href="/pengaduan" class="menu-item">
            <i class="bi bi-chat-dots"></i>
            <p>Pengaduan</p>
        </a>

        <a href="/cek-status" class="menu-item">
            <i class="bi bi-search"></i>
            <p>Cek Status Surat</p>
        </a>

        <a href="/cek-status-pengaduan" class="menu-item">
            <i class="bi bi-check-circle"></i>
            <p>Cek Pengaduan</p>
        </a>
<a href="#berita" class="menu-item">
    <i class="bi bi-newspaper"></i>
    <p>Berita</p>
</a>

    </div>
</div>
</section>



<!-- ================= LAYANAN KAMI ================= -->
<section id="layanan" class="layanan-section bg-light py-5">
    <div class="container text-center">

        <h2 class="fw-bold mb-2">LAYANAN KELURAHAN</h2>
        <p class="text-muted mb-5">
            Berbagai layanan administrasi dan informasi Kelurahan Sekarjaya yang dapat Anda akses dengan mudah
        </p>

        <div class="row g-4">

            <!-- Surat Menyurat -->
            <div class="col-md-3 col-sm-6">
                <div class="layanan-card">
                    <div class="icon-circle">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5 class="fw-bold mt-3">Surat Menyurat</h5>
                    <p class="small">
                        Pembuatan surat keterangan, surat pengantar dan dokumen resmi lainnya
                    </p>
                    <a href="/pendaftaran" class="layanan-link">Lihat Layanan →</a>
                </div>
            </div>

            <!-- Data Penduduk -->
            <div class="col-md-3 col-sm-6">
                <div class="layanan-card">
                    <div class="icon-circle">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="fw-bold mt-3">Statis Kelurahan </h5>
                    <p class="small">
    Ringkasan statistik kelurahan: penduduk, RT, RW, dan pengajuan surat
                    </p>
                    <a href="/statistik" class="layanan-link">Lihat Data →</a>
                </div>
            </div>

            <!-- Berita Desa -->
            <div class="col-md-3 col-sm-6">
                <div class="layanan-card">
                    <div class="icon-circle">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <h5 class="fw-bold mt-3">Profile</h5>
                    <p class="small">
                       Profil, Sejarah, dan Visi Misi Kelurahan Sekarjaya
                        
                    </p>
                    <a href="/sejarah" class="layanan-link">Lihat Profile →</a>
                </div>
            </div>

            <!-- Pengaduan -->
            <div class="col-md-3 col-sm-6">
                <div class="layanan-card">
                    <div class="icon-circle">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h5 class="fw-bold mt-3">Pengaduan</h5>
                    <p class="small">
                       Layanan pelaporan berbagai permasalahan di lingkungan kelurahan
                    </p>
                   <a href="/pengaduan" class="layanan-link">Hubungi Kami →</a>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- ================= STATISTIK KELURAHAN ================= -->
<!-- ================= STATISTIK KELURAHAN ================= -->
<section class="py-5 statistik-section">

    <div class="container">

        <div class="statistik-box">
            <div class="row align-items-center">

                <!-- KIRI : DATA -->
                <div class="col-md-7">
                    <h3 class="fw-bold mb-4">Statistik Kelurahan Sekarjaya</h3>

                    <div class="row g-3">

                       <div class="col-6">
    <div class="mini-stat">
<h2>{{ number_format((int) str_replace('.', '', $penduduk->value ?? 0), 0, ',', '.') }}</h2>
        <p>Jumlah Penduduk</p>
    </div>
</div>

<div class="col-6">
    <div class="mini-stat">
        <h2>{{ $rt->value ?? 0 }}</h2>
        <p>Jumlah RT</p>
    </div>
</div>

<div class="col-6">
    <div class="mini-stat">
        <h2>{{ $rw->value ?? 0 }}</h2>
        <p>Jumlah RW</p>
    </div>
</div>

<div class="col-6">
    <div class="mini-stat">
        <h2>{{ $suratMasuk ?? 0 }}</h2>
        <p>Total Pengajuan Surat</p>
    </div>
</div>

                    </div>
                </div>

               <!-- KANAN : ICON STATISTIK -->
<div class="col-md-5 text-center">
    <div class="stat-illustration">
        <i class="bi bi-pie-chart-fill big-icon"></i>
        <h5 class="fw-bold mt-3">Statistik & Data Kelurahan</h5>
        <p class="text-muted small">
            Penyajian data jumlah penduduk, RT, RW, 
            dan pengajuan surat secara ringkas.
        </p>
    </div>
</div>

                </div>

            </div>
        </div>

    </div>
</section>


<!-- ================= JAM LAYANAN ================= -->
<!-- ================= JAM LAYANAN ================= -->
<section id="jam-layanan" class="jam-section py-5">
    <div class="container px-3">

        <!-- TITLE -->
<div class="jam-header text-center mb-5">
    <h2 class="jam-title"><span>Jam Layanan Kantor</span></h2>
</div>


        <div class="row g-3 justify-content-center">

            <div class="col-6 col-md-3">
                <div class="jam-card">
                    <i class="bi bi-calendar-day"></i>
                    <p>Senin - Kamis</p>
                    <span>08.00 – 15.00</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="jam-card">
                    <i class="bi bi-calendar-week"></i>
                    <p>Jumat</p>
                    <span>08.00 – 15.00</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="jam-card tutup">
                    <i class="bi bi-x-circle"></i>
                    <p>Sabtu</p>
                    <span>Tutup</span>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="jam-card tutup">
                    <i class="bi bi-x-circle"></i>
                    <p>Minggu</p>
                    <span>Tutup</span>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- ================= KATA SAMBUTAN ================= -->
<section class="py-5 sambutan-section">
    <div class="container">

        <div class="sambutan-box">
            <div class="row align-items-center">

                <!-- FOTO LURAH -->
               <div class="col-md-4 text-center">
   <div class="foto-wrapper">
    <div class="foto-animasi">
        <img src="{{ asset('images/gambar5.png') }}" 
             alt="Foto Lurah"
             class="foto-sambutan">
    </div>
</div>


    <h5 class="nama-lurah mt-3">Arnando Yugantara, S.STP., M.Si</h5>
    <p class="jabatan-lurah">Lurah Sekarjaya</p>
</div>


                <!-- TEKS SAMBUTAN -->
                <div class="col-md-8">
                    <h3 class="fw-bold mb-4">Kata Sambutan Lurah</h3>

                    <p>
                        <strong>Assalamu’alaikum Warahmatullahi Wabarakatuh,</strong>
                    </p>

                    <p>
                        Dengan hadirnya website resmi kelurahan ini, kami berharap pelayanan kepada masyarakat 
                        dapat berjalan lebih cepat, transparan, dan mudah diakses. Website ini menjadi sarana 
                        informasi dan pelayanan administrasi berbasis digital untuk memudahkan warga dalam 
                        mengurus berbagai keperluan.
                    </p>

                    <p>
                        Kami mengucapkan terima kasih atas dukungan masyarakat. Semoga website ini 
                        memberikan manfaat bagi kita semua.
                    </p>

                    <p>
                        <strong>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</strong><br>
                        <strong>Arnando Yugantara, S.STP., M.Si</strong>
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- ================= BERITA ================= -->
<section class="berita-section py-5">
    <div class="container" id="berita">

        <!-- JUDUL -->
        <div class="berita-header text-center mb-4">
    <div class="header-line">
        <span>Berita Terbaru</span>
    </div>
    <p class="text-muted mt-2">
        Informasi terbaru Kelurahan Sekarjaya
    </p>
</div>

        <!-- WRAPPER SLIDER -->
        <div class="berita-wrapper position-relative">

            <!-- TOMBOL KIRI -->
            <button class="btn-slide left" onclick="scrollBerita(-1)">
                <i class="bi bi-chevron-left"></i>
            </button>

            <!-- LIST -->
            <div class="berita-scroll" id="beritaScroll">

                @foreach($berita as $item)
                <div class="berita-item">

                    <div class="berita-card">

                        <div class="berita-img">
                         <img src="{{ asset($item->gambar) }}">
                        </div>

                        <div class="berita-body">
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d M Y') }}
                            </small>

                            <h6 class="fw-bold mt-2">
                                {{ $item->judul }}
                            </h6>

                            <p>
                                {{ Str::limit($item->isi, 60) }}
                            </p>

                            <a href="/berita/{{ $item->slug }}" class="berita-link">
                                Baca →
                            </a>
                        </div>

                    </div>

                </div>
                @endforeach

            </div>

            <!-- TOMBOL KANAN -->
            <button class="btn-slide right" onclick="scrollBerita(1)">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

    </div>
</section>





<style>

@media (min-width: 992px) {
    section {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
}

/* ================= HERO ================= */
.hero-section {
    position: relative;
    background-image: url('{{ asset('images/gambar4.png') }}');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    align-items: center;
}

.hero-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(0,0,0,0.65),
        rgba(0,0,0,0.4)
    );
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 72px;
    line-height: 1.2;
    letter-spacing: 1px;

    position: relative;
    display: inline-block;
}


.garis-selamat {
    position: relative;
    display: inline-block;
}

.garis-selamat::after {
    content: "";
    width: 100%;
    height: 4px;
    background: #FFC107;
    display: block;
    margin-top: 6px;
    border-radius: 10px;
}
.hero-subtitle {
    font-size: 24px;
    opacity: 0.95;

    position: relative;
    display: inline-block;
}


.subtitle-box {
    position: relative;
    display: inline-block;
    padding: 15px 20px;
    margin-top: 10px;
}

/* garis animasi */
.subtitle-box::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 12px;

    background: linear-gradient(
        90deg,
        transparent,
        #FFC107,
        transparent
    );

    background-size: 300% 100%;
    animation: jalan 3s linear infinite;

    z-index: 0;
    padding: 2px;
    -webkit-mask: 
        linear-gradient(#000 0 0) content-box, 
        linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
            mask-composite: exclude;
}

/* isi text */
.subtitle-box p {
    position: relative;
    z-index: 1;
    margin: 0;
}

/* animasi jalan */
@keyframes jalan {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}
/* 🔥 TEXT UTAMA (BIAR MENONJOL) */
.text-utama {
      font-family: 'Pacifico', cursive; /* font baru */
    font-size: 26px;
    font-weight: 700;
    font-size: 26px;
    color: #FFC107;
    letter-spacing: 0.5px;
}

/* 🔥 RESPONSIVE BIAR GAK KEGEDEAN DI HP */
@media (max-width: 768px) {
    .text-utama {
        font-size: 18px;
    }

    .hero-subtitle {
        font-size: 14px;
    }
}

.hero-btn {
    font-weight: 600;
    border-radius: 40px;
    transition: transform 0.3s ease;
}

.hero-btn:hover {
    transform: translateY(-4px);
}

@media (max-width: 768px) {
    .hero-section {
        height: 60vh; /* 🔥 diperkecil biar gak nutup menu */
        text-align: center;
    }

    .hero-title {
        font-size: 42px !important;
    }

    .hero-subtitle {
        font-size: 18px !important;
    }

    .hero-btn {
        padding: 12px 25px !important;
        font-size: 16px;
    }
}

/* ================= LAYANAN FINAL FIX ================= */

.layanan-card {
    background: linear-gradient(135deg, #2F5D50, #3E7C6F);
    color: #fff;
    padding: 35px 25px;
    border-radius: 20px;
    text-align: center;
    height: 100%;
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    cursor: pointer;
}

/* Hover utama (naik + zoom halus) */
.layanan-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
}

/* Icon */
.icon-circle {
    width: 75px;
    height: 75px;
    background-color: #f4c430;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    font-size: 30px;
    color: #2F5D50;
    transition: transform 0.35s ease;
}

/* Icon ikut gerak */
.layanan-card:hover .icon-circle {
    transform: scale(1.15);
}

/* Link */
.layanan-link {
    display: inline-block;
    margin-top: 15px;
    color: #f4c430;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s ease;
}

/* Link animasi */
.layanan-card:hover .layanan-link {
    letter-spacing: 1px;
}

/* ================= STATISTIK ================= */
.statistik-box {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.mini-stat {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    transition: transform 0.3s ease, background 0.3s ease;
}

.mini-stat:hover {
    background: #0d4d2c;
    color: white;
    transform: translateY(-5px);
}

.mini-stat h2 {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 5px;
}

.big-icon {
    font-size: 100px;
    color: #0d4d2c;
    opacity: 0.9;
    transition: transform 0.3s ease;
}

.big-icon:hover {
    transform: scale(1.1);
}

// jam layanan //
/* ================= JAM SECTION PREMIUM ================= */
/* ================= JAM SECTION PREMIUM ================= */

@media (min-width: 992px) {

.jam-section {
    background: linear-gradient(
        120deg,
        #ffffff 65%,
        #e9f7f1 65%
        
    );
    padding: 80px 0;
}
    /* lingkaran 1 */
.jam-section::before {
    content: "";
    position: absolute;

    width: 900px;
    height: 900px;

    right: -400px;
    top: -200px;

    background: #d1fae5; /* hijau muda */
    border-radius: 50%;

    z-index: 0;
}

    /* lingkaran 2 */
    .jam-section::after {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        background: rgba(143, 191, 159, 0.18);
        border-radius: 50%;
        bottom: -80px;
        right: -80px;
        animation: float2 10s ease-in-out infinite;
        filter: blur(2px);
    }
}



/* HEADER TITLE */
.jam-header {
    display: flex;
    justify-content: center;
    margin-bottom: 25px;
}

.jam-title span {
    background: linear-gradient(135deg, #FFC107, #FFD54F);
    color: #000;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 18px;
    display: inline-block;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    letter-spacing: 0.5px;
}

/* JUDUL BESAR */
.jam-header h2 {
    font-weight: 800;
    color: #2F5D50;
    font-size: 30px;
    text-align: center;
}

/* UNDERLINE */
.jam-header .underline {
    width: 140px;
    height: 5px;
    background: #f1c40f;
    margin: 10px auto 0;
    border-radius: 50px;
}

/* CARD */
.jam-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 30px 18px;
    text-align: center;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    border-top: 5px solid #2F5D50;
    transition: all 0.3s ease;
    height: 100%;
}

/* ICON */
.jam-card i {
    font-size: 40px;
    color: #2F5D50;
    margin-bottom: 12px;
}

/* TITLE */
.jam-card h5 {
    font-weight: 700;
    margin-bottom: 5px;
    color: #2F5D50;
    font-size: 16px;
}

/* JAM TEXT */
.jam-card p {
    margin: 0;
    font-size: 15px;
    color: #555;
}

/* HOVER EFFECT */
.jam-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 20px 45px rgba(0,0,0,0.15);
    border-top: 5px solid #f1c40f;
}

/* TUTUP CARD */
.jam-card.tutup {
    border-top: 5px solid #e74c3c;
}

.jam-card.tutup i {
    color: #e74c3c;
}

/* ================= TABLET ================= */

@media (max-width: 768px) {

    .jam-header h2 {
        font-size: 22px;
    }

    .jam-title span {
        font-size: 15px;
        padding: 8px 18px;
    }

    .jam-card {
        padding: 20px 12px;
    }

    .jam-card i {
        font-size: 30px;
    }

    .jam-card h5 {
        font-size: 14px;
    }

    .jam-card p {
        font-size: 13px;
    }
}

/* ================= DESKTOP PREMIUM ================= */

@media (min-width: 992px) {

    .jam-section {
        padding: 80px 0;
    }

    .jam-header h2 {
        font-size: 36px;
        letter-spacing: 1px;
    }

    .jam-title span {
        font-size: 20px;
        padding: 14px 32px;
    }

    .jam-card {
        padding: 40px 25px;
        border-radius: 26px;
    }

    .jam-card i {
        font-size: 48px;
    }

    .jam-card h5 {
        font-size: 18px;
    }

    .jam-card p {
        font-size: 16px;
    }

    .jam-card:hover {
        transform: translateY(-12px) scale(1.05);
    }
}

.jam-section .container {
    position: relative;
    z-index: 2;
}

/* ================= SAMBUTAN HIJAU KUNING ================= */

.sambutan-section {
    background: linear-gradient(135deg, #2c7744, #1f4037);
    position: relative;
    overflow: hidden;
}

/* Garis emas halus */
.sambutan-section::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    background-image: repeating-linear-gradient(
        45deg,
        rgba(244,196,48,0.08) 0px,
        rgba(244,196,48,0.08) 2px,
        transparent 2px,
        transparent 25px
    );
    animation: moveGold 50s linear infinite;
}

/* Glow kuning pojok */
.sambutan-section::after {
    content: "";
    position: absolute;
    bottom: -120px;
    right: -120px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(244,196,48,0.25) 0%, transparent 70%);
    border-radius: 50%;
}

@keyframes moveGold {
    from { transform: translate(0,0); }
    to { transform: translate(-200px,-200px); }
}

/* Box isi */
.sambutan-box {
    background: rgba(255,255,255,0.95);
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    position: relative;
    z-index: 2;
}



.foto-wrapper {
    display: flex;
    justify-content: center;
}

.foto-sambutan {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 50%;
    border: 6px solid #f4c430;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.foto-animasi {
    position: relative;
    width: 230px;
    height: 230px;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: floating 4s ease-in-out infinite;
}

/* Glow halus */
.foto-animasi::before {
    content: "";
    position: absolute;
    width: 240px;
    height: 240px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(244,196,48,0.3) 0%, transparent 70%);
    z-index: 0;
}

/* Garis kuning melingkar */
.foto-animasi::after {
    content: "";
    position: absolute;
    width: 245px;
    height: 245px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top: 3px solid #f4c430;
    border-right: 3px solid #f4c430;
    animation: rotateRing 5s linear infinite;
    z-index: 1;
}

@keyframes rotateRing {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes floating {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
    100% { transform: translateY(0px); }
}

.foto-sambutan {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 50%;
    border: 6px solid #ffffff;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    position: relative;
    z-index: 2;
}



/* ================= SCROLL SMOOTH ================= */
html {
    scroll-behavior: smooth;
}

/* ================= ANIMASI SCROLL (FINAL FIX) ================= */
.fade-scroll {
    opacity: 0;
    transform: translateY(60px);
    transition: 
        opacity 0.8s ease-out,
        transform 0.8s ease-out;
    will-change: opacity, transform;
}

.fade-scroll.show {
    opacity: 1;
    transform: translateY(0);
}

/* ================= STATISTIK BACKGROUND PREMIUM ================= */

.statistik-section {
    background: linear-gradient(135deg, #1f4037, #2c7744);
    position: relative;
    overflow: hidden;
}

/* motif garis halus */
.statistik-section::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    background-image: repeating-linear-gradient(
        45deg,
        rgba(255,255,255,0.03) 0px,
        rgba(255,255,255,0.03) 2px,
        transparent 2px,
        transparent 20px
    );
    animation: movePattern 40s linear infinite;
}

@keyframes movePattern {
    from { transform: translate(0,0); }
    to { transform: translate(-200px,-200px); }
}

.statistik-box {
    position: relative;
    z-index: 2;
}



/* ================= KHUSUS HP (BERSIH & FIX) ================= */
@media (max-width: 768px) {

    /* ===== HERO ===== */
    .hero-section {
        height: 50vh;
        text-align: center;
    }

    .hero-title {
        font-size: 32px !important;
    }

    .hero-subtitle {
        font-size: 14px !important;
    }

    /* ===== HIDE SECTION ===== */
    .layanan-section,
    .statistik-section,
    .sambutan-section {
        display: none !important;
    }

    /* ===== MENU HP ===== */
.menu-hp {
    margin-top: 25px;
    padding: 10px 10px 20px;

    background: linear-gradient(180deg, #f4f7f5, #e9f2ee); /* 🔥 ada gradasi */
    border-radius: 20px;

    box-shadow: 0 6px 15px rgba(0,0,0,0.05); /* biar gak flat */
}

    .menu-hp .row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

   
    /* ===== BIAR BAWAH 2 ITEM TENGAH ===== */

    

    /* ===== FOTO ===== */
    .foto-animasi {
        width: 120px;
        height: 120px;
    }

    .foto-sambutan {
        width: 100px;
        height: 100px;
    }
}

/* ================= BERITA ================= */
.berita-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;

    display: flex;
    flex-direction: column;
    height: 100%;
}

.berita-body {
    padding: 12px;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.berita-card:hover {
    transform: translateY(-6px);
}

.berita-img {
    height: 140px;
}

.berita-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.berita-body {
    padding: 12px;
}

.berita-body h6 {
    font-size: 14px;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.berita-body p {
    font-size: 12px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-link {
    margin-top: auto;
    text-decoration: none;
    color: #2F5D50;
    font-weight: 600;
    font-size: 14px;
}

.berita-link:hover {
    color: #f4c430;
}

/* SLIDER */
.berita-wrapper {
    position: relative;
}

.berita-scroll {
    display: flex;
    overflow-x: auto;
    gap: 15px;
    scroll-behavior: smooth;
    padding: 10px;
}

.berita-scroll::-webkit-scrollbar {
    display: none;
}

.berita-item {
    min-width: 220px;
    max-width: 220px;
    flex: 0 0 auto;
}

/* WRAPPER */
.header-line {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

/* GARIS KIRI & KANAN */
.header-line::before,
.header-line::after {
    content: "";
    flex: 1;
    height: 3px;
    background: #2F5D50;
    border-radius: 50px;
}

/* TEXT KUNING */
.header-line span {
    background: linear-gradient(135deg, #FFC107, #FFD54F);
    color: #000;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 20px;
    white-space: nowrap;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.berita-section {
    position: relative;
    overflow: hidden;
}

/* LINGKARAN HIJAU */
.berita-section::before {
    content: "";
    position: absolute;
    top: -10%;
    left: -10%;
    width: 25vw;
    height: 25vw;
    max-width: 280px;
    max-height: 280px;
    background: #2F5D50;
    opacity: 0.12;
    border-radius: 50%;
}

/* LINGKARAN KUNING */
.berita-section::after {
    content: "";
    position: absolute;
    bottom: -12%;
    right: -12%;
    width: 30vw;
    height: 30vw;
    max-width: 320px;
    max-height: 320px;
    background: #f1c40f;
    opacity: 0.15;
    border-radius: 50%;
}

@media (max-width: 768px) {

    .berita-section::before {
        width: 35vw;
        height: 35vw;
        top: -8%;
        left: -8%;
    }

    .berita-section::after {
        width: 40vw;
        height: 40vw;
        bottom: -10%;
        right: -10%;
    }
}
/* BUTTON */
.btn-slide {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    border: none;
    background: #2F5D50;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    z-index: 10;
}

.btn-slide:hover {
    background: #f4c430;
    color: black;
}

.btn-slide.left {
    left: -10px;
}

.btn-slide.right {
    right: -10px;
}


/* menu hp */

.menu-grid {
    display: grid;
    gap: 10px;
    padding: 10px;

    /* default HP kecil */
    grid-template-columns: repeat(3, 1fr);
}

/* HP agak besar */
@media (min-width: 480px) {
    .menu-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.menu-item {
    height: 85px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    background: linear-gradient(135deg, #2F5D50, #3E7C6F);
    border-radius: 14px;

    color: #fff;
    text-decoration: none;
    font-weight: 600;

    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
}

.menu-item i {
    font-size: 18px;
    width: 34px;
    height: 34px;

    border-radius: 50%;
    background: rgba(255,255,255,0.15);
    color: #FFC107;

    display: flex;
    justify-content: center;
    align-items: center;
}

.menu-item p {
    font-size: 10px;
    margin: 2px 0 0;
}

.judul-menu-hp {
    display: flex;
    justify-content: center;
    margin: 15px 0;
}

.judul-menu-hp span {
    background: #ffc107; /* kuning */
    color: #000;
    padding: 8px 18px;
    border-radius: 50px; /* bikin bulat */
    font-weight: 600;
    font-size: 14px;
    display: inline-block;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

@media (min-width: 768px) and (max-width: 1024px) {

    body {
        padding-top: 90px;
    }

    .hero-title {
        font-size: 48px;
        text-align: center;
    }

    .container {
        padding-left: 25px;
        padding-right: 25px;
    }

    .mobile-float-nav {
        width: 80%;
        max-width: 520px;
    }

    .berita-card {
        transform: scale(0.95);
    }
}

.jam-section {
    position: relative;
    overflow: hidden;
}

/* SHAPE SETENGAH LINGKARAN BESAR */
.jam-section::after {
    content: "";
    position: absolute;

    width: 900px;
    height: 900px; /* 🔥 sama → BULAT SEMPURNA */

    right: -300px; /* geser keluar biar jadi setengah */
    top: 50%;
    transform: translateY(-50%);

    background: #2F5D50;
    opacity: 0.12;

    border-radius: 50%;
    z-index: 0;
}

@media (max-width: 768px) {
    .jam-section {
        background: #f4f7f5;
        position: relative;
        overflow: hidden;
    }

    .jam-section::after {
        content: "";
        position: absolute;
        inset: 0;

        background-image: repeating-linear-gradient(
            45deg,
            rgba(47,93,80,0.04) 0px,
            rgba(47,93,80,0.04) 2px,
            transparent 2px,
            transparent 25px
        );

        opacity: 0.5;
        z-index: 0;
    }

    .jam-section .container {
        position: relative;
        z-index: 2;
    }
}


@media (max-width: 768px) {
    .jam-section {
        box-shadow: 
            inset 0 -4px 0 #1f4037, /* bawah */
            inset 0 4px 0 #1f4037;  /* atas */
    }
}



</style>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const elements = document.querySelectorAll(
        ".layanan-card, .mini-stat, .jam-card, .sambutan-box"
    );

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    elements.forEach(el => {
        el.classList.add("fade-scroll");
        observer.observe(el);
    });
    

});


</script>

<script>
function scrollBerita(direction) {
    const container = document.getElementById("beritaScroll");

    const scrollAmount = 250; // jarak geser (px)

    container.scrollBy({
        left: direction * scrollAmount,
        behavior: "smooth"
    });
}


</script>

@endsection