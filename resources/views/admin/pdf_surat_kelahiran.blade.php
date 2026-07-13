<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4; margin: 2cm 2.5cm; }

        body {
            font-family: "Times New Roman";
            font-size: 10pt; /* 🔥 sedikit diperkecil */
            line-height: 1.3; /* 🔥 dipadatkan */
        }

        .kop-table { width: 100%; }
        .kop-table td { vertical-align: middle; }
        .logo { width: 80px; }
        .logo img { width: 70px; }

        .kop-text { text-align: center; font-size: 12pt; }
        .kop-text div { margin: 1px 0; }

        .garis {
            border-top:3px solid black;
            border-bottom:1px solid black;
            margin:3px 0;
        }

        .judul { text-align:center; margin-top:4px; }
        .nomor { text-align:center; margin-top:2px; }

        table.data { width: 100%; }
        table.data td { padding:1px 0; vertical-align: top; }

        p { text-align: justify; margin:3px 0; }

        h5 {
            margin:4px 0 1px;
            font-size:11.5pt;
        }

        .ttd {
            margin-top:40px; /* 🔥 pas banget 1 halaman */
        }

        .kanan {
            width:250px;
            float:right;
            text-align:center;
        }

        .nama {
            font-weight:bold;
            text-decoration:underline;
            white-space:nowrap;
        }

        table, tr, td, p, div {
            page-break-inside: avoid;
        }

        .pembuka {
    text-align: justify;
    text-indent: 60px;
    width: 90%; /* 🔥 biar pecahnya pas */
}

.data-wrapper {
    margin-left: 60px; /* 🔥 geser ke kanan */
}

.label {
    width: 230px; /* 🔥 bikin sejajar kayak Word */
    vertical-align: top;
}

.titik {
    width: 10px;
}

table.data td {
    padding: 3px 0;
}

.isi {
    text-align: justify;
    text-indent: 60px;
    width: 90%; /* 🔥 biar pecahnya pas */
    line-height: 1.5;
    margin: 8px 0;
}

.sub-judul {
    margin-left: 0; /* 🔥 rata kiri */
    margin-top: 10px;
    font-weight: bold;
}

.data-wrapper {
    margin-left: 60px; /* 🔥 isi ke kanan */
}
    </style>
</head>
<body>

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
<div class="judul"><b><u>SURAT KETERANGAN KELAHIRAN</u></b></div>
<div class="nomor">Nomor : {{ $surat->nomor_surat ?? '___' }}</div>

<br>

<p class="pembuka">
    Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu menerangkan bahwa :
</p>

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
        {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}
    </td>
</tr>

<tr>
    <td class="label">Jenis Kelamin</td>
    <td class="titik">:</td>
    <td>{{ $surat->jenis_kelamin }}</td>
</tr>

<tr>
    <td class="label">Bangsa</td>
    <td class="titik">:</td>
    <td>{{ ucfirst(strtolower($surat->bangsa)) }}</td>
</tr>

<tr>
    <td class="label">Agama</td>
    <td class="titik">:</td>
    <td>{{ ucfirst(strtolower($surat->agama)) }}</td>
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

<p class="isi">
    Yang namanya tersebut diatas memang benar warga Kelurahan Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu dan anak dari pasangan :
</p>

<!-- AYAH -->
<!-- AYAH -->
<div class="sub-judul">1. Ayah Kandung</div>

<div class="data-wrapper">
    <table class="data">
        <tr>
            <td class="label">Nama</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->nama_ayah, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>

        <tr>
            <td class="label">Tempat/Tgl. Lahir</td>
            <td class="titik">:</td>
            <td>
                {{ mb_convert_case($surat->tempat_lahir_ayah, MB_CASE_TITLE, "UTF-8") }},
                {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ayah)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Pekerjaan</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->pekerjaan_ayah, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>

        <tr>
            <td class="label">Alamat</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->alamat_ayah, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>
    </table>
</div>

<!-- IBU -->
<div class="sub-judul">2. Ibu Kandung</div>

<div class="data-wrapper">
    <table class="data">
        <tr>
            <td class="label">Nama</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->nama_ibu, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>

        <tr>
            <td class="label">Tempat/Tgl. Lahir</td>
            <td class="titik">:</td>
            <td>
                {{ mb_convert_case($surat->tempat_lahir_ibu, MB_CASE_TITLE, "UTF-8") }},
                {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ibu)->translatedFormat('d F Y') }}
            </td>
        </tr>

        <tr>
            <td class="label">Pekerjaan</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->pekerjaan_ibu, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>

        <tr>
            <td class="label">Alamat</td>
            <td class="titik">:</td>
            <td>{{ mb_convert_case($surat->alamat_ibu, MB_CASE_TITLE, "UTF-8") }}</td>
        </tr>
    </table>
</div>
<p class="isi">
    Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
</p>

<!-- TTD -->
<div class="ttd">
<div class="kanan">

    <div>
        Sekarjaya,
        {{ $surat->tanggal_surat 
            ? \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') 
            : now()->translatedFormat('d F Y') }}
    </div>

    <div style="margin-top:6px;">
        LURAH SEKARJAYA
    </div>

    <div style="height:85px;"></div>

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