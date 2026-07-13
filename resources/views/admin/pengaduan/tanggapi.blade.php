@extends('admin.layout')

@section('content')

@php
    \Carbon\Carbon::setLocale('id');
@endphp

<div class="container-fluid">

    <h4 class="fw-bold mb-4 text-center text-md-start">Tanggapi Pengaduan</h4>

    <div class="row g-4">

        <!-- 🔥 INFO PENGADUAN -->
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">📄 Informasi Pengaduan</h5>

                    <div class="mb-2">
                        <span class="badge bg-secondary">
                            {{ $data->jenis_pengaduan }}
                        </span>
                    </div>

                    <p class="mb-1">
                        <b>Nama:</b><br>
                        {{ $data->nama }}
                    </p>

                    <p class="mb-1">
                        <b>Tanggal Pengaduan:</b><br>
                        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                    </p>

                    <p class="mb-1">
                        <b>Lokasi:</b><br>
                        {{ $data->alamat }}
                    </p>

                    <p class="mb-0">
                        <b>Keterangan:</b><br>
                        {{ $data->keterangan }}
                    </p>

                </div>
            </div>
        </div>

        <!-- 🔥 FORM TANGGAPAN -->
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">💬 Tanggapan Admin</h5>

                    <form action="{{ route('admin.pengaduan.kirim', $data->id) }}" method="POST">
                        @csrf

                        <!-- 🔥 TEMPLATE -->
                        <div class="mb-3">
                            <label class="fw-semibold mb-2">Pilih Template (Opsional)</label>
                            <select class="form-select" onchange="isiTemplate(this)">
                                <option value="">-- Pilih Template --</option>
                                <option value="Pengaduan telah kami terima. Terima kasih telah menggunakan layanan pengaduan. Kami akan segera menindaklanjuti laporan Anda.">
                                    Template Umum
                                </option>
                                <option value="Terima kasih atas laporan Anda. Saat ini pengaduan sedang kami evaluasi dan akan segera ditindaklanjuti oleh petugas terkait.">
                                    Sedang Diproses
                                </option>
                                <option value="Pengaduan telah kami terima dan akan segera ditindaklanjuti sesuai kondisi di lapangan. Terima kasih atas partisipasi Anda.">
                                    Siap Ditindak Lanjuti
                                </option>
                            </select>
                        </div>

                        <!-- TEXTAREA -->
                        <div class="mb-3">
                            <label class="fw-semibold mb-2">Catatan / Tanggapan</label>
                            <textarea name="catatan" class="form-control" rows="6" required
                            placeholder="Contoh: Pengaduan telah kami terima dan akan segera ditindaklanjuti...">{{ old('catatan', $data->catatan) }}</textarea>
                        </div>

                        <!-- TANGGAL -->
                        <div class="mb-3">
                            <label class="fw-semibold mb-2">📅 Tanggal Tindak Lanjut</label>

                            <input type="date" name="tanggal_tindak_lanjut" 
                                class="form-control @error('tanggal_tindak_lanjut') is-invalid @enderror"
                                value="{{ $data->tanggal_tindak_lanjut ?? date('Y-m-d') }}">

                            @error('tanggal_tindak_lanjut')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <small class="text-muted">
                                Opsional (isi jika ingin menentukan jadwal tindak lanjut)
                            </small>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-4">

    <a href="/admin/pengaduan" class="btn btn-outline-secondary w-100 w-md-auto">
        ← Kembali
    </a>

    <!-- UPDATE -->
    <button type="button" onclick="konfirmasiUpdate()"
        class="btn btn-warning w-100">
        🔄 Update Status
    </button>

    <!-- SELESAI -->
    <button type="button" onclick="konfirmasiKirim()"
        class="btn btn-success w-100 w-md-auto">
        ✅ Kirim & Tindak Lanjuti
    </button>

</div>

                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- 🔥 SCRIPT TEMPLATE -->
<script>
function isiTemplate(select) {
    let textarea = document.querySelector('textarea[name="catatan"]');
    if(select.value !== '') {
        textarea.value = select.value;
    }
}
</script>

<script>
// TEMPLATE AUTO ISI
function isiTemplate(select) {
    let textarea = document.querySelector('textarea[name="catatan"]');
    if(select.value !== '') {
        textarea.value = select.value;
    }
}

// 🔄 KONFIRMASI UPDATE
function konfirmasiUpdate() {
    Swal.fire({
        title: 'Update Status?',
        text: "Perubahan akan disimpan tanpa menyelesaikan pengaduan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f0ad4e',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm('update');
        }
    });
}

// ✅ KONFIRMASI KIRIM
function konfirmasiKirim() {
    Swal.fire({
        title: 'Tindak Lanjuti?',
        text: "Pengaduan akan diproses dan dianggap ditindaklanjuti.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm('kirim');
        }
    });
}

// HANDLE SUBMIT
function submitForm(aksi) {
    let form = document.querySelector('form');

    // bikin input hidden untuk aksi
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'aksi';
    input.value = aksi;

    form.appendChild(input);
    form.submit();
}
</script>

@endsection