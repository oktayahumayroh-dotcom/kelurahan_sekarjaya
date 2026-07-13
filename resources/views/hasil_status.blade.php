@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h4 class="text-center fw-semibold mb-4">Hasil Status Surat</h4>

@if($data && $data->count() > 0)
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('riwayat.surat', ['nik' => $data->first()->nik]) }}"
       class="btn-riwayat">
        <i class="bi bi-clock-history"></i> Riwayat
    </a>
</div>
@endif

    @if(!$data || $data->isEmpty())
        <div class="alert alert-danger text-center">
            Data tidak ditemukan
        </div>
    @else

    @foreach($data as $item)

    <div class="card card-status mb-4">

        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ $item->nama }}</h5>

                <span class="badge-status
                    @if($item->status_surat == 'pending') warning
                    @elseif($item->status_surat == 'proses') primary
                    @elseif($item->status_surat == 'selesai') success
                    @elseif($item->status_surat == 'ditolak') danger
                    @endif">

                    {{ ucfirst($item->status_surat) }}
                </span>
            </div>

            <!-- 🔥 INFO SURAT -->
            <div class="info-top mb-3">
                <div>
                    <small class="text-muted">Jenis Surat</small><br>
                    <b>{{ $item->jenis_surat ?? '-' }}</b>
                </div>

                <div>
                    <small class="text-muted">Tanggal Pengajuan</small><br>
                    <b>
                        @if($item->created_at)
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </b>
                </div>
            </div>

            <!-- DATA -->
            <div class="data-grid">
                <div><b>NIK</b><br>{{ $item->nik }}</div>
                <div><b>Tempat Lahir</b><br>{{ $item->tempat_lahir }}</div>
                <div><b>Tanggal Lahir</b><br>{{ $item->tanggal_lahir }}</div>
                <div><b>Jenis Kelamin</b><br>{{ $item->jenis_kelamin }}</div>
                <div class="full"><b>Alamat</b><br>{{ $item->alamat }}</div>
            </div>

            <!-- PROGRESS -->
            <div class="progress-wrapper mt-4">

                <div class="progress-base"></div>

                <div class="progress-active
                    @if($item->status_surat == 'pending') w-0 bg-orange
                    @elseif($item->status_surat == 'proses') w-50 bg-blue
                    @elseif($item->status_surat == 'selesai') w-100 bg-green
                    @elseif($item->status_surat == 'ditolak') w-50 bg-red
                    @endif">
                </div>

                <div class="step">
                    <div class="circle 
                        @if(in_array($item->status_surat,['pending','proses','selesai'])) active-orange @endif"></div>
                    <small>Pending</small>
                </div>

                <div class="step">
                    <div class="circle 
                        @if(in_array($item->status_surat,['proses','selesai'])) active-blue @endif"></div>
                    <small>Diproses</small>
                </div>

                <div class="step">
                    <div class="circle 
                        @if($item->status_surat == 'selesai') active-green @endif"></div>
                    <small>Selesai</small>
                </div>

            </div>

            <!-- DETAIL -->
            @if($item->status_surat == 'selesai')
            <div class="info-box success mt-4">
                <p><b>Jadwal Pengambilan:</b></p>

                @if($item->jadwal_ambil)
                    @php
                        $tanggal = \Carbon\Carbon::parse($item->jadwal_ambil)->translatedFormat('d F Y');
                    @endphp

                    <p>
                        {{ $tanggal }}
                        @if($item->jam_ambil && $item->jam_ambil != '08:00')
                            - {{ \Carbon\Carbon::parse($item->jam_ambil)->format('H:i') }} WIB
                        @else
                            (08:00 - 14:00 WIB)
                        @endif
                    </p>
                @endif

                <p><b>Catatan:</b><br>{{ $item->catatan ?? '-' }}</p>
            </div>

            @elseif($item->status_surat == 'ditolak')

            <div class="info-box danger mt-4">
                <p><b>Alasan Penolakan:</b></p>
                <p>{{ $item->catatan ?? '-' }}</p>
            </div>

            @endif


        </div>
    </div>

    @endforeach

    @endif

    <!-- BUTTON -->
    <div class="text-center mt-4">
        <button onclick="location.reload()" class="btn-refresh">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>

        <a href="/cek-status" class="btn-back">
            <i class="bi bi-search"></i> Cek Lagi
        </a>
    </div>

</div>

<style>

/* CARD */
.card-status {
    border-radius: 14px;
    border: 1px solid #eee;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

/* INFO TOP */
.info-top {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    font-size: 14px;
}

/* BADGE */
.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-status.warning { background: #fff4e5; color: #ff8800; }
.badge-status.primary { background: #e7f1ff; color: #0d6efd; }
.badge-status.success { background: #e8f8f0; color: #198754; }
.badge-status.danger { background: #fdecea; color: #dc3545; }

/* DATA */
.data-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    font-size: 14px;
}

.data-grid .full {
    grid-column: span 2;
}

/* PROGRESS */
.progress-wrapper {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* GARIS DASAR */
.progress-base {
    position: absolute;
    top: 10px;
    left: 0;
    width: 100%;
    height: 4px;
    background: #ddd;
    border-radius: 10px;
}

/* GARIS AKTIF */
.progress-active {
    position: absolute;
    top: 10px;
    left: 0;
    height: 4px;
    border-radius: 10px;
    transition: 0.4s;
}

/* WIDTH FIX */
.w-0 { width: 0%; }
.w-50 { width: 50%; }
.w-100 { width: 100%; }

.bg-orange { background: #ff8800; }
.bg-blue { background: #0d6efd; }
.bg-green { background: #198754; }
.bg-red { background: #dc3545; }

.step {
    position: relative;
    z-index: 1;
    text-align: center;
}

.circle {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #ccc;
    margin: auto;
}

.active-orange { background: #ff8800; }
.active-blue { background: #0d6efd; }
.active-green { background: #198754; }

/* INFO */
.info-box {
    padding: 15px;
    border-radius: 10px;
}

.info-box.success { background: #e8f8f0; }
.info-box.danger { background: #fdecea; }

/* BUTTON */
.btn-refresh {
    background: #d4a017;
    color: #0d4d2c;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
}

.btn-back {
    background: #6c757d;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
}

/* MOBILE */
@media (max-width: 576px) {
    .data-grid {
        grid-template-columns: 1fr;
    }

    .info-top {
        flex-direction: column;
    }
}

.btn-riwayat {
    background: #0d6efd;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
}
</style>

@endsection