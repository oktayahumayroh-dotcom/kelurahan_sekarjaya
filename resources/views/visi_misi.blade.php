@extends('layouts.main')

@section('content')

<!-- HERO -->
<section class="hero-visi">
    
    <img src="{{ asset('images/gambar1.png') }}" class="hero-img">

    <div class="overlay"></div>

    <div class="hero-content text-center">
        <h1>VISI & MISI</h1>
        <p>Arah pembangunan dan pelayanan Kelurahan Sekarjaya</p>
    </div>

    <div class="hero-shape"></div>

</section>


<!-- CONTENT -->
<section class="visi-wrapper py-5">
    <div class="container position-relative">

        <!-- WATERMARK -->
        <div class="bg-icon">
            <i class="bi bi-diagram-3"></i>
        </div>

        <!-- VISI -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">

                <div class="visi-box fade-scroll text-center">
                    <h5 class="fw-bold mb-3">VISI</h5>

                    <p>
                        Terwujudnya tata pemerintahan yang baik dan pelayanan prima 
                        untuk kesejahteraan masyarakat.
                    </p>

                </div>

            </div>
        </div>

        <!-- DIVIDER -->
        <div class="divider text-center mb-4 fade-scroll">
            <span>MISI</span>
        </div>

        <!-- MISI -->
        <div class="row g-4 justify-content-center">

            <div class="col-md-4 col-12">
                <div class="misi-card fade-scroll">
                    <i class="bi bi-lightning-charge-fill"></i>
                    <p>Pelayanan cepat, jujur, adil, dan transparan</p>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="misi-card fade-scroll">
                    <i class="bi bi-shield-check"></i>
                    <p>Tata kelola pemerintahan yang baik dan bersih</p>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="misi-card fade-scroll">
                    <i class="bi bi-people-fill"></i>
                    <p>Menjaga keamanan, ketertiban, dan kenyamanan masyarakat</p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- FLOATING NAV -->
<div class="bottom-nav">
    <a href="sejarah">
        <i class="bi bi-book"></i>
        <span>Sejarah</span>
    </a>
    <a href="/visi-misi" class="active">
        <i class="bi bi-bullseye"></i>
        <span>Visi</span>
    </a>
    <a href="statistik">
        <i class="bi bi-bar-chart"></i>
        <span>Statistik</span>
    </a>
    <a href="/">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

@endsection


<style>

/* FONT */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
}

/* HERO */
.hero-visi {
    position: relative;
    height: 420px;
    overflow: hidden;
}

.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.6);
}

/* 🔥 OVERLAY GRADIENT BIAR TEXT JELAS */
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.5),
        rgba(0,0,0,0.7)
    );
}

/* 🔥 TEXT HERO LEBIH JELAS */
.hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    z-index: 2;
    animation: fadeDown 1s ease;
}

.hero-content h1 {
    font-size: 44px;
    font-weight: 700;
    text-shadow: 0 8px 25px rgba(0,0,0,0.6);
    letter-spacing: 1px;
}

.hero-content p {
    font-size: 16px;
    opacity: 0.95;
    text-shadow: 0 5px 15px rgba(0,0,0,0.5);
}

/* SHAPE */
.hero-shape {
    position: absolute;
    bottom: -1px;
    width: 100%;
    height: 80px;
    background: white;
    border-top-left-radius: 60% 100%;
    border-top-right-radius: 60% 100%;
}

/* WRAPPER */
.visi-wrapper {
    background: linear-gradient(135deg, #f4f7f5, #e9f2ef);
    margin-top: -40px;
    padding-top: 60px;
    padding-bottom: 140px;
}

/* WATERMARK */
.bg-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 350px;
    color: rgba(47, 93, 80, 0.05);
}

/* VISI */
.visi-box {
    background: linear-gradient(135deg, #f4c430, #ffdd55);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    color: #2F5D50;
}

/* DIVIDER */
.divider span {
    background: #2F5D50;
    color: white;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 600;
}

/* 🔥 MISI FIX ANTI GEPENG */
.misi-card {
    background: white;
    padding: 30px 25px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);

    min-height: 180px; /* 🔥 penting */
    display: flex;
    flex-direction: column;
    justify-content: center;

    transition: 0.3s;
}

.misi-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.misi-card i {
    font-size: 32px;
    color: #2F5D50;
    margin-bottom: 10px;
}

/* NAV */
.bottom-nav {
    position: fixed !important;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 92%;
    max-width: 420px;

    display: flex;
    justify-content: space-around;
    align-items: center;

    padding: 12px 8px;

    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(18px);

    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);

    z-index: 999999 !important;
}

.bottom-nav a {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 11px;
    color: #2F5D50;
    text-decoration: none;
    font-weight: 600;
}

.bottom-nav a.active {
    color: #f4c430;
    transform: scale(1.1);
}

/* ANIMASI */
.fade-scroll {
    opacity: 0;
    transform: translateY(40px);
    transition: 0.6s;
}

.fade-scroll.show {
    opacity: 1;
    transform: translateY(0);
}

@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translate(-50%, -70%);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}

/* RESPONSIVE */
@media (max-width: 768px) {

    .hero-visi {
        height: 300px;
    }

    .hero-content h1 {
        font-size: 26px;
    }

    .hero-content p {
        font-size: 13px;
    }

    .misi-card {
        min-height: 150px;
    }
}

</style>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const elements = document.querySelectorAll('.fade-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    });

    elements.forEach(el => observer.observe(el));

});
</script>