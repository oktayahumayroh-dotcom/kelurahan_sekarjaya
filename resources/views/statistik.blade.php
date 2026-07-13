@extends('layouts.main')

@section('content')

<!-- HERO -->
<section class="hero-statistik">
    
    <img src="{{ asset('images/gambar1.png') }}" class="hero-img">

    <div class="overlay"></div>

    <div class="hero-content text-center">
        <h1>STATISTIK</h1>
        <p class="hero-sub">
            Data kependudukan dan pelayanan Kelurahan Sekarjaya
        </p>
    </div>

    <div class="hero-shape"></div>

</section>

<!-- CONTENT -->
<section class="statistik-wrapper py-5">
    <div class="container position-relative">

        <!-- WATERMARK -->
        <div class="bg-icon">
            <i class="bi bi-bar-chart"></i>
        </div>

        <!-- STAT CARD -->
       <div class="row g-4 mb-5">

    <div class="col-6 col-md-4 col-lg-3">
        <div class="stat-card fade-scroll">
            <h3>{{ number_format($penduduk->value ?? 0, 0, ',', '.') }}</h3>
            <p>{{ $penduduk->name ?? 'Jumlah Penduduk' }}</p>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3">
        <div class="stat-card fade-scroll">
           <h3>{{ number_format($rt->value ?? 0, 0, ',', '.') }}</h3>
            <p>{{ $rt->name ?? 'Jumlah RT' }}</p>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3">
        <div class="stat-card fade-scroll">
         <h3>{{ number_format($rw->value ?? 0, 0, ',', '.') }}</h3>
            <p>{{ $rw->name ?? 'Jumlah RW' }}</p>
        </div>
    </div>

    <!-- 🔥 PINDAHIN KE SINI -->
    <div class="col-6 col-md-4 col-lg-3">
        <div class="stat-card fade-scroll">
           <h3>{{ number_format($suratMasuk ?? 0, 0, ',', '.') }}</h3>
            <p>Total Pengajuan Surat</p>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
    <div class="stat-card fade-scroll">
    <h3>{{ number_format($pengaduan ?? 0, 0, ',', '.') }}</h3>
        <p>Total Pengaduan</p>
    </div>
</div>

</div>
        <!-- CHART -->
        <div class="chart-card fade-scroll">
            <h5 class="fw-bold text-center mb-4">
                Grafik Statistik Kelurahan
            </h5>
            <canvas id="chartStatistik"></canvas>
        </div>

    </div>
</section>

<!-- FLOAT NAV -->
<div class="bottom-nav">
    <a href="/sejarah">
        <i class="bi bi-book"></i>
        <span>Sejarah</span>
    </a>
    <a href="/visi-misi">
        <i class="bi bi-bullseye"></i>
        <span>Visi</span>
    </a>
    <a href="/statistik" class="active">
        <i class="bi bi-bar-chart"></i>
        <span>Statistik</span>
    </a>
    <a href="/">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

@endsection


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartStatistik');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Penduduk', 'RT', 'RW', 'Surat'],
        datasets: [{
            data: [
                {{ $penduduk->value ?? 0 }},
                {{ $rt->value ?? 0 }},
                {{ $rw->value ?? 0 }},
                 {{ $suratMasuk }}
            ],
            borderWidth: 1,
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// ANIMASI SCROLL
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

@endsection


<style>

/* FONT */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
}

/* HERO */
.hero-statistik {
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

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.7));
}

.hero-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
}

.hero-content h1 {
    font-size: 44px;
    font-weight: 700;
}

.hero-sub {
    margin-top: 10px;
    padding: 6px 14px;
    background: rgba(255,255,255,0.15);
    border-radius: 8px;
}

/* SHAPE */
.hero-shape {
    position: absolute;
    bottom: -1px;
    width: 100%;
    height: 80px;
    background: white;
    border-radius: 60% 60% 0 0;
}

/* WRAPPER */
.statistik-wrapper {
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
    font-size: 250px;
    color: rgba(47, 93, 80, 0.05);
}

/* CARD */
.stat-card {
    background: white;
    padding: 25px 15px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
    height: 100%;
}

.stat-card h3 {
    font-size: 26px;
    font-weight: 700;
    color: #2F5D50;
}

.stat-card p {
    font-size: 13px;
    color: #777;
}

.stat-card:hover {
    transform: translateY(-8px) scale(1.03);
}

/* CHART */
.chart-card {
    background: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    height: 300px;
}

/* FLOAT NAV */
.bottom-nav {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 92%;
    max-width: 420px;
    display: flex;
    justify-content: space-around;
    padding: 12px 8px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(18px);
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
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

/* RESPONSIVE */
@media (max-width: 768px) {

    .hero-statistik {
        height: 280px;
    }

    .hero-content h1 {
        font-size: 24px;
    }

    .stat-card {
        padding: 18px;
    }

    .chart-card {
        height: 250px;
    }

}

</style>