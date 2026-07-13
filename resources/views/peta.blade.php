@extends('layouts.main')

@section('content')

<section class="py-5 peta-section">
    <div class="container">

        <!-- JUDUL -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Peta Wilayah Kelurahan Sekarjaya</h2>
            <p class="text-muted">
                Informasi lokasi kantor kelurahan untuk memudahkan masyarakat
            </p>
        </div>

        <div class="row g-4">

            <!-- MAP GOOGLE -->
            <div class="col-lg-8">
                <div class="map-card">
                    <iframe 
                        src="https://maps.google.com/maps?q=-4.110152952299268,104.20282711522151&z=17&output=embed"
                        width="100%" 
                        height="450" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- INFO -->
            <div class="col-lg-4">
                <div class="info-card">

                    <h5 class="fw-bold mb-4">Informasi Lokasi</h5>

                    <div class="info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <strong>Alamat</strong>
                            <p>
                                Air Paoh, Kec. Baturaja Timur, 
                                Kab. Ogan Komering Ulu, Sumatera Selatan
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <strong>Jam Operasional</strong>
                            <p>Senin - Jumat: 08.00 - 15.00 WIB</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-telephone-fill"></i>
                        <div>
                            <strong>Kontak</strong>
                            <p>+62 812-xxxx-xxxx</p>
                        </div>
                    </div>

                    <hr style="border-color: rgba(255,255,255,0.3);">

                    <p class="deskripsi-lokasi">
                        Kelurahan Sekarjaya berlokasi di Kecamatan Baturaja Timur, Kabupaten Ogan Komering Ulu (OKU), Sumatera Selatan. 
                        Wilayah ini merupakan bagian dari ibu kota kabupaten, Baturaja, dan merupakan area administratif padat penduduk. 
                        Akses utama menuju wilayah ini mencakup Jalan Imam Bonjol yang melintasi area perumahan dan perkantoran.
                        <br><br>
                        <strong>Poin Penting:</strong><br>
                        • Posisi: Baturaja Timur, OKU<br>
                        • Akses: Jalan Imam Bonjol (RSS Sriwijaya)<br>
                        • Info: Instagram @kelurahan_sekarjaya
                    </p>

                    <!-- 🔥 TOMBOL PROFESIONAL -->
                    <div class="d-grid gap-2 mt-4">

                        <a href="https://maps.app.goo.gl/54YdMCac71k8b4V69" 
                           target="_blank" 
                           class="btn-modern btn-maps">
                            <i class="bi bi-geo-alt"></i>
                            <span>Lihat di Google Maps</span>
                        </a>

                        <a href="https://www.google.com/maps/dir/?api=1&destination=-4.110152952299268,104.20282711522151"
                           target="_blank"
                           class="btn-modern btn-route">
                            <i class="bi bi-signpost-split"></i>
                            <span>Rute ke Lokasi</span>
                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

@endsection


<style>

.peta-section {
    background: #f4f7f5;
}

.map-card {
    background: #ffffff;
    padding: 15px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.map-card iframe {
    border-radius: 15px;
}

/* INFO BOX */
.info-card {
    background: linear-gradient(135deg, #2F5D50, #3E7C6F);
    color: white;
    padding: 30px 25px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.info-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.info-item i {
    font-size: 22px;
    color: #f4c430;
}

.info-item p {
    margin: 0;
    font-size: 14px;
    color: white;
}

.deskripsi-lokasi {
    font-size: 13px;
    line-height: 1.6;
    color: white;
    opacity: 0.95;
}

/* ================= BUTTON PREMIUM ================= */

.btn-modern {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

/* tombol maps */
.btn-maps {
    background: #f4c430;
    color: #2F5D50;
}

.btn-maps:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* tombol route */
.btn-route {
    background: white;
    color: #2F5D50;
}

.btn-route:hover {
    transform: translateY(-3px);
    background: #f1f1f1;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* icon */
.btn-modern i {
    font-size: 18px;
}

</style>