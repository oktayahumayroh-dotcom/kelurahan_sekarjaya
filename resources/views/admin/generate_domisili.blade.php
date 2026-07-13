@extends('admin.layout')

@section('content')

<h4 class="mb-3">Generate Surat</h4>

<form action="{{ route('admin.final', ['jenis' => $surat->jenis ?? 'domisili', 'id' => $surat->id]) }}" method="POST">
@csrf

<!-- DATA PEMOHON -->
<div class="card mb-3 p-3 shadow-sm">
    <h5>Data Pemohon</h5>
    <p><b>Nama:</b> {{ $surat->nama }}</p>
    <p><b>NIK:</b> {{ $surat->nik }}</p>
    <p><b>TTL:</b> {{ $surat->tempat_lahir }}, {{ $surat->tanggal_lahir }}</p>
    <p><b>Jenis Kelamin:</b> {{ $surat->jenis_kelamin }}</p>
    <p><b>Alamat:</b> {{ $surat->alamat }}</p>
</div>

<!-- AREA PRINT -->
<div id="printArea">
<div class="surat">

    <!-- KOP -->
    <div class="kop">
        <div class="logo">
            <img src="{{ asset('images/logo_lurah1.png') }}">
        </div>

        <div class="kop-text">
            <div class="f14">PEMERINTAH KABUPATEN OGAN KOMERING ULU</div>
            <div class="f14">KECAMATAN BATURAJA TIMUR</div>
            <div class="f20"><b>KELURAHAN SEKARJAYA</b></div>
            <div class="f12">Alamat : Komplek Perumahan RSS Sriwijaya Baturaja Timur 32112</div>
        </div>
    </div>

    <div class="garis"></div>

    <!-- JUDUL -->
    <div class="judul">
        <div class="f16"><b><u>SURAT KETERANGAN DOMISILI</u></b></div>
        <div class="f14 nomor">
            Nomor : {{ $surat->nomor_surat ?? '___' }} 
        </div>
    </div>

    <br>

    <p class="f12" style="text-align: justify;">
        Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu
        menerangkan bahwa :
    </p>

    <!-- DATA -->
    <table class="f12 data">
        <tr><td width="220">Nama</td><td>:</td><td>{{ $surat->nama }}</td></tr>
        <tr><td>Bin / Binti</td><td>:</td><td>{{ $surat->bin_binti }}</td></tr>
        <tr><td>NIK</td><td>:</td><td>{{ $surat->nik }}</td></tr>
        <tr>
    <td>Tempat/Tgl. Lahir</td>
    <td>:</td>
    <td>
        {{ $surat->tempat_lahir }}, 
        {{ $surat->tanggal_lahir 
            ? \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') 
            : '-' }}
    </td>
</tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
        <tr><td>Status</td><td>:</td><td>{{ $surat->status }}</td></tr>
        <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->kewarganegaraan }}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat }}</td></tr>
    </table>

    <br>

    <p class="f12" style="text-align: justify;">
        Memang benar yang tersebut diatas Warga Kelurahan Sekarjaya Kecamatan
        Baturaja Timur dan berdomisili pada alamat tersebut diatas.
    </p>

    <p class="f12" style="text-align: justify;">
        Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan
        sebagaimana mestinya.
    </p>

    <!-- TTD -->
    <div class="ttd">
        <div class="kanan">
            Sekarjaya, 
{{ $surat->tanggal_surat 
    ? \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') 
    : now()->translatedFormat('d F Y') }} <br>
            LURAH SEKARJAYA,
            <br><br><br><br>

            <b class="nama">ARNANDO YUGANTARA, S.STP., M.Si.</b><br>
            NIP. 199209112014061001
        </div>
    </div>

</div>
</div>

<div style="clear: both;"></div>

<!-- JADWAL -->
<div class="mt-5">
    <label>Jadwal Ambil</label>
    <input type="date" name="jadwal_ambil"
        class="form-control @error('jadwal_ambil') is-invalid @enderror"
        value="{{ old('jadwal_ambil') }}" required>

    @error('jadwal_ambil')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Pengaturan Jam Ambil</label>

    <div class="row g-2">

        <!-- JAM KERJA -->
        <div class="col-6">
            <label class="card p-3 border pilihan-jam">
                <input type="radio" name="mode_jam" value="kerja"
                    class="form-check-input me-2"
                    {{ empty($surat->jam_ambil) ? 'checked' : '' }}>
                
                <div>
                    <b>Jam Kerja</b><br>
                    <small class="text-muted">08:00 - 14:00</small>
                </div>
            </label>
        </div>

        <!-- CUSTOM -->
        <div class="col-6">
            <label class="card p-3 border pilihan-jam">
                <input type="radio" name="mode_jam" value="custom"
                    class="form-check-input me-2"
                    {{ !empty($surat->jam_ambil) ? 'checked' : '' }}>
                
                <div>
                    <b>Atur Sendiri</b><br>
                    <small class="text-muted">Tentukan jam</small>
                </div>
            </label>
        </div>

    </div>
</div>

<!-- INPUT JAM -->
<div class="mb-3" id="inputJam">
    <label class="form-label">Jam Ambil</label>
    <input type="time" name="jam_ambil"
    class="form-control @error('jam_ambil') is-invalid @enderror"
    min="08:00" max="14:00"
    value="{{ old('jam_ambil', $surat->jam_ambil ?? '') }}">

