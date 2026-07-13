@extends('admin.layout')

@section('content')

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}'
});
</script>
@endif

<div class="container-fluid halaman-pengajuan">

    <h4 class="fw-bold mb-4">Data Pengajuan Surat</h4>

<div class="mb-3 row align-items-center">

    <!-- SET NOMOR -->


    <!-- INFO -->
    <div class="col-12 col-md">
        <small class="text-muted d-flex align-items-center gap-2">
            <i class="bi bi-info-circle"></i>
            Gunakan fitur ini untuk mengatur dan mengambil nomor surat agar tidak terjadi duplikasi
        </small>
    </div>

</div>

    <!-- SEARCH -->
    <div class="mb-3">
        <input type="text" id="searchInput" 
            class="form-control form-control-sm search-box"
            placeholder="Cari nama lalu tekan enter">
    </div>

    <!-- FILTER -->
    <div class="mb-4 d-flex flex-wrap gap-2 align-items-center filter-area">

    <span class="text-muted me-2">Filter:</span>

    <a href="?status=all&id={{ request('id') }}&jenis={{ request('jenis') }}"
       class="btn btn-sm {{ request('status') == 'all' || request('status') == null ? 'btn-dark' : 'btn-outline-dark' }}">
        Semua
    </a>

    <a href="?status=pending&id={{ request('id') }}&jenis={{ request('jenis') }}"
       class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
        Pending
    </a>

    <a href="?status=proses&id={{ request('id') }}&jenis={{ request('jenis') }}"
       class="btn btn-sm {{ request('status') == 'proses' ? 'btn-primary' : 'btn-outline-primary' }}">
        Proses
    </a>

    <a href="?status=selesai&id={{ request('id') }}&jenis={{ request('jenis') }}"
       class="btn btn-sm {{ request('status') == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">
        Selesai
    </a>

</div>

    <div class="row g-4">

       @forelse($data as $item)

<div class="col-12 col-md-6 col-lg-4">
    <div class="card pengajuan-card h-100">

        <div class="card-body d-flex flex-column">

            <!-- HEADER -->
            <div class="d-flex justify-content-between mb-3">

                <div>
                    <span class="badge bg-secondary mb-2">
                        {{ $item->jenis_surat }}
                    </span>

                    <h5 class="fw-semibold mb-1">{{ $item->nama }}</h5>

                    <small class="text-muted d-block">
                        NIK: {{ $item->nik }}
                    </small>

                    <!-- ✅ TANGGAL PENGAJUAN (BARU) -->
                    <small class="text-muted d-flex align-items-center gap-1 mt-1">
                        <i class="bi bi-calendar-event"></i>
                        <span>
                            Tanggal Pengajuan:
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                        </span>
                    </small>
                </div>

                <!-- STATUS -->
                <div>
                    @if($item->status_surat == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($item->status_surat == 'proses')
                        <span class="badge bg-primary">Proses</span>
                    @elseif($item->status_surat == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @elseif($item->status_surat == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </div>

            </div>

            <!-- ACTION -->
            <div class="mt-auto">

                @if($item->status_surat == 'pending')
                <div class="row g-2">
                    <div class="col-6">
                        <button type="button"
                            onclick="konfirmasiProses({{ $item->id }}, '{{ $item->jenis }}')"
                            class="btn btn-primary w-100 btn-sm">
                            Proses
                        </button>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('admin.hapus', ['jenis'=>$item->jenis,'id'=>$item->id]) }}" method="POST" onsubmit="return konfirmasiHapus(event)">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger w-100 btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                @if($item->status_surat == 'proses')
                <div class="row g-2">
                    <div class="col-6">
                        <a href="/admin/edit/{{ $item->jenis }}/{{ $item->id }}"
                           class="btn btn-warning w-100 btn-sm">
                            Isi Data
                        </a>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('admin.hapus', ['jenis'=>$item->jenis,'id'=>$item->id]) }}" method="POST" onsubmit="return konfirmasiHapus(event)">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger w-100 btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endif

               @if($item->status_surat == 'selesai')
<div class="row g-2">

    <div class="col-6">
        <a href="{{ route('admin.pdf', ['jenis' => $item->jenis, 'id' => $item->id]) }}" 
           target="_blank"
           class="btn btn-dark w-100 btn-sm">
            Print
        </a>
    </div>

    <div class="col-6">
        <a href="{{ route('admin.generate', ['jenis' => $item->jenis, 'id' => $item->id]) }}"
           class="btn btn-success w-100 btn-sm">
            Lihat
        </a>
    </div>

    <div class="col-12">
        <form action="{{ route('admin.hapus', ['jenis'=>$item->jenis,'id'=>$item->id]) }}" method="POST" onsubmit="return konfirmasiHapus(event)">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger w-100 btn-sm">
                Hapus
            </button>
        </form>
    </div>

