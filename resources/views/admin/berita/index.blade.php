@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

        <div>
            <h5 class="fw-bold mb-0">📢 Manajemen Berita</h5>
            <small class="text-muted">Kelola semua berita yang tampil di website</small>
        </div>

        <a href="{{ url('/admin/berita/create') }}" class="btn btn-success shadow-sm">
            ➕ <i class="bi bi-plus-circle"></i> Tambah Berita
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success py-2 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- ================= DESKTOP ================= -->
    <div class="card shadow-sm border-0 d-none d-md-block">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Judul</th>
                            <th width="100">Gambar</th>
                            <th width="120">Tanggal</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($berita as $item)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td style="max-width:250px;">
                                <div class="fw-semibold text-truncate">
                                    {{ $item->judul }}
                                </div>
                                <small class="text-muted text-truncate d-block">
                                    {{ $item->slug }}
                                </small>
                            </td>

                            <td>
                                @if($item->gambar)
                                      <img src="{{ asset($item->gambar) }}"
                                         class="rounded"
                                         style="width:60px;height:60px;object-fit:cover;">
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>

                            <td>
                                <small>{{ $item->created_at->format('d M Y') }}</small>
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="{{ url('/admin/berita/edit/'.$item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        ✏️ <i class="bi bi-pencil"></i>
                                    </a>

                                    <button onclick="hapus({{ $item->id }})"
                                            class="btn btn-danger btn-sm">
                                        🗑️ <i class="bi bi-trash"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada berita 😴
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- ================= MOBILE ================= -->
    <div class="d-md-none">

        @forelse($berita as $item)
        <div class="card shadow-sm mb-3 border-0">

            <div class="card-body p-3">

                <div class="fw-semibold mb-1">
                    {{ $item->judul }}
                </div>

                <small class="text-muted d-block mb-2">
                    {{ $item->slug }}
                </small>

                @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}"
                         class="w-100 mb-2 rounded"
                         style="max-height:160px;object-fit:cover;">
                @endif

                <small class="text-muted d-block mb-3">
                    📅 {{ $item->created_at->format('d M Y') }}
                </small>

                <div class="d-flex gap-2">

                    <a href="{{ url('/admin/berita/edit/'.$item->id) }}"
                       class="btn btn-warning btn-sm flex-fill">
                        ✏️ Edit
                    </a>

                    <button onclick="hapus({{ $item->id }})"
                            class="btn btn-danger btn-sm flex-fill">
                        🗑️ Hapus
                    </button>

                </div>

            </div>

        </div>
        @empty
        <div class="text-center text-muted">
            Belum ada berita 😴
        </div>
        @endforelse

    </div>

</div>
@endsection


@section('scripts')

<script>
function hapus(id) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/berita/delete/' + id;
        }
    })
}
</script>

@endsection