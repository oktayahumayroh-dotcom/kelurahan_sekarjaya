<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: A4;
            margin: 2cm 2.5cm;
        }

        body {
            font-family: "Times New Roman";
            font-size: 12pt;
            line-height: 1.3; /* 🔥 sedikit dipadatkan lagi */
        }

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

        .kop-text div {
            margin: 1px 0; /* 🔥 dipadatkan */
        }

        .garis {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            margin: 3px 0; /* 🔥 diperkecil */
        }

        .judul {
            text-align: center;
            margin-top: 4px;
        }

        .nomor {
            text-align: center;
            margin-top: 2px;
        }

        table.data {
            width: 100%;
        }

        table.data td {
            padding: 2px 0;
        }

        p {
            text-align: justify;
            margin: 3px 0; /* 🔥 dipadatkan */
        }

        /* 🔥 INI KUNCI NYA */
.ttd {
    margin-top: 100px; /* 🔥 naikkan dari 45 → 70 */
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
        }

        table, tr, td, p, div {
            page-break-inside: avoid;
        }

        .pembuka {
    text-align: justify;
    text-indent: 40px;
    width: 100%;
}

.data-wrapper {
    margin-left: 60px; /* 🔥 geser ke kanan */
}

.label {
    width: 220px; /* 🔥 panjang kiri */
    vertical-align: top;
}

.titik {
    width: 10px;
}

table.data td {
    padding: 3px 0;
}


    </style>
</head>
<body>

<!-- ===== KOP ===== -->
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

<!-- ===== JUDUL ===== -->
<div class="judul">
    <b><u>SURAT KETERANGAN USAHA</u></b>
</div>

<div class="nomor">
    Nomor : {{ $surat->nomor_surat ?? '___' }}
</div>

<br>

<p class="pembuka">
    Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu menerangkan bahwa :
</p>

<!-- ===== DATA ===== -->
<div class="data-wrapper">
<table class="data">
    <tr>
        <td class="label">Nama</td>
        <td class="titik">:</td>
        <td>{{ mb_convert_case($surat->nama, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td class="label">Tempat/Tgl. Lahir</td>
        <td class="titik">:</td>
        <td>
            {{ mb_convert_case($surat->tempat_lahir, MB_CASE_TITLE, "UTF-8") }}, 
            {{ $surat->tanggal_lahir 
                ? \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') 
                : '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">Jenis Kelamin</td>
        <td class="titik">:</td>
        <td>{{ $surat->jenis_kelamin }}</td>
    </tr>

    <tr>
        <td class="label">Agama</td>
        <td class="titik">:</td>
        <td>{{ ucfirst(strtolower($surat->agama)) }}</td>
    </tr>

    <tr>
        <td class="label">Status</td>
        <td class="titik">:</td>
        <td>{{ ucfirst(strtolower($surat->status)) }}</td>
    </tr>

    <tr>
        <td class="label">Kewarganegaraan</td>
        <td class="titik">:</td>
        <td>{{ strtoupper($surat->kewarganegaraan) }}</td>
    </tr>

    <tr>
        <td class="label">Pekerjaan</td>
        <td class="titik">:</td>
        <td>{{ mb_convert_case($surat->pekerjaan, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td class="label">Alamat</td>
        <td class="titik">:</td>
        <td>{{ mb_convert_case($surat->alamat, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>
</table>
</div>
<br>

<p>
    Benar yang bersangkutan mempunyai usaha :
</p>

<div class="data-wrapper">
<table class="data">
    <tr>
        <td class="label">Jenis Usaha</td>
        <td class="titik">:</td>
        <td>{{ mb_convert_case($surat->jenis_usaha, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td class="label">Tempat</td>
        <td class="titik">:</td>
        <td>{{ mb_convert_case($surat->tempat_usaha, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>
</table>
</div>

<br>

<p class="pembuka">
    Demikian surat keterangan usaha ini, dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>

<!-- ===== TTD ===== -->
<div class="ttd">
    <div class="kanan">

        <div>Dikeluarkan di Sekarjaya</div>

        <div>
            Pada Tanggal :
            {{ $surat->tanggal_surat 
                ? \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') 
                : now()->translatedFormat('d F Y') }}
        </div>

        <div style="margin-top:5px;">
            LURAH SEKARJAYA
        </div>

        <div style="height:90px;"></div> <!-- 🔥 pas banget -->

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