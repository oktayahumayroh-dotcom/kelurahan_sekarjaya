@extends('admin.layout')

@section('content')

<style>
/* ===== PAGE ===== */
.notif-wrapper{
    padding: 10px;
}

/* ===== CARD ===== */
.notif-card{
    border: none;
    border-radius: 24px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 10px 35px rgba(0,0,0,0.06);
}

/* ===== HEADER ===== */
.notif-header{
    padding: 24px 28px;
    border-bottom: 1px solid #f1f1f1;
    background: linear-gradient(to right, #ffffff, #f8fbf9);
}

.notif-title{
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.notif-subtitle{
    color: #64748b;
    margin-top: 4px;
    font-size: 14px;
}

/* ===== DELETE BUTTON ===== */
.btn-delete-all{
    border: none;
    background: linear-gradient(135deg,#dc3545,#b91c1c);
    color: white;
    padding: 12px 18px;
    border-radius: 14px;
    font-weight: 600;
    transition: .3s;
    box-shadow: 0 5px 18px rgba(220,53,69,0.25);
}

.btn-delete-all:hover{
    transform: translateY(-2px);
}

/* ===== BODY ===== */
.notif-body{
    padding: 25px;
}

/* ===== ITEM ===== */
.notif-item{
    position: relative;
    border-radius: 22px;
    padding: 22px;
    margin-bottom: 18px;
    background: #fff;
    border: 1px solid #eef2f7;
    transition: .25s ease;
}

.notif-item:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* unread */
.notif-unread{
    background: linear-gradient(to right,#f0fff6,#ffffff);
    border-left: 5px solid #198754;
}

/* icon */
.notif-icon{
    width: 55px;
    height: 55px;
    border-radius: 18px;
    background: linear-gradient(135deg,#198754,#157347);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
    flex-shrink: 0;
    box-shadow: 0 8px 18px rgba(25,135,84,0.25);
}

/* title */
.notif-item-title{
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 6px;
}

/* message */
.notif-message{
    color: #64748b;
    line-height: 1.6;
    font-size: 14px;
}

/* date */
.notif-date{
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
    color: #94a3b8;
    font-size: 13px;
}

/* action */
.notif-actions{
    display: flex;
    gap: 10px;
}

/* button */
.btn-action{
    width: 42px;
    height: 42px;
    border-radius: 12px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .2s;
}

.btn-view{
    background: #198754;
    color: white;
}

.btn-view:hover{
    background: #157347;
    transform: scale(1.05);
}

.btn-trash{
    background: #dc3545;
    color: white;
}

.btn-trash:hover{
    background: #bb2d3b;
    transform: scale(1.05);
}

/* empty */
.empty-box{
    padding: 80px 20px;
    text-align: center;
}

.empty-box i{
    font-size: 70px;
    color: #cbd5e1;
    margin-bottom: 15px;
}

.empty-box h5{
    color: #475569;
    font-weight: 700;
}

.empty-box p{
    color: #94a3b8;
}

/* pagination */
.pagination{
    justify-content: center;
}

.page-link{
    border: none !important;
    margin: 0 4px;
    border-radius: 10px !important;
    color: #198754;
    font-weight: 600;
    padding: 10px 15px;
}

.page-item.active .page-link{
    background: #198754;
    color: white;
}

/* ===== MOBILE ===== */
@media(max-width:768px){

    .notif-header{
        padding: 20px;
    }

    .notif-title{
        font-size: 22px;
    }

    .notif-body{
        padding: 15px;
    }

    .notif-item{
        padding: 18px;
    }

    .notif-actions{
        width: 100%;
        margin-top: 15px;
    }

    .notif-top{
        flex-direction: column;
        align-items: start !important;
    }

    .notif-right{
        width: 100%;
    }

    .btn-action{
        flex: 1;
        width: auto;
    }

    .btn-delete-all{
        width: 100%;
        margin-top: 15px;
    }

}

.container-fluid.notif-wrapper{
    padding: 0 !important;
}

.notif-card{
    max-width: 100%;
}    

.pagination {
    font-size: 13px;
}

.pagination .page-link {
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 8px !important;
}

/* ini yang biasanya bikin icon previous/next gede */
.pagination svg {
    width: 16px !important;
    height: 16px !important;
}
    
</style>

<div class="container-fluid notif-wrapper">

    <div class="notif-card">

        <!-- HEADER -->
        <div class="notif-header">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h2 class="notif-title">
                        🔔 Semua Notifikasi
                    </h2>

                    <div class="notif-subtitle">
                        Daftar seluruh aktivitas dan pemberitahuan sistem terbaru
                    </div>
                </div>

                <button onclick="hapusSemuaNotif()"
                        class="btn-delete-all">
                    <i class="bi bi-trash3-fill me-1"></i>
                    Hapus Semua
                </button>

            </div>

        </div>

        <!-- BODY -->
        <div class="notif-body">

            @forelse($allNotifs as $notif)

                <div class="notif-item {{ $notif->is_read ? '' : 'notif-unread' }}">

                    <div class="d-flex justify-content-between align-items-start notif-top gap-3">

                        <!-- LEFT -->
                        <div class="d-flex gap-3 flex-grow-1">

                            <!-- ICON -->
                            <div class="notif-icon">
                                <i class="bi bi-bell-fill"></i>
                            </div>

                            <!-- TEXT -->
                            <div class="notif-right">

                                <div class="notif-item-title">
                                    {{ $notif->title }}
                                </div>

                                <div class="notif-message">
                                    {{ $notif->message }}
                                </div>

                                <div class="notif-date">
                                    <i class="bi bi-clock-history"></i>

                                    {{ $notif->created_at->translatedFormat('d F Y • H:i') }}

                                    •

                                    {{ $notif->created_at->diffForHumans() }}
                                </div>

                            </div>

                        </div>

                        <!-- ACTION -->
                        <div class="notif-actions">

                            <!-- VIEW -->
                            <a href="{{ route('admin.notif.show', $notif->id) }}"
                               class="btn-action btn-view">
                                <i class="bi bi-eye-fill"></i>
                            </a>

                            <!-- DELETE -->
                            <button onclick="hapusNotif({{ $notif->id }})"
                                    class="btn-action btn-trash">
                                <i class="bi bi-trash-fill"></i>
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-box">

                    <i class="bi bi-bell-slash"></i>

                    <h5>Tidak Ada Notifikasi</h5>

                    <p>
                        Semua notifikasi akan muncul di halaman ini
                    </p>

                </div>

            @endforelse

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $allNotifs->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
function hapusNotif(id) {

    Swal.fire({
        title: 'Hapus notifikasi?',
        text: 'Data akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch('/admin/notifikasi/delete/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Notifikasi dihapus',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    location.reload();
                }, 1500);

            });

        }

    });

}

function hapusSemuaNotif() {

    Swal.fire({
        title: 'Hapus semua notifikasi?',
        text: 'Semua notifikasi akan dihapus permanen',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus semua',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('/admin/notifikasi/hapus-semua', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Semua notifikasi berhasil dihapus',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    location.reload();
                }, 1500);

            });

        }

    });

}
</script>

@endsection