</div>
@endif

                @if($item->status_surat == 'ditolak')
                <form action="{{ route('admin.hapus', ['jenis'=>$item->jenis,'id'=>$item->id]) }}" method="POST" onsubmit="return konfirmasiHapus(event)">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger w-100 btn-sm">
                        Hapus
                    </button>
                </form>
                @endif

            </div>

        </div>

    </div>
</div>

@empty
<div class="col-12">
    <div class="alert alert-info text-center">
        Belum ada data pengajuan
    </div>
</div>
@endforelse

    </div>

</div>

@endsection

@section('scripts')

<style>
.halaman-pengajuan {
    background: linear-gradient(135deg, #f8fafc 25%, #eef2f7 25%, #eef2f7 50%, #f8fafc 50%, #f8fafc 75%, #eef2f7 75%);
    background-size: 40px 40px;
    min-height: 100vh;
    padding: 20px;
}

.pengajuan-card {
    border: none;
    border-radius: 16px;
    transition: 0.3s;
    background: white;
}

.pengajuan-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.search-box {
    border-radius: 10px;
}

.filter-area .btn {
    border-radius: 20px;
}

@media (max-width: 576px) {
    h4 {
        font-size: 18px;
    }

    .pengajuan-card {
        border-radius: 12px;
    }

    .btn-sm {
        font-size: 12px;
        padding: 6px;
    }
}

.swal-wide {
    width: 700px !important;
    max-width: 95% !important;
    padding: 20px !important;
}

.swal2-html-container {
    overflow: visible !important;
}

.swal2-popup {
    border-radius: 16px !important;
    padding: 20px !important;
}

.swal-ambil-container {
    text-align: center;
}

.swal-nomor-box {
    font-size: 20px;
    font-weight: bold;
    color: #198754;
    padding: 12px;
    border: 2px dashed #198754;
    border-radius: 10px;
    margin: 15px 0;
    word-break: break-word;
}

.swal-btn-ambil {
    border-radius: 10px;
    font-weight: 500;
}

@media (max-width: 576px) {
    .swal-nomor-box {
        font-size: 16px;
        padding: 10px;
    }
}

.cooldown-btn {
    opacity: 0.5;
    pointer-events: none;
    transform: scale(0.98);
}
</style>

<script>
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        window.location.href = '?search=' + this.value;
    }
});

function konfirmasiProses(id, jenis) {
    Swal.fire({
        title: 'Proses data sekarang?',
        text: 'Data akan masuk ke tahap proses',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, proses'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch('/admin/proses/' + jenis + '/' + id, {
                method: 'POST',
headers: {
    "Content-Type": "application/json",
    "X-CSRF-TOKEN": "{{ csrf_token() }}"
},
            })
            .then(() => {

                Swal.fire({
                    title: 'Berhasil diproses',
                    text: 'Lanjut isi data sekarang?',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Isi Data',
                    cancelButtonText: 'Nanti'
                }).then((res) => {
                    if (res.isConfirmed) {
                        window.location.href = '/admin/edit/' + jenis + '/' + id;
                    } else {
                        location.reload();
                    }
                });

            });

        }

    });
}

function konfirmasiHapus(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Hapus data?',
        text: 'Data akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });

    return false;
}

function setNomorAwal() {

    fetch('/admin/cek-nomor')
    .then(res => res.json())
    .then(data => {

        Swal.fire({
            title: 'Pengaturan Nomor Surat',

            width: 'auto',
            maxWidth: 600,

            html: `
                <div class="text-start">

                    <div style="
                        background:#f8f9fa;
                        padding:12px;
                        border-radius:8px;
                        font-size:13px;
                        margin-bottom:15px;
                    ">
                        <b>Petunjuk:</b><br>
                        Nomor ini adalah nomor terakhir yang sudah dipakai.<br>
                        Kamu bisa edit manual kalau perlu koreksi.
                    </div>

                    <div class="row g-2">

                        <div class="col-12">
                            <label class="form-label">Nomor Terakhir Surat (GLOBAL)</label>
                            <input id="nomor_terakhir" type="number"
                                class="form-control"
                                value="${data.nomor_terakhir ?? 0}">
                        </div>

                    </div>

                    <hr class="my-3">

                    <div class="row g-2">

                        <div class="col-12 col-sm-6">
                            <button type="button" onclick="cekNomor()" class="btn btn-info w-100">
                                Cek Nomor
                            </button>
                        </div>

                        <div class="col-12 col-sm-6">
                            <button type="button" onclick="resetNomor()" class="btn btn-danger w-100">
                                Reset
                            </button>
                        </div>

                    </div>

                </div>
            `,

            confirmButtonText: 'Simpan',
            showCancelButton: true,
            cancelButtonText: 'Batal',

            preConfirm: () => {
                return {
                    nomor_terakhir: parseInt(document.getElementById('nomor_terakhir').value || 0)
                }
            }

        }).then((result) => {

            if (result.isConfirmed) {

                fetch("/admin/set-nomor-awal", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result.value)
                })
                .then(res => res.json())
                .then(() => {
                    Swal.fire('Berhasil', 'Nomor berhasil diupdate', 'success');
                })
                .catch(() => {
                    Swal.fire('Error', 'Gagal simpan nomor', 'error');
                });

            }

        });

    });
}


