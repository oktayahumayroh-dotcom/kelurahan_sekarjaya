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
            line-height: 1.35;
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
            margin: 2px 0;
        }

        .garis {
            border-top: 3px solid black;
            border-bottom: 1px solid black;
            margin: 4px 0;
        }

        .judul {
            text-align: center;
            margin-top: 5px;
        }

        .nomor {
            text-align: center;
            margin-top: 3px;
        }

        table.data {
            width: 100%;
        }

        table.data td {
            padding: 2px 0;
        }

        p {
            text-align: justify;
            margin: 4px 0;
        }

        .ttd {
            margin-top: 100px; /* 🔥 posisi pas */
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

.isi {
    text-align: justify;
    text-indent: 40px;
    width: 100%;
    line-height: 1.5;
    margin: 6px 0;
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
    <b><u>SURAT KETERANGAN TIDAK MAMPU</u></b>
</div>

<div class="nomor">
    Nomor : {{ $surat->nomor_surat ?? '___' }}
</div>

<br>

<p class="pembuka">
    Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu menerangkan :
</p>

<!-- ===== DATA ===== -->
<table class="data">
    <tr>
        <td width="220">Nama</td>
        <td>:</td>
        <td>{{ mb_convert_case($surat->nama, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td>Bin / Binti</td>
        <td>:</td>
        <td>{{ mb_convert_case($surat->bin_binti, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $surat->nik }}</td>
    </tr>

    <tr>
        <td>Tempat/Tgl. Lahir</td>
        <td>:</td>
        <td>
            {{ mb_convert_case($surat->tempat_lahir, MB_CASE_TITLE, "UTF-8") }}, 
            {{ $surat->tanggal_lahir 
                ? \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') 
                : '-' }}
        </td>
    </tr>

    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{ $surat->jenis_kelamin }}</td>
    </tr>

    <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ ucfirst(strtolower($surat->agama)) }}</td>
    </tr>

    <tr>
        <td>Kewarganegaraan</td>
        <td>:</td>
        <td>{{ strtoupper($surat->kewarganegaraan) }}</td>
    </tr>

    <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ mb_convert_case($surat->pekerjaan, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>

    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ mb_convert_case($surat->alamat, MB_CASE_TITLE, "UTF-8") }}</td>
    </tr>
</table>

<br>

<p class="isi">
    Benar orang tersebut penduduk Kelurahan Sekarjaya dan sepengetahuan kami orang tersebut memang benar dari keluarga tidak mampu (Miskin).
</p>

<p class="isi">
    Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan seperlunya.
</p>
<!-- ===== TTD ===== -->
<div class="ttd">
    <div class="kanan">

        <div>
            Sekarjaya,
            {{ $surat->tanggal_surat 
                ? \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') 
                : now()->translatedFormat('d F Y') }}
        </div>

        <div style="margin-top:8px;">
            LURAH SEKARJAYA
        </div>

        <div style="height:95px;"></div> <!-- 🔥 ruang tanda tangan lega -->

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