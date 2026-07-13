@extends('admin.layout')

@section('content')

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}'
});
</script>
@endif

<div class="container-fluid">

    <h4 class="fw-bold mb-4">Data Pengaduan</h4>

    <!-- SEARCH -->
    <div class="mb-3">
        <input type="text" id="searchInput" 
            class="form-control form-control-sm"
            placeholder="Cari nama... tekan enter">
    </div>

    <!-- FILTER -->
    <div class="mb-4 d-flex flex-wrap gap-2 align-items-center">

        <span class="text-muted me-2">Filter:</span>

        <a href="?status=all"
           class="btn btn-sm {{ request('status') == 'all' || request('status') == null ? 'btn-dark' : 'btn-outline-dark' }}">
            Semua
        </a>

        <a href="?status=pending"
           class="btn btn-sm {{ request('status') == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
            Pending
        </a>

        <a href="?status=proses"
           class="btn btn-sm {{ request('status') == 'proses' ? 'btn-primary' : 'btn-outline-primary' }}">
            Proses
        </a>

        <a href="?status=selesai"
           class="btn btn-sm {{ request('status') == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">
            Selesai
        </a>

        <a href="?status=ditolak"
           class="btn btn-sm {{ request('status') == 'ditolak' ? 'btn-danger' : 'btn-outline-danger' }}">
            Ditolak
        </a>

    </div>

    <div class="row g-4">

        @forelse($data as $item)

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card pengaduan-card shadow-sm h-100">

                <div class="card-body d-flex flex-column">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between mb-3">

                        <div>
                            <span class="badge bg-secondary mb-2">
                                {{ $item->jenis_pengaduan ?? 'Umum' }}
                            </span>

                            <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>

                            <small class="text-muted d-block">
                                NIK: {{ $item->nik }}
                            </small>

                            <small class="text-muted d-block">
                                {{ $item->created_at->format('d M Y') }}
                            </small>
                        </div>

                        <!-- STATUS -->
                        <div>
                            @if($item->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                            @elseif($item->status == 'proses')
                                <span class="badge bg-primary px-3 py-2">Proses</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success px-3 py-2">Selesai</span>
                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger px-3 py-2">Ditolak</span>
                            @endif
                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="mt-auto">

                        {{-- PENDING --}}
                        @if($item->status == 'pending')
                        <div class="row g-2">
                            <div class="col-12">
                                <button type="button"
                                    onclick="konfirmasiProses({{ $item->id }})"
                                    class="btn btn-primary w-100 btn-sm">
                                    Proses
                                </button>
                            </div>
                        </div>
                        @endif

                        {{-- PROSES --}}
                        @if($item->status == 'proses')
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="{{ route('admin.pengaduan.detail', $item->id) }}"
                                    class="btn btn-warning w-100 btn-sm">
                                    Detail
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.pengaduan.tolak', $item->id) }}"
                                   class="btn btn-danger w-100 btn-sm">
                                    Tolak
                                </a>
                            </div>
                        </div>
                        @endif

                        {{-- SELESAI --}}
                        @if($item->status == 'selesai')
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="/admin/pengaduan/tanggapi/{{ $item->id }}"
                                    class="btn btn-success w-100 btn-sm">
                                    Lihat Tanggapan
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="{{ route('admin.pengaduan.detail', $item->id) }}"
                                    class="btn btn-warning w-100 btn-sm">
                                    Detail
                                </a>
                            </div>
                        </div>
                        @endif

                        {{-- DITOLAK --}}
                        @if($item->status == 'ditolak')
                        <div class="row g-2">
                            <div class="col-12">
                                <a href="{{ route('admin.pengaduan.detail', $item->id) }}"
                                    class="btn btn-danger w-100 btn-sm">
                                    Lihat Alasan Penolakan
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- HAPUS -->
                        <div class="mt-2">
                            <form action="{{ route('admin.pengaduan.hapus', $item->id) }}" method="POST" onsubmit="return konfirmasiHapus(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada data pengaduan
            </div>
        </div>
        @endforelse

    </div>

</div>

@endsection

@section('scripts')

<style>
.pengaduan-card {
    border-radius: 14px;
    transition: all 0.2s ease;
}
.pengaduan-card:hover {
    transform: translateY(-5px);
}
.btn {
    border-radius: 10px;
    font-weight: 500;
}
</style>

<script>

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        let keyword = this.value;
        window.location.href = '?search=' + keyword;
    }
});

function konfirmasiProses(id) {

    Swal.fire({
        title: 'YaProses Pengaduankin?',
        text: "Pengaduan akan masuk ke tahap proses.!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch('/admin/pengaduan/proses/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pengaduan masuk ke tahap proses',
                    confirmButtonText: 'Lihat Detail'
                }).then(() => {

                    window.location.href =
                        '/admin/pengaduan/detail/' + id;

                });

            });

        }

    });
}
function konfirmasiHapus(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Hapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            e.target.submit();
        }
    });

    return false;
}
</script>

@endsection