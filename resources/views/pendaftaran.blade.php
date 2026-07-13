@extends('layouts.main')

@section('content')

<!-- HERO SECTION -->
<section class="hero-pendaftaran d-flex align-items-center">
    <div class="container text-center text-white">
        <h1 class="fw-bold">Layanan Surat Menyurat</h1>
        <p>Silakan pilih jenis surat yang ingin Anda ajukan</p>

        <a href="{{ url('/') }}" class="btn-kembali mt-3">
            ← Kembali ke Beranda
        </a>
    </div>
</section>

<!-- LIST LAYANAN -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="row g-3">

            @php
                $data = [
                    ['kode'=>'SKD','judul'=>'Surat Keterangan Domisili','desc'=>'Surat keterangan bahwa seseorang bertempat tinggal di wilayah desa.','link'=>'/domisili','data'=>'Tujuan Penggunaan'],
                    ['kode'=>'SKU','judul'=>'Surat Keterangan Usaha','desc'=>'Surat keterangan bahwa seseorang memiliki usaha.','link'=>'/usaha','data'=>'Nama Usaha'],
                    ['kode'=>'SKTM','judul'=>'Surat Keterangan Tidak Mampu','desc'=>'Surat keterangan untuk bantuan atau keringanan biaya.','link'=>route('tidak-mampu.form'),'data'=>'Pekerjaan & Penghasilan'],
                    ['kode'=>'SKL','judul'=>'Surat Keterangan Kelahiran','desc'=>'Surat keterangan pencatatan kelahiran anak.','link'=>route('kelahiran.form'),'data'=>'Nama Bayi & Tanggal Lahir'],
                ];
            @endphp

            

            @foreach($data as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="surat-card">
                    <div class="surat-header">
                        <span class="kode">{{ $item['kode'] }}</span>
                        <h6 class="mt-2">━━━━━━━━━━</h6>
                        <h6 class="judul">{{ $item['judul'] }}</h6>
                    </div>

                    <div class="surat-body">
                        <p class="desc">{{ $item['desc'] }}</p>

                        <h6 class="label">📌 Dokumen</h6>
                        <ul class="list">
                            <li>KTP</li>
                            <li>KK</li>
                            <li>Surat Pengantar RT Atau RW</li>
                        </ul>

                        <h6 class="label">📝 Data</h6>
                        <p class="data">{{ $item['data'] }}</p>

                        <a href="{{ $item['link'] }}" class="btn-ajukan">
                            Ajukan
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section>



<style>

/* HERO */
.hero-pendaftaran {
    height: 60vh;
    background: linear-gradient(rgba(13,77,44,0.5), rgba(13,77,44,0.5)),
                url('{{ asset("images/gambar6.png") }}');
    background-size: cover;
    background-position: center;
}

/* BUTTON */
.btn-kembali {
    display: inline-block;
    background: #f4c430;
    color: #0d4d2c;
    padding: 10px 25px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
}

/* CARD */
.surat-card {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: 0.3s;

    display: flex;
    flex-direction: column;
    height: 100%;
}

.surat-card:hover {
    transform: translateY(-5px);
}

/* HEADER */
.surat-header {
    background: linear-gradient(135deg, #0d4d2c, #1b7a46);
    color: white;
    padding: 16px;
    min-height: 90px;
}

/* BADGE */
.kode {
    background: #f4c430;
    color: #0d4d2c;
    padding: 4px 10px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 12px;
}

/* BODY */
.surat-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* TEXT CONTROL */
.desc {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* BUTTON */
.btn-ajukan {
    display: block;
    text-align: center;
    background: linear-gradient(135deg, #0d4d2c, #1b7a46);
    color: white;
    padding: 9px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    margin-top: auto;
}

/* ================= RESPONSIVE ================= */

/* HP kecil (biar lega, ini kunci!) */
@media (max-width: 400px) {
    .col-12 {
        width: 100%;
    }
}

/* HP */
@media (max-width: 576px) {

    .hero-pendaftaran {
        height: 45vh;
    }

    .hero-pendaftaran h1 {
        font-size: 22px;
    }

    .hero-pendaftaran p {
        font-size: 13px;
    }

    .judul {
        font-size: 14px;
    }

    .desc,
    .label,
    .list li,
    .data {
        font-size: 13px;
    }
}

/* TABLET */
@media (min-width: 577px) and (max-width: 991px) {
    .hero-pendaftaran {
        height: 50vh;
    }
}

/* DESKTOP */
@media (min-width: 992px) {
    .hero-pendaftaran {
        background-attachment: fixed;
    }
}


/* ================= NAVIGASI BAWAH HP ================= */
.bottom-nav {
    position: fixed;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);

    width: 90%;
    max-width: 400px;

    background: #ffffff;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);

    display: flex;
    justify-content: space-around;
    align-items: center;

    padding: 10px;
    z-index: 999;
}

/* ITEM */
.bottom-nav .nav-item {
    text-decoration: none;
    color: #2F5D50;
    font-size: 12px;
    text-align: center;
    font-weight: 600;

    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ICON */
.bottom-nav .nav-item i {
    font-size: 20px;
    margin-bottom: 3px;

    background: rgba(13,77,44,0.1);
    padding: 8px;
    border-radius: 50%;
}

/* KHUSUS TOMBOL KEMBALI */
.bottom-nav .kembali i {
    background: #f4c430;
    color: #0d4d2c;
}

/* BIAR KONTEN GAK KETUTUP */
@media (max-width: 768px) {
    body {
        padding-bottom: 70px;
    }
}

</style>

@endsection