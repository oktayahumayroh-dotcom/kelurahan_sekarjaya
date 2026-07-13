@extends('admin.layout')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
@media (max-width: 768px) {
    .table {
        font-size: 12px;
    }

    .table td, .table th {
        padding: 6px;
    }
}
</style>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            <i class="bi bi-clock-history me-2"></i>
            Log Nomor Surat
        </h4>
        <small class="text-muted">Rekap dan pencarian data nomor surat</small>
    </div>

    <!-- SEARCH + ACTION -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

        <!-- SEARCH -->
        <form method="GET" action="{{ route('admin.history') }}" class="w-100 w-md-50">
            <div class="input-group">

                <!-- ICON -->
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <!-- INPUT -->
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Cari nama / nomor surat / nomor urut...">

                <!-- 🔥 TOMBOL CARI (FIX HP) -->
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>

            </div>
        </form>

        <!-- BUTTON -->
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>

            <a href="{{ route('admin.history') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-clockwise"></i>
            </a>
        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nomor</th>
                            <th>Nomor Surat</th>
                            <th>Nama</th>
                            <th class="d-none d-md-table-cell">Jenis</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $item)

                        <tr>

                            <td class="fw-semibold text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                {{ str_pad($item->nomor_urut, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="text-muted small" style="max-width:160px; white-space:normal; word-break:break-word;">
                                {{ $item->nomor_surat }}
                            </td>

                            <td>
                                {{ $item->nama }}
                            </td>

                            <td class="d-none d-md-table-cell">
                                <span class="badge bg-secondary text-uppercase">
                                    {{ $item->jenis }}
                                </span>
                            </td>

                            <td class="d-none d-md-table-cell">
                                @if($item->status == 'selesai')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Selesai
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle me-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Data tidak ditemukan
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<!-- MODAL FILTER -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="GET" action="{{ route('admin.history') }}">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-funnel me-2"></i> Filter Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Jenis</label>
                            <select name="jenis" class="form-select">
                                <option value="">Semua</option>
                                <option value="domisili">Domisili</option>
                                <option value="usaha">Usaha</option>
                                <option value="tidak_mampu">Tidak Mampu</option>
                                <option value="kelahiran">Kelahiran</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tahun</label>
                            <input type="number"
                                   name="tahun"
                                   value="{{ request('tahun') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date"
                                   name="dari"
                                   value="{{ request('dari') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date"
                                   name="sampai"
                                   value="{{ request('sampai') }}"
                                   class="form-control">
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <a href="{{ route('admin.history') }}" class="btn btn-secondary">
                        Reset
                    </a>
                    <button class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Terapkan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection