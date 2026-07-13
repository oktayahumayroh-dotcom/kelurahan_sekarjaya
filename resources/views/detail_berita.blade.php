@extends('layouts.main')

@section('content')

<style>
.hero-berita {
    position: relative;
    height: 450px;
    overflow: hidden;
}

.hero-berita img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
}

.content-berita {
    font-size: 17px;
    line-height: 1.9;
    text-align: justify;
}

.berita-slider {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding-bottom: 10px;
}

.berita-slider::-webkit-scrollbar {
    height: 6px;
}

.berita-slider::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.card-berita {
    min-width: 250px;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s;
}

.card-berita:hover {
    transform: translateY(-5px);
}

.card-berita img {
    height: 150px;
    object-fit: cover;
}
</style>

<!-- 🔥 HERO -->
<div class="hero-berita">
    @if($berita->gambar)
     <img src="{{ asset($berita->gambar) }}">
    @endif

    <div class="hero-overlay">
        <h2 class="fw-bold">{{ $berita->judul }}</h2>
        <small>
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::parse($berita->tanggal_upload)->format('d M Y') }}
        </small>
    </div>
</div>

<!-- 🔥 CONTENT -->
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="content-berita">
                {{ $berita->isi }}
            </div>

            <div class="mt-4">
                <a href="/" class="btn btn-outline-success">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>

    <!-- 🔥 BERITA LAIN -->
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Berita Lainnya</h4>

        <div class="berita-slider">

            @foreach($berita_lain as $item)
            <div class="card card-berita shadow-sm">

@if($item->gambar)
    <img src="{{ asset($item->gambar) }}">
@endif

                <div class="card-body">
                    <h6 class="fw-bold">
                        {{ Str::limit($item->judul, 50) }}
                    </h6>

                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d M Y') }}
                    </small>

                    <div class="mt-2">
                        <a href="/berita/{{ $item->slug }}" class="btn btn-sm btn-success">
                            Baca
                        </a>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
    </div>

</div>

@endsection