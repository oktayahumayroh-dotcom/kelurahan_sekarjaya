@extends('admin.layout')

@section('content')

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold mb-1">
                📦 Riwayat Pengajuan Surat
            </h4>
            <small class="text-muted">Data surat yang sudah selesai diproses</small>
        </div>
    </div>

    <!-- FILTER CARD -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">

            <form method="GET" class="row g-3">

                <div class="col-12 col-md-3">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor_surat"
                           class="form-control"
                           value="{{ request('nomor_surat') }}"
                           placeholder="Cari nomor...">
                </div>

                <div class="col-6 col-md-2">
                    <label class="form-label">Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua</option>
                        <option value="2026" {{ request('tahun')=='2026'?'selected':'' }}>2026</option>
                        <option value="2027" {{ request('tahun')=='2027'?'selected':'' }}>2027</option>
                    </select>
                </div>

                <div class="col-6 col-md-2">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" class="form-select">
                        <option value="">Semua</option>
                        <option value="domisili" {{ request('jenis')=='domisili'?'selected':'' }}>Domisili</option>
                        <option value="usaha" {{ request('jenis')=='usaha'?'selected':'' }}>Usaha</option>
                        <option value="tidak_mampu" {{ request('jenis')=='tidak_mampu'?'selected':'' }}>Tidak Mampu</option>
                        <option value="kelahiran" {{ request('jenis')=='kelahiran'?'selected':'' }}>Kelahiran</option>
                    </select>
                </div>

                <div class="col-12 col-md-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="search"
                           class="form-control"
                           value="{{ request('search') }}"
                           placeholder="Cari nama...">
                </div>

                <div class="col-12 col-md-2 d-grid">
                    <button class="btn btn-primary">
                        🔍 Cari
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Tahun</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($data as $item)
                        <tr>

                            <td class="fw-semibold text-primary">
                                {{ $item->nomor_surat ?? '-' }}
                            </td>

                            <td>{{ $item->nama }}</td>

                            <td>
                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    {{ $item->jenis_surat }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->year }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
                            </td>

                            <td class="text-center">

                                @if($item->file_pdf)

                                    <a href="{{ asset($item->file_pdf) }}"
                                       class="btn btn-sm btn-danger"
                                       target="_blank">
                                        📄
                                    </a>

                                    <a href="{{asset($item->file_pdf) }}"
                                       class="btn btn-sm btn-success"
                                       download>
                                        ⬇
                                    </a>

                                @else
                                    <span class="text-muted small">Tidak ada file</span>
                                @endif

                            </td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                📭 Data arsip tidak ditemukan
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="card-footer bg-white d-flex justify-content-between">

            <small class="text-muted">
                Total: <b>{{ $data->count() }}</b>
            </small>

        </div>

    </div>

</div>

@endsection