// ================= CEK NOMOR (GLOBAL) =================
function cekNomor() {
    fetch('/admin/cek-nomor')
    .then(res => res.json())
    .then(data => {

        Swal.fire({
            title: 'Nomor Terakhir',

            width: 'auto',
            maxWidth: 400,

            html: `
                <div class="text-center">

                    <div style="padding:20px;border:1px solid #ddd;border-radius:10px;">
                        <div style="font-size:14px;color:#666;">Nomor terakhir</div>
                        <div style="font-size:34px;font-weight:bold;color:#198754;">
                            ${String(data.nomor_terakhir ?? 0).padStart(3,'0')}
                        </div>
                    </div>

                    <p style="margin-top:10px;font-size:12px;color:#888;">
                        Nomor ini akan dipakai untuk surat berikutnya
                    </p>

                </div>
            `,
            confirmButtonText: 'OK'
        });

    });
}


// ================= RESET =================
function resetNomor() {
    Swal.fire({
        title: 'Reset Nomor?',
        text: 'Semua nomor akan kembali ke 0',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Reset'
    }).then((res) => {

        if (res.isConfirmed) {

            fetch('/admin/reset-nomor', {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(res => res.json())
            .then(() => {
                Swal.fire('Berhasil', 'Nomor sudah direset', 'success');
            })
            .catch(() => {
                Swal.fire('Gagal', 'Reset error', 'error');
            });

        }

    });
}

let cooldownNomor = false;

function bukaAmbilNomor() {

    Swal.fire({
        title: '<i class="bi bi-hash"></i> Ambil Nomor Surat',
        width: 420,
        html: `
            <div class="swal-ambil-container">

                <p style="font-size:14px;color:#666;margin-bottom:10px;">
                    Gunakan tombol di bawah untuk mengambil nomor surat otomatis.
                </p>

                <div id="hasilNomor" class="swal-nomor-box">
                    -
                </div>

                <button id="btnAmbilNomor" class="btn btn-success swal-btn-ambil w-100">
                    Ambil Nomor
                </button>

                <small id="timerNomor" style="color:#dc3545;display:block;margin-top:8px;"></small>

            </div>
        `,
        showConfirmButton: false,
        didOpen: () => {
            document
                .getElementById('btnAmbilNomor')
                .addEventListener('click', ambilNomorManual);
        }
    });

}

function ambilNomorManual() {

    if (cooldownNomor) return;

    let popup = Swal.getPopup();

    let btn = popup.querySelector('#btnAmbilNomor');
    let timer = popup.querySelector('#timerNomor');
    let hasil = popup.querySelector('#hasilNomor');
    let hint = popup.querySelector('#hintNomor');

    // 🔥 KONFIRMASI INLINE (DALAM POPUP YANG SAMA)
    if (btn.dataset.confirm !== 'yes') {
        btn.dataset.confirm = 'yes';
        btn.innerText = 'Klik lagi untuk konfirmasi';
        btn.classList.remove('btn-success');
        btn.classList.add('btn-warning');

        if (hint) {
            hint.innerText = 'Klik sekali lagi untuk mengambil nomor';
        }

        return;
    }

    // =============================
    // 🔥 PROSES ASLI
    // =============================
    btn.disabled = true;
    btn.classList.add('cooldown-btn');
    btn.innerText = 'Memproses...';

    if (hint) {
        hint.innerText = 'Silakan salin nomor di bawah';
    }

    fetch('/admin/ambil-nomor', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    })
    .then(res => res.json())
    .then(data => {

        let nomor = data.nomor_format;

        if (!nomor) {
            hasil.innerText = 'Gagal ambil nomor';
            btn.disabled = false;
            btn.innerText = 'Ambil Nomor';
            return;
        }

        // ✅ tampilkan
        hasil.innerText = nomor;

        // ✅ copy
        navigator.clipboard.writeText(nomor);

        let footer = Swal.getFooter();
        if (footer) {
            footer.innerHTML = '<span style="color:#198754;font-size:12px;">Nomor otomatis disalin</span>';
        }

    })
    .catch(() => {
        hasil.innerText = 'Terjadi error';
        btn.disabled = false;
        btn.innerText = 'Ambil Nomor';
    });

    // 🔒 COOLDOWN
    cooldownNomor = true;
    let time = 10;

    let interval = setInterval(() => {

        timer.innerText = "Tunggu " + time + " detik...";
        time--;

        if (time < 0) {
            clearInterval(interval);
            cooldownNomor = false;

            btn.disabled = false;
            btn.innerText = 'Ambil Nomor';
            btn.dataset.confirm = ''; // reset konfirmasi
            btn.classList.remove('btn-warning');
            btn.classList.add('btn-success');

            timer.innerText = '';

            if (hint) {
                hint.innerText = 'Gunakan tombol di bawah untuk mengambil nomor surat otomatis.';
            }
        }

    }, 1000);
}
</script>

@endsection