@extends('admin.layout')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">
            <i class="bi bi-archive"></i> Arsip Pengaduan
        </h5>
    </div>

    <!-- FILTER -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-12 col-md-4">
            <select name="status" class="form-select">
                <option value="all">Semua Status</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>

        <div class="col-12 col-md-5">
            <input type="text" name="search" class="form-control" placeholder="🔍 Cari nama...">
        </div>

        <div class="col-12 col-md-3">
            <button class="btn btn-success w-100">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>
    </form>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-2 p-md-3">

            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle">

                    <thead class="table-success text-center small">
                        <tr>
                            <th>No</th>
                            <th>Warga</th>
                            <th>Pengaduan</th>
                            <th>Status</th>
                            <th>Tgl</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="small">
                        @forelse($data as $item)
                            <tr>

                                <td class="text-center">{{ $loop->iteration }}</td>

                                <!-- WARGA -->
                                <td>
                                    <div class="fw-semibold">{{ $item->nama }}</div>
                                    <small class="text-muted">
                                        {{ $item->nik }} <br>
                                        <i class="bi bi-telephone"></i> {{ $item->telepon }}
                                    </small>
                                </td>

                                <!-- PENGADUAN -->
                                <td style="max-width:200px;">
                                    <div class="fw-semibold">
                                        {{ $item->jenis_pengaduan }}
                                    </div>
                                    <small class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($item->keterangan, 40) }}
                                    </small>
                                </td>

                                <!-- STATUS -->
                                <td class="text-center">
                                    @if($item->status == 'selesai')
                                        <span class="badge bg-success">✔</span>
                                    @elseif($item->status == 'proses')
                                        <span class="badge bg-warning text-dark">⏳</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">✖</span>
                                    @else
                                        <span class="badge bg-secondary">•</span>
                                    @endif
                                </td>

                                <!-- TANGGAL -->
                                <td class="text-center">
                                    {{ $item->created_at->format('d-m-y') }}
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">
                                    @if($item->foto)
                                        <button class="btn btn-sm btn-primary p-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#fotoModal{{ $item->id }}">
                                            <i class="bi bi-image"></i>
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                            </tr>

                            <!-- MODAL FOTO -->
                            @if($item->foto)
                            <div class="modal fade" id="fotoModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">

                                        <div class="modal-header py-2">
                                            <h6 class="modal-title">
                                                <i class="bi bi-image"></i> Foto
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body text-center p-2">

                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                 class="img-fluid rounded"
                                                 style="
                                                    max-height: 250px;
                                                    width: auto;
                                                    max-width: 100%;
                                                    object-fit: contain;
                                                 ">

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection