@extends('admin.layout')

@section('content')

<h4 class="mb-3">Generate Surat Kelahiran</h4>

<form action="{{ route('admin.final', ['jenis' => 'kelahiran', 'id' => $surat->id]) }}" method="POST">
@csrf

    {{-- ERROR GLOBAL --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <b>Form belum lengkap:</b>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- DATA PEMOHON -->
<div class="card mb-3 p-3 shadow-sm">
    <h5>Data Anak</h5>
    <p><b>Nama:</b> {{ $surat->nama }}</p>
    <p><b>TTL:</b> {{ $surat->tempat_lahir }}, {{ $surat->tanggal_lahir }}</p>
    <p><b>Jenis Kelamin:</b> {{ $surat->jenis_kelamin }}</p>
    <p><b>Bangsa:</b> {{ $surat->bangsa }}</p>
    <p><b>Agama:</b> {{ $surat->agama }}</p>
    <p><b>Pekerjaan:</b> {{ $surat->pekerjaan }}</p>
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
        <div class="f16"><b><u>SURAT KETERANGAN KELAHIRAN</u></b></div>
        <div class="f14 nomor">
            Nomor : {{ $surat->nomor_surat ?? '___' }}
        </div>
    </div>

    <br>

    <p class="f12" style="text-align: justify;">
        Lurah Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu menerangkan bahwa :
    </p>

    <!-- DATA ANAK -->
    <table class="f12 data">
        <tr><td width="220">Nama</td><td>:</td><td>{{ $surat->nama }}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
        <tr><td>Bangsa</td><td>:</td><td>{{ $surat->bangsa }}</td></tr>
        <tr><td>Agama</td><td>:</td><td>{{ $surat->agama }}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat }}</td></tr>
    </table>

    <p class="f12" style="text-align: justify;">
        Yang namanya tersebut diatas memang benar warga Kelurahan Sekarjaya Kecamatan Baturaja Timur Kabupaten Ogan Komering Ulu dan anak dari pasangan :
    </p>

    <!-- AYAH -->
    <h5>1. Ayah Kandung</h5>
    <table class="f12 data">
        <tr><td width="220">Nama</td><td>:</td><td>{{ $surat->nama_ayah }}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_ayah }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ayah)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan_ayah }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_ayah }}</td></tr>
    </table>

    <!-- IBU -->
    <h5>2. Ibu Kandung</h5>
    <table class="f12 data">
        <tr><td width="220">Nama</td><td>:</td><td>{{ $surat->nama_ibu }}</td></tr>
        <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{{ $surat->tempat_lahir_ibu }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir_ibu)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->pekerjaan_ibu }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat_ibu }}</td></tr>
    </table>

    <p class="f12" style="text-align: justify;">
        Demikian surat keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
    </p>

    <!-- TTD -->
    <div class="ttd">
        <div class="kanan">
            Sekarjaya, {{ $surat->tanggal_surat ? \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}<br>
            LURAH SEKARJAYA,
            <br><br><br><br>
            <b class="nama">ARNANDO YUGANTARA, S.STP., M.Si.</b><br>
            NIP. 199209112014061001
        </div>
    </div>

</div>
</div>

<div style="clear:both; height:50px;"></div>

<div class="mt-5">
    <label>Jadwal Ambil</label>
    <input type="date" name="jadwal_ambil"
        class="form-control @error('jadwal_ambil') is-invalid @enderror"
        value="{{ old('jadwal_ambil', $surat->jadwal_ambil ?? '') }}"
        required>

    @error('jadwal_ambil')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Pengaturan Jam Ambil</label>
    <div class="row g-2">
        <div class="col-6">
            <label class="card p-3 border pilihan-jam">
                <input type="radio" name="mode_jam" value="kerja" class="form-check-input me-2" {{ empty($surat->jam_ambil) ? 'checked' : '' }}>
                <div><b>Jam Kerja</b><br><small class="text-muted">08:00 - 14:00</small></div>
            </label>
        </div>
        <div class="col-6">
            <label class="card p-3 border pilihan-jam">
                <input type="radio" name="mode_jam" value="custom" class="form-check-input me-2" {{ !empty($surat->jam_ambil) ? 'checked' : '' }}>
                <div><b>Atur Sendiri</b><br><small class="text-muted">Tentukan jam</small></div>
            </label>
        </div>
    </div>
</div>

<div class="mb-3" id="inputJam">
    <label class="form-label">Jam Ambil</label>
    <input type="time" name="jam_ambil" class="form-control" min="08:00" max="14:00" value="{{ old('jam_ambil', $surat->jam_ambil ?? '') }}">
</div>

<div class="mt-3">
    <label>Pilih Template</label>
    <select id="template" class="form-control">
        <option value="">-- Pilih Template --</option>
        <option value="Silakan datang ke kantor kelurahan untuk mengambil surat dengan membawa KTP dan KK.">Ambil + Bawa KTP & KK</option>
        <option value="Harap membawa fotocopy KTP, KK, dan surat pengantar RT/RW.">Bawa Berkas Lengkap</option>
    </select>
</div>

<div class="mt-3">
    <label>Catatan Admin</label>
    <textarea name="catatan" id="catatan"
        class="form-control @error('catatan') is-invalid @enderror"
        rows="3" required>{{ old('catatan', $surat->catatan ?? '') }}</textarea>

    @error('catatan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- BUTTONS -->
<div class="mt-4 d-flex justify-content-between align-items-center">

    <!-- KIRI -->
    <div>
        <a href="{{ route('admin.edit', ['jenis' => 'kelahiran', 'id' => $surat->id]) }}" 
           class="btn btn-secondary">
           ← Kembali
        </a>
    </div>

    <!-- KANAN -->
    <div class="d-flex gap-2">
        <a href="{{ route('admin.pdf', ['jenis' => 'kelahiran', 'id' => $surat->id]) }}" 
           target="_blank" 
           class="btn btn-outline-success">
           Print PDF
        </a>

        @if($surat->status_surat != 'ditolak')
        <button type="button" 
                onclick="konfirmasiSelesai()" 
                class="btn btn-success">
            Simpan & Selesai
        </button>
        @endif
    </div>

</div>

</form>

@endsection

@section('scripts')
<style>
.f20 { font-size:20px; }
.f16 { font-size:16px; }
.f14 { font-size:14px; }
.f12 { font-size:12px; }

.surat { font-family: "Times New Roman"; line-height:1.5; }

.kop { display:flex; align-items:center; }
.logo img { width:80px; }
.kop-text { flex:1; text-align:center; }

.garis { border-top:3px solid black; border-bottom:1px solid black; margin:5px 0; }

.judul { text-align:center; }
.nomor { text-align:center; margin-top:5px; }

.data td { padding:3px 5px; vertical-align: top; }
.ttd { margin-top:60px; page-break-inside: avoid; }
.kanan { width:300px; float:right; text-align:center; }
.nama { display:inline-block; margin-top:70px; text-decoration: underline; }

.pilihan-jam { cursor:pointer; transition:0.2s; }
.pilihan-jam:hover { background:#f8f9fa; }
.pilihan-jam input:checked + div { color:#198754; font-weight:bold; }
</style>

<script>
document.getElementById('template').addEventListener('change', function() {
    document.getElementById('catatan').value = this.value;
});

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

// Toggle input jam
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

    radios.forEach(radio => radio.addEventListener('change', toggleJam));
    toggleJam();
});
</script>
@endsection