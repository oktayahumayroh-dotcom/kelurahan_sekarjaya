@extends('admin.layout')

@section('content')

<h4 class="mb-4 fw-bold">Dashboard Admin</h4>

<style>
    .card-dashboard {
        border: none;
        border-radius: 14px;
        transition: 0.2s;
        background: #ffffff;
    }

    .card-dashboard:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .card-title-small {
        font-size: 13px;
        color: #777;
    }

    .card-value {
        font-size: 24px;
        font-weight: 700;
    }

    .chart-card {
        border-radius: 14px;
        border: none;
    }

    .btn-custom {
        border-radius: 10px;
        padding: 10px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .card-value {
            font-size: 20px;
        }
    }
</style>

<div class="row g-3">

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Total</div>
            <div class="card-value">{{ $total ?? 0 }}</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Pending</div>
            <div class="card-value text-warning">{{ $pending ?? 0 }}</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Proses</div>
            <div class="card-value text-primary">{{ $proses ?? 0 }}</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Selesai</div>
            <div class="card-value text-success">{{ $selesai ?? 0 }}</div>
        </div>
    </div>

</div>

<!-- CHART -->
<div class="card chart-card shadow-sm mt-4">
    <div class="card-body">
        <h6 class="mb-3 fw-semibold">Statistik Pengajuan</h6>

        <div style="height:220px;">
            <canvas id="chartSurat"></canvas>
        </div>

    </div>
</div>

<!-- BUTTON -->
<div class="mt-4">
    <a href="/admin/pengajuan" class="btn btn-success btn-custom w-100">
        Lihat Data Pengajuan
    </a>
</div>

<div class="row g-3 mt-1">

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Total Pengaduan</div>
            <div class="card-value text-danger">
    {{ $total_pengaduan ?? 0 }}
</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Pending</div>
            <div class="card-value text-warning">{{ $pengaduan_pending ?? 0 }}</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Proses</div>
            <div class="card-value text-primary">{{ $pengaduan_proses ?? 0 }}</div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="card card-dashboard p-3">
            <div class="card-title-small">Ditindaklanjuti</div>
            <div class="card-value text-success">{{ $pengaduan_selesai ?? 0 }}</div>
        </div>
    </div>

</div>

<div class="card chart-card shadow-sm mt-4">
    <div class="card-body">
        <h6 class="mb-3 fw-semibold">Statistik Pengaduan</h6>

        <div style="height:220px;">
            <canvas id="chartPengaduan"></canvas>
        </div>

    </div>
</div>
<div class="mt-2">
    <a href="/admin/pengaduan" class="btn btn-danger btn-custom w-100">
        Lihat Data Pengaduan
    </a>
</div>

@endsection


@section('scripts')

<!-- 🔊 AUDIO -->
<audio id="notifSound" src="{{ asset('sound/notif.mp3') }}"></audio>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
const ctx = document.getElementById('chartSurat');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Proses', 'Selesai'],
        datasets: [{
            data: [
                {{ $pending ?? 0 }},
                {{ $proses ?? 0 }},
                {{ $selesai ?? 0 }}
            ],
            backgroundColor: ['#ffc107','#0d6efd','#198754'],
            borderRadius: 6,
            barThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: false,
        plugins: { legend: { display: false }},
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
                grid: { color: 'rgba(0,0,0,0.04)' }
            },
            x: { grid: { display: false }}
        }
    }
});

const ctx2 = document.getElementById('chartPengaduan');

new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Proses', 'Ditindaklanjuti'],
        datasets: [{
            data: [
                {{ $pengaduan_pending ?? 0 }},
                {{ $pengaduan_proses ?? 0 }},
                {{ $pengaduan_selesai ?? 0 }}
            ],
            backgroundColor: ['#ffc107','#0d6efd','#198754'],
            borderRadius: 6,
            barThickness: 30
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false }},
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>


<!-- 🔥 NOTIF SYSTEM -->


@endsection