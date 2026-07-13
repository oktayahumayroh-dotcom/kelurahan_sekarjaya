@extends('layouts.main')

@section('content')

<div class="container py-4">

    <h4 class="text-center fw-semibold mb-4">
        Riwayat Pengajuan Surat
    </h4>

    @if(!$data || $data->isEmpty())

        <div class="alert alert-danger text-center">
            Riwayat pengajuan tidak ditemukan
        </div>

    @else

        @foreach($data as $item)

        <div class="card card-riwayat mb-4">
            <div class="card-body">

                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <h5 class="mb-0">{{ $item->nama }}</h5>
                        <small class="text-muted">
                            {{ $item->jenis_surat ?? '-' }}
                        </small>
                    </div>

                    <span class="badge-status
                        @if($item->status_surat == 'selesai') success
                        @elseif($item->status_surat == 'ditolak') danger
                        @endif">

                        {{ ucfirst($item->status_surat) }}

                    </span>

                </div>

                <!-- INFO -->
                <div class="info-grid">

                    <div>
                        <b>NIK</b><br>
                        {{ $item->nik }}
                    </div>

                    <div>
                        <b>Tanggal Pengajuan</b><br>

                        @if($item->created_at)
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif
                    </div>

                    <div>
                        <b>Tempat Lahir</b><br>
                        {{ $item->tempat_lahir }}
                    </div>

                    <div>
                        <b>Tanggal Lahir</b><br>
                        {{ $item->tanggal_lahir }}
                    </div>

                    <div>
                        <b>Jenis Kelamin</b><br>
                        {{ $item->jenis_kelamin }}
                    </div>

                    <div class="full">
                        <b>Alamat</b><br>
                        {{ $item->alamat }}
                    </div>

                </div>

                <!-- STATUS -->
                @if($item->status_surat == 'selesai')

                    <div class="info-box success mt-4">

                        <p class="mb-1">
                            <b>Status:</b> Surat selesai diproses
                        </p>

                        @if($item->jadwal_ambil)

                            <p class="mb-1">
                                <b>Jadwal Pengambilan:</b>

                                {{ \Carbon\Carbon::parse($item->jadwal_ambil)->translatedFormat('d F Y') }}

                                @if($item->jam_ambil)
                                    - {{ \Carbon\Carbon::parse($item->jam_ambil)->format('H:i') }} WIB
                                @endif

                            </p>

                        @endif

                        <p class="mb-0">
                            <b>Catatan:</b><br>
                            {{ $item->catatan ?? '-' }}
                        </p>

                    </div>

                @elseif($item->status_surat == 'ditolak')

                    <div class="info-box danger mt-4">

                        <p class="mb-1">
                            <b>Status:</b> Pengajuan ditolak
                        </p>

                        <p class="mb-0">
                            <b>Alasan Penolakan:</b><br>
                            {{ $item->catatan ?? '-' }}
                        </p>

                    </div>

                @endif

            </div>
        </div>

        @endforeach

    @endif

    <!-- BUTTON -->
    <div class="text-center mt-4">

        <a href="/cek-status" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

    </div>

</div>

<style>

/* CARD */
.card-riwayat{
    border-radius:14px;
    border:1px solid #eee;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
}

/* BADGE */
.badge-status{
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-status.success{
    background:#e8f8f0;
    color:#198754;
}

.badge-status.danger{
    background:#fdecea;
    color:#dc3545;
}

/* GRID */
.info-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
    font-size:14px;
}

.info-grid .full{
    grid-column:span 2;
}

/* INFO BOX */
.info-box{
    padding:15px;
    border-radius:10px;
}

.info-box.success{
    background:#e8f8f0;
}

.info-box.danger{
    background:#fdecea;
}

/* BUTTON */
.btn-back{
    background:#6c757d;
    color:white;
    padding:10px 20px;
    border-radius:8px;
    text-decoration:none;
}

/* MOBILE */
@media (max-width:576px){

    .info-grid{
        grid-template-columns:1fr;
    }

}

</style>

@endsection