<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

@php
    $paper = strtolower($surat->paper_size ?? 'a4');

    if ($paper === 'f4') {
        $paperSize = '210mm 330mm';
    } else {
        $paperSize = '210mm 297mm'; // A4 FIX (lebih aman dari "A4")
    }
@endphp

    <style>
        @page {
            size: {{ $paperSize }};
            margin: 2cm 2.5cm;
        }

        body {
            font-family: "Times New Roman";
            font-size: 12pt;
            line-height: 1.4;
        }

        /* ===== KOP ===== */
        .kop-table {
            width: 100%;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .logo {
            width: 90px;
        }

        .logo img {
            width: 80px;
        }

        .kop-text {
            text-align: center;
        }

        .garis {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            margin: 5px 0;
        }

        /* ===== JUDUL ===== */
        .judul {
            text-align: center;
            margin-top: 5px;
        }

        .nomor {
            text-align: center;
            margin-top: 3px;
        }

        /* ===== DATA ===== */
        table.data {
            width: 100%;
        }

        table.data td {
            padding: 2px 0;
        }

        /* ===== PARAGRAF ===== */
        p {
            text-align: justify;
            margin: 5px 0;
        }

        /* ===== TTD ===== */
        .ttd {
            margin-top: 40px;
        }

        .kanan {
            width: 260px;
            float: right;
            text-align: center;
        }

        .nama {
            font-weight: bold;
            text-decoration: underline;
            white-space: nowrap;
            text-transform: uppercase;
        }

        /* ===== CEGAH POTONG HALAMAN ===== */
        table, tr, td, p, div {
            page-break-inside: avoid;
        }

        .pembuka {
    text-align: justify;
    text-indent: 60px; /* 🔥 ini yang bikin masuk ke kanan */
}

.data-wrapper {
    margin-left: 60px; /* 🔥 geser ke kanan */
}

.label {
    width: 220px; /* 🔥 panjang kiri */
}

.titik {
    width: 10px;
}

table.data td {
    padding: 3px 0;
    vertical-align: top;
}

.isi {
    text-align: justify;
    text-indent: 60px;
    margin: 8px 0;
    width: 85%;
    line-height: 1.8; /* 🔥 ini yang bikin renggang */
}
    </style>
</head>

<body>

@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;

    function fix($text) {
        return Str::title(strtolower($text));
    }
@endphp

<!-- KOP -->
<table class="kop-table">
    <tr>
        <td class="logo">
            <img src="{{ public_path('images/logo_lurah1.png') }}">
        </td>
        <td class="kop-text">
            <div>PEMERINTAH KABUPATEN OGAN KOMERING ULU</div>
            <div>KECAMATAN BATURAJA TIMUR</div>
            <div><b>KELURAHAN SEKARJAYA</b></div>
            <div>Alamat : Komplek Perumahan RSS Sriwijaya Baturaja Timur 32112</div>
        </td>
    </tr>
</table>

<div class="garis"></div>

<!-- JUDUL -->
<div class="judul">
    <b><u>SURAT KETERANGAN DOMISILI</u></b>
</div>

<div class="nomor">
    Nomor : {{ $surat->nomor_surat ?? '___' }}
</div>

<br>

<p class="pembuka">
    Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu 
    menerangkan bahwa :
</p>

<!-- DATA -->
<div class="data-wrapper">
<table class="data">
    <tr>
        <td class="label">Nama</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->nama) }}</td>
    </tr>
    <tr>
        <td class="label">Bin / Binti</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->bin_binti) }}</td>
    </tr>
    <tr>
        <td class="label">NIK</td>
        <td class="titik">:</td>
        <td>{{ $surat->nik }}</td>
    </tr>
    <tr>
        <td class="label">Tempat/Tgl. Lahir</td>
        <td class="titik">:</td>
        <td>
            {{ fix($surat->tempat_lahir) }},
            {{ $surat->tanggal_lahir 
                ? Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') 
                : '-' 
            }}
        </td>
    </tr>
    <tr>
        <td class="label">Jenis Kelamin</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->jenis_kelamin) }}</td>
    </tr>
    <tr>
        <td class="label">Agama</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->agama) }}</td>
    </tr>
    <tr>
        <td class="label">Status</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->status) }}</td>
    </tr>
    <tr>
        <td class="label">Kewarganegaraan</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->kewarganegaraan) }}</td>
    </tr>
    <tr>
        <td class="label">Pekerjaan</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->pekerjaan) }}</td>
    </tr>
    <tr>
        <td class="label">Alamat</td>
        <td class="titik">:</td>
        <td>{{ fix($surat->alamat) }}</td>
    </tr>
</table>
</div>

<br>

<p class="pembuka">
    Memang benar yang tersebut diatas Warga Kelurahan Sekarjaya Kecamatan Baturaja Timur dan berdomisili pada alamat tersebut diatas.
</p>

<p class="pembuka">
    Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan <br>
    sebagaimana mestinya.
</p>

<!-- TTD -->
<div class="ttd">
    <div class="kanan">
        <div>
            Sekarjaya,
            {{ $surat->tanggal_surat 
                ? Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') 
                : now()->translatedFormat('d F Y') 
            }}
        </div>

        <div style="margin-top:5px;">
            LURAH SEKARJAYA
        </div>

        <div style="height:110px;"></div>

        <div class="nama">
            ARNANDO YUGANTARA, S.STP., M.Si.
        </div>

        <div>
            NIP. 199209112014061001
        </div>
    </div>
</div>

</body>
</html>