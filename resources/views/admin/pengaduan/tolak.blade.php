@extends('admin.layout')

@section('content')

<div class="container mt-4">

    <h4 class="mb-3">Tolak Pengaduan</h4>

    <div class="card p-4 shadow-sm">

        <!-- INFO SINGKAT -->
        <div class="mb-3">
            <b>Nama:</b> {{ $data->nama }} <br>
            <b>Jenis:</b> {{ $data->jenis_pengaduan }} <br>
        </div>

        <!-- FORM -->
        <form action="{{ route('admin.pengaduan.tolak.kirim', $data->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Alasan Penolakan</label>
                <textarea name="catatan" class="form-control" rows="4" required placeholder="Masukkan alasan penolakan..."></textarea>
            </div>

            <button class="btn btn-danger">
                ❌ Tolak Pengaduan
            </button>

            <a href="{{ route('admin.pengaduan') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>

    </div>

</div>

@endsection