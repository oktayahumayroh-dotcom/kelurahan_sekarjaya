@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h4 class="text-center fw-semibold mb-4">Hasil Status Pengaduan</h4>

    @if(!$data || $data->isEmpty())
        <div class="alert alert-danger text-center">
            Data tidak ditemukan
        </div>
    @else

    @php \Carbon\Carbon::setLocale('id'); @endphp

    @foreach($data as $item)

    <div class="card card-status mb-4">

        <div class="card-body">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                <h5 class="mb-0">
                    Pengaduan {{ $item->jenis_pengaduan }}
                </h5>

                <span class="badge-status
                    @if($item->status == 'pending') warning
                    @elseif($item->status == 'proses') primary
                    @elseif($item->status == 'ditolak') danger
                    @else success
                    @endif">

                    @if($item->status == 'pending') Pending
                    @elseif($item->status == 'proses') Diproses
                    @elseif($item->status == 'ditolak') Ditolak
                    @else Ditindaklanjuti
                    @endif

                </span>
            </div>

            <!-- DATA -->
            <div class="data-grid">
                <div><b>Nama</b><br>{{ $item->nama }}</div>

                <div>
                    <b>Tanggal Pengajuan</b><br>
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </div>

                <div class="full"><b>Lokasi</b><br>{{ $item->alamat }}</div>

                <div class="full"><b>Keterangan</b><br>{{ $item->keterangan }}</div>

                @if($item->foto)
                <div class="full">
                    <b>Foto</b><br>
                   <a href="{{ asset('pengaduan_foto/' . basename($item->foto)) }}" target="_blank" class="link-foto">
                        Lihat Foto
                    </a>
                </div>
                @endif
            </div>

            <!-- PROGRESS -->
            <div class="progress-wrapper mt-4">

                <div class="progress-base"></div>

                <div class="progress-active
                    @if($item->status == 'pending') w-0 bg-orange
                    @elseif($item->status == 'proses') w-50 bg-blue
                    @elseif($item->status == 'ditolak') w-50 bg-red
                    @else w-100 bg-green
                    @endif">
                </div>

                <!-- STEP -->
                <div class="step">
                    <div class="circle 
                        @if(in_array($item->status,['pending','proses','selesai','ditolak'])) active-orange @endif"></div>
                    <small>Pending</small>
                </div>

                <div class="step">
                    <div class="circle 
                        @if(in_array($item->status,['proses','selesai','ditolak'])) active-blue @endif"></div>
                    <small>Diproses</small>
                </div>

                <div class="step">
                    <div class="circle 
                        @if($item->status == 'selesai') active-green @endif"></div>
                    <small>Ditindaklanjuti</small>
                </div>

            </div>

            <!-- DETAIL -->
            <div class="info-box mt-4
                @if($item->status == 'ditolak') info-danger @endif">

                <p>
                    <b>
                        @if($item->status == 'ditolak')
                            Alasan Penolakan:
                        @else
                            Catatan:
                        @endif
                    </b><br>

                    {{ $item->catatan ?? '-' }}
                </p>

                @if($item->status != 'ditolak')
                <p class="mt-2"><b>Perkiraan Tindak Lanjut:</b><br>
                    @if($item->tanggal_tindak_lanjut)
                        {{ \Carbon\Carbon::parse($item->tanggal_tindak_lanjut)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif
                </p>
                @endif
            </div>

        </div>
    </div>

    @endforeach

    @endif

    <!-- BUTTON -->
    <div class="text-center mt-4">
        <button onclick="location.reload()" class="btn-refresh">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>

        <a href="cek-status-pengaduan" class="btn-back">
            <i class="bi bi-search"></i> Cek Lagi
        </a>
    </div>

</div>

<style>

/* CARD */
.card-status {
    border-radius: 16px;
    border: 1px solid #eee;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    transition: 0.3s;
    overflow: hidden;
}
.card-status:hover {
    transform: translateY(-3px);
}

/* BADGE */
.badge-status {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-status.warning { background: #fff4e5; color: #ff8800; }
.badge-status.primary { background: #e7f1ff; color: #0d6efd; }
.badge-status.success { background: #e8f8f0; color: #198754; }
.badge-status.danger { background: #ffe5e5; color: #dc3545; }

/* GRID */
.data-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    font-size: 14px;
}
.data-grid div {
    background: #fafafa;
    padding: 10px 12px;
    border-radius: 8px;
}
.data-grid .full {
    grid-column: span 2;
}

/* LINK */
.link-foto {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 500;
}
.link-foto:hover {
    text-decoration: underline;
}

/* ===================== */
/* 🔥 PROGRESS FIX FINAL */
/* ===================== */

.progress-wrapper {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

/* GARIS DASAR */
.progress-base {
    position: absolute;
    top: 13px;
    left: 0;
    width: 100%;
    height: 4px;
    background: #e5e7eb;
    border-radius: 10px;
}

/* GARIS AKTIF */
.progress-active {
    position: absolute;
    top: 13px;
    left: 0;
    height: 4px;
    border-radius: 10px;
    transition: 0.4s ease;
}

/* WIDTH FIX */
.w-0 { width: 0%; }
.w-50 { width: 50%; }
.w-100 { width: 100%; }

/* WARNA */
.bg-orange { background: #f59e0b; }
.bg-blue { background: #3b82f6; }
.bg-green { background: #22c55e; }
.bg-red { background: #ef4444; }

/* STEP */
.step {
    flex: 1;
    text-align: center;
    position: relative;
    z-index: 2;
}

/* BULATAN */
.circle {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #ccc;
    margin: auto;
    transition: 0.3s;
}

/* AKTIF */
.active-orange { background: #f59e0b; }
.active-blue { background: #3b82f6; }
.active-green { background: #22c55e; }

/* LABEL */
.step small {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #555;
}

/* INFO */
.info-box {
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fa;
}

.info-danger {
    background: #fff5f5;
    border-left: 4px solid #dc3545;
}

/* BUTTON */
.btn-refresh {
    background: linear-gradient(135deg, #ffc107, #ffda6a);
    color: #333;
    border: none;
    padding: 10px 22px;
    border-radius: 25px;
    margin-right: 8px;
    font-weight: 600;
}

.btn-back {
    background: #6c757d;
    color: white;
    padding: 10px 22px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
}

/* MOBILE */
@media (max-width: 576px) {
    .data-grid {
        grid-template-columns: 1fr;
    }

    .progress-base,
    .progress-active {
        display: none;
    }
}

</style>

@endsection