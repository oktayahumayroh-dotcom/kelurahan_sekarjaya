@extends('layouts.main')

@section('content')

<!-- HERO -->
<section class="hero-sejarah">
    
    <img src="{{ asset('images/gambar1.png') }}" class="hero-img">

    <div class="overlay"></div>

    <div class="hero-content text-center">
        <h1>KELURAHAN SEKARJAYA</h1>
        <p>Mengenal perjalanan terbentuknya wilayah yang berkembang pesat</p>
    </div>

    <div class="hero-shape"></div>

</section>


<!-- CONTENT -->
<section class="sejarah-wrapper py-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="sejarah-card fade-scroll">

                    <h4 class="fw-bold mb-4">
                        <span class="highlight-title">Sejarah</span>
                    </h4>

                    <p>
                        Kelurahan Sekarjaya awalnya merupakan bagian dari Dusun V Desa Tanjung Kemala, Kecamatan Baturaja Timur.
                    </p>

                    <p>
                        Perkembangan wilayah mulai meningkat sejak pembangunan perumahan pada tahun 1995 hingga 1998.
                    </p>

                    <p>
                        Pada tahun 2005 dibentuk desa baru bernama <strong>Sekar Jaya</strong>.
                    </p>

                    <p>
                        Tahun 2006 resmi berdiri dan 2008 menjadi <strong>Kelurahan Sekarjaya</strong>.
                    </p>

                </div>

            </div>
        </div>

    </div>
</section>


<!-- 🔥 FLOATING NAV MODERN -->
<div class="bottom-nav d-lg-none">
    <a href="/profil/sejarah" class="active">
        <i class="bi bi-book"></i>
        <span>Sejarah</span>
    </a>
    <a href="/visi-misi">
        <i class="bi bi-bullseye"></i>
        <span>Visi</span>
    </a>
    <a href="/statistik">
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

/* HERO */
.hero-sejarah {
    position: relative;
    height: 420px;
    overflow: hidden;
}

.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.75);
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
}

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
    font-size: 42px;
    font-weight: 700;
}

.hero-shape {
    position: absolute;
    bottom: -1px;
    width: 100%;
    height: 80px;
    background: white;
    border-top-left-radius: 60% 100%;
    border-top-right-radius: 60% 100%;
}

/* CONTENT */
.sejarah-wrapper {
    background: linear-gradient(135deg, #f4f7f5, #e9f2ef);
    margin-top: -40px;
    padding-top: 60px;
}

.sejarah-card {
    background: white;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    line-height: 1.8;
    font-size: 15px;
    text-align: justify;
}

/* TITLE */
.highlight-title {
    background: linear-gradient(135deg, #f4c430, #ffdd55);
    padding: 6px 14px;
    border-radius: 8px;
    color: #2F5D50;
}

/* ================= FLOATING NAV PREMIUM ================= */
.bottom-nav {
    position: fixed;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);

    width: 90%;
    max-width: 420px;

    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);

    display: flex;
    justify-content: space-around;
    align-items: center;

    padding: 10px 5px;
    border-radius: 20px;

    box-shadow: 0 10px 30px rgba(0,0,0,0.15);

    z-index: 999;

    animation: floatUp 0.6s ease;
}

.bottom-nav a {
    display: flex;
    flex-direction: column;
    align-items: center;

    font-size: 11px;
    color: #2F5D50;
    text-decoration: none;
    font-weight: 600;

    transition: all 0.2s ease;
}

.bottom-nav a i {
    font-size: 18px;
    margin-bottom: 3px;
}

/* ACTIVE */
.bottom-nav a.active {
    color: #f4c430;
    transform: scale(1.1);
}

/* TAP EFFECT */
.bottom-nav a:active {
    transform: scale(0.9);
}

/* ANIMASI */
@keyframes floatUp {
    from {
        opacity: 0;
        transform: translate(-50%, 40px);
    }
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}

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

    .hero-sejarah {
        height: 300px;
    }

    .hero-content h1 {
        font-size: 24px;
    }

    .hero-content p {
        font-size: 13px;
    }

    .sejarah-card {
        padding: 20px;
        font-size: 13px;
    }

}

</style>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const el = document.querySelector('.fade-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    });

    observer.observe(el);

});
</script>