@error('jam_ambil')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<!-- TEMPLATE -->
<div class="mt-3">
    <label>Pilih Template</label>
    <select id="template" class="form-control">
        <option value="">-- Pilih Template --</option>
        <option value="Silakan datang ke kantor kelurahan untuk mengambil surat dengan membawa KTP,KK Dan Surat Pengantar RT/RW">
            Ambil + Bawa KTP, KK Dan surat pengantar RT/RW
        </option>
        <option value="Harap membawa fotocopy KTP, KK, dan surat pengantar RT/RW.">
            Bawa Berkas Lengkap
        </option>
    </select>
</div>


<!-- CATATAN -->
<div class="mt-3">
    <label>Catatan Admin</label>
    <textarea name="catatan" id="catatan"
    class="form-control @error('catatan') is-invalid @enderror"
    rows="3" required>{{ old('catatan') }}</textarea>

@error('catatan')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<!-- PAPER SIZE -->
<div class="mt-3">
    <label class="form-label fw-bold">Ukuran Kertas</label>

    <select name="paper_size" class="form-control">
        <option value="A4" {{ $surat->paper_size == 'A4' ? 'selected' : '' }}>A4</option>
        <option value="F4" {{ $surat->paper_size == 'F4' ? 'selected' : '' }}>F4</option>
        <option value="FOLIO" {{ $surat->paper_size == 'FOLIO' ? 'selected' : '' }}>Folio</option>
    </select>
</div>

<!-- BUTTON -->
<div class="mt-4 d-flex justify-content-between align-items-center">

    <!-- KIRI -->
    <div>
        <a href="{{ route('admin.edit', ['jenis' => 'domisili', 'id' => $surat->id]) }}" 
           class="btn btn-secondary">
           ← Kembali
        </a>
    </div>

    <!-- KANAN -->
    <div class="d-flex gap-2">

        <a href="/admin/pdf/{{ $surat->jenis ?? 'domisili' }}/{{ $surat->id }}" 
           target="_blank" 
           class="btn btn-outline-success">
           Print PDF
        </a>

        <button type="button" 
                onclick="konfirmasiSelesai()" 
                class="btn btn-success">
            Simpan & Selesai
        </button>

    </div>

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <b>Ups! Ada yang belum diisi:</b>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</form>



@endsection

@section('scripts')

<style>
.f20 { font-size:20px; }
.f16 { font-size:16px; }
.f14 { font-size:14px; }
.f12 { font-size:12px; }

.surat {
    font-family: "Times New Roman";
}

.kop {
    display: flex;
    align-items: center;
}

.logo img {
    width: 80px;
}

.kop-text {
    flex: 1;
    text-align: center;
}

.garis {
    border-top: 3px solid black;
    border-bottom: 1px solid black;
    margin: 5px 0;
}

.judul {
    text-align: center;
}

.nomor {
    text-align: center;
    margin-top: 5px;
}

.data td {
    padding: 2px 0;
}

.ttd {
    margin-top: 60px;
    page-break-inside: avoid;
}

.kanan {
    width: 300px;
    float: right;
    text-align: center;
    page-break-inside: avoid;
}

.nama {
    margin-top: 70px;
    display: inline-block;
    text-decoration: underline;
}

.pilihan-jam {
    cursor: pointer;
    transition: 0.2s;
}

.pilihan-jam:hover {
    background: #f8f9fa;
}

.pilihan-jam input:checked + div {
    color: #198754;
    font-weight: bold;
}
</style>

<script>

// AUTO TEMPLATE
document.getElementById('template').addEventListener('change', function() {
    document.getElementById('catatan').value = this.value;
});

function printSurat() {
    var isi = document.getElementById('printArea').innerHTML;

    var win = window.open('', '', 'width=900,height=700');

    win.document.write(`
    <html>
    <head>
        <style>
            @page {
                size: A4;
                margin: 2cm 2.5cm;
            }

            body {
                font-family: "Times New Roman";
                font-size: 12pt;
                line-height: 1.5;
            }

            .kop { display:flex; align-items:center; }
            .kop img { width:90px; }
            .kop-text { flex:1; text-align:center; }

            .garis {
                border-top: 3px solid black;
                border-bottom: 1px solid black;
                margin: 5px 0;
            }

            .judul, .nomor {
                text-align:center;
            }

            table { width:100%; }
            td { padding:3px 0; }

            .ttd { margin-top:60px; page-break-inside:avoid; }
            .kanan { float:right; width:300px; text-align:center; }

            table, tr, td {
                page-break-inside: avoid;
            }
        </style>
    </head>
    <body>${isi}</body>
    </html>
    `);

    win.document.close();
    win.print();
}


function konfirmasiSelesai() {
    Swal.fire({
        title: 'Selesaikan Proses?',
        text: "Data akan disimpan dan surat akan selesai!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1b7a46',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Selesai!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('form').submit();
        }
    });
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll('input[name="mode_jam"]');
    const inputJam = document.getElementById('inputJam');
    const jamInput = document.querySelector('input[name="jam_ambil"]');

    function toggleJam() {
        const selected = document.querySelector('input[name="mode_jam"]:checked').value;

        if (selected === 'custom') {
            inputJam.style.display = 'block';
        } else {
            inputJam.style.display = 'none';
            jamInput.value = '';
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', toggleJam);
    });

    toggleJam(); // auto jalan saat load

});
</script>

@endsection