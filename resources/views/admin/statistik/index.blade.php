@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">

        <div>
            <h4 class="fw-bold mb-1">
                 <i class="bi bi-bar-chart-line"></i> Statistik Kelurahan
            </h4>
            <small class="text-muted">
                Data real-time jumlah penduduk & wilayah
            </small>
        </div>
<a href="/admin/statistik/edit" class="btn btn-primary">
    Edit
</a>
    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            ✅ <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- STAT CARD -->
    <div class="row g-4">

        <!-- PENDUDUK -->
        <div class="col-12 col-md-4">
            <div class="card stat-card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">

                    <div class="icon-box bg-primary-subtle text-primary mx-auto">
                         <i class="bi bi-people-fill fs-2"></i>
                    </div>

                    <h6 class="mt-3 text-muted">Jumlah Penduduk</h6>

                    <h2 class="fw-bold text-primary counter">
                        {{ number_format($penduduk->value ?? 0, 0, ',', '.') }}
                    </h2>

                    <small class="text-muted">orang </small>

                </div>
            </div>
        </div>

        <!-- RT -->
        <div class="col-12 col-md-4">
            <div class="card stat-card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">

                    <div class="icon-box bg-success-subtle text-success mx-auto">
                         <i class="bi bi-house-door-fill fs-2"></i>
                    </div>

                    <h6 class="mt-3 text-muted">Jumlah RT</h6>

                    <h2 class="fw-bold text-success counter">
                        {{ number_format($rt->value ?? 0, 0, ',', '.') }}
                    </h2>

                    <small class="text-muted">RT aktif </small>

                </div>
            </div>
        </div>

        <!-- RW -->
        <div class="col-12 col-md-4">
            <div class="card stat-card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">

                    <div class="icon-box bg-warning-subtle text-warning mx-auto">
                         <i class="bi bi-building fs-2"></i>
                    </div>

                    <h6 class="mt-3 text-muted">Jumlah RW</h6>

                    <h2 class="fw-bold text-warning counter">
                        {{ number_format($rw->value ?? 0, 0, ',', '.') }}
                    </h2>

                    <small class="text-muted">RW wilayah </small>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection


@section('styles')
<style>

/* CARD HOVER */
.stat-card {
    transition: all 0.3s ease;
    border-radius: 18px;
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* ICON BOX */
.icon-box {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

/* TEXT */
.counter {
    font-size: 32px;
    letter-spacing: 1px;
}

/* HEADER */
h4 {
    letter-spacing: 0.5px;
}

/* RESPONSIVE */
@media (max-width: 768px) {

    .counter {
        font-size: 26px;
    }

    h4 {
        font-size: 18px;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
}

</style>
@endsection