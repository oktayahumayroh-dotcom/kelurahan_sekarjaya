<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f4;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 270px;
            background: linear-gradient(180deg, #0d4d2c, #1b7a46);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 25px 18px;
            transition: 0.3s;
            z-index: 1000;
        }

        /* HANYA MOBILE YANG HIDE */
        @media (max-width: 768px) {
            .sidebar {
                left: -270px;
            }

            .sidebar.show {
                left: 0;
            }
        }

        /* LOGO */
        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 35px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.25);
        }

        .logo img {
            width: 60px;
        }

        .logo span {
            font-weight: 700;
            font-size: 20px;
        }

        /* CLOSE BTN */
        .close-btn {
            display: none;
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
        }

        /* MENU */
        .menu {
            flex: 1;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 8px;
            transition: 0.2s;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .menu a:hover {
            background: rgba(255,255,255,0.15);
        }

        .menu a.active {
            background: rgba(255,255,255,0.25);
            font-weight: 600;
        }

        /* LOGOUT */
        .logout {
            border-top: 1px solid rgba(255,255,255,0.25);
            padding-top: 15px;
        }

        .logout a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 10px;
        }

        .logout a:hover {
            background: rgba(255,255,255,0.2);
        }

        /* CONTENT */
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: 0.3s;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        /* TOGGLE */
        .toggle-btn {
            font-size: 22px;
            cursor: pointer;
            display: none;
        }

        /* OVERLAY */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            display: none;
            z-index: 900;
        }

        .overlay.show {
            display: block;
        }

        /* MOBILE */
        @media (max-width: 768px) {

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }

            .close-btn {
                display: block;
            }
        }

        /* ================= BOTTOM NAV ================= */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: white;
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 🔥 penting */
    align-items: center;
    height: 65px;
    box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
    z-index: 999;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    text-align: center;
}

.bottom-nav a {
    text-decoration: none;
    color: #555;
    font-size: 11px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.bottom-nav i {
    font-size: 20px;
}

/* 🔥 FIX TOMBOL TENGAH BIAR BENER-BENER CENTER */
.nav-home {
    position: relative;
    top: -20px;
    background: linear-gradient(135deg, #2c7744, #1f4037);
    color: white !important;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex !important;
    justify-content: center;
    align-items: center;
    margin: 0 auto; /* 🔥 ini bikin center */
    font-size: 22px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* BIAR KONTEN GA KETUTUP */
@media (max-width: 768px) {
    body {
        padding-bottom: 80px;
    }
}



/* 🔥 NOTIF PROFESIONAL */
.notif-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 45px;
    width: 380px; /* 🔥 lebih lebar */
    max-height: 520px; /* 🔥 biar gak nutup layar */
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    z-index: 999;
    overflow: hidden;
    animation: fadeIn 0.2s ease;
}
@media (max-width: 768px) {

    .notif-dropdown {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

        width: 100%;
        height: 100vh;

        max-width: none;
        border-radius: 0;

        z-index: 9999;
    }

}
/* HEADER */
.notif-header {
    padding: 14px 16px;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

/* TAB */
.notif-tabs {
    display: flex;
    border-bottom: 1px solid #eee;
}

.notif-tabs button {
    flex: 1;
    padding: 10px;
    border: none;
    background: none;
    font-size: 13px;
    cursor: pointer;
    transition: 0.2s;
}

.notif-tabs button.active {
    border-bottom: 2px solid #198754;
    font-weight: bold;
    color: #198754;
}

/* LIST (SCROLL DI DALAM) */
.notif-list {
    max-height: 400px; /* 🔥 scroll area */
    overflow-y: auto;
    padding: 10px;
}

/* SCROLLBAR BIAR CAKEP */
.notif-list::-webkit-scrollbar {
    width: 6px;
}
.notif-list::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

/* ITEM */
.notif-item {
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 10px;
    transition: 0.2s;
    background: #fff;
    border: 1px solid #f1f1f1;
}

.notif-item:hover {
    background: #f9f9f9;
}

/* UNREAD */
.notif-unread {
    background: #f1fff5;
    border-left: 4px solid #198754;
}

/* BUTTON AREA */
.notif-item .btn {
    font-size: 11px;
    padding: 4px 8px;
}



/* ANIMASI */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.notif-footer {
    position: sticky;
    bottom: 0;
    background: white;
    z-index: 20;
}
.topbar {
    position: sticky;
    top: 0;
    z-index: 1050;
}
        
    </style>
</head>

<body>

<!-- OVERLAY -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <!-- CLOSE MOBILE -->
    <i class="bi bi-x close-btn" onclick="closeSidebar()"></i>

    <!-- LOGO -->
    <div class="logo">
        <img src="{{ asset('images/gambar2.png') }}" alt="logo">
        <span>Admin Panel</span>
    </div>

    <!-- MENU -->
    <div class="menu">
        <a href="/admin/dashboard">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="/admin/pengajuan">
            <i class="bi bi-file-earmark-text"></i> Pengajuan Surat
        </a>

        <a href="/admin/pengaduan">
            <i class="bi bi-flag"></i> Pengaduan
        </a>

        <a href="/admin/berita">
            <i class="bi bi-newspaper"></i> Berita
        </a>
        <a href="/admin/arsip">
    <i class="bi bi-archive"></i> Riwayat Pengajuan Surat
</a>
<a href="{{ route('admin.pengaduan.arsip') }}">
    <i class="bi bi-archive"></i> Riwayat Pengaduan
</a>
<a href="{{ route('admin.history') }}">
    <i class="bi bi-clock-history"></i> Log Nomor Surat
</a>

        <a href="/admin/statistik">
            <i class="bi bi-bar-chart"></i> Statistik
        </a>

        <a href="/admin/akun">
    <i class="bi bi-person-gear"></i> Akun Saya
</a>
    </div>

    <!-- LOGOUT -->
    <div class="logout">
    <a href="#" onclick="confirmLogout(event)">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

</div>

<!-- CONTENT -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-list toggle-btn" onclick="openSidebar()"></i>
            <b>Kelurahan Sekarjaya</b>
        </div>

<div class="d-flex align-items-center gap-3">

    <!-- 🔔 NOTIF -->
    <div style="position: relative;">
        <i class="bi bi-bell fs-5" style="cursor:pointer;" onclick="toggleNotif()"></i>

        <!-- ANGKA MERAH -->
        <span id="notifBadge"
    style="position:absolute; top:-5px; right:-8px; background:red; color:white; font-size:10px; padding:3px 6px; border-radius:50%;
    {{ $unread == 0 ? 'display:none;' : '' }}">
    {{ $unread }}
</span>

        <!-- DROPDOWN -->
        <div id="notifDropdown" class="notif-dropdown">

    <!-- HEADER -->
<div class="notif-header d-flex justify-content-between align-items-center">
    <b>Notifikasi</b>

    <!-- tombol close semua device -->
    <i class="bi bi-x-lg"
       onclick="toggleNotif()"
       style="cursor:pointer;"></i>
</div>
    <!-- TAB -->
    <div class="notif-tabs">
        <button class="active" onclick="setFilter('hari', this)">Hari Ini</button>

<button onclick="setFilter('bulan', this)">Bulan Ini</button>
    </div>

    <!-- LIST -->
    <div id="notifList" class="notif-list">

  @forelse($notifs as $notif)
<div class="notif-item {{ $notif->is_read ? '' : 'notif-unread' }}"
     data-date="{{ $notif->created_at }}">
    
    <div class="d-flex justify-content-between align-items-center">

        <!-- KIRI (TEXT) -->
        <div style="flex:1; padding-right:10px;">
            <div class="fw-bold mb-1">
                {{ $notif->title }}
            </div>

            <div style="font-size:13px; color:#555;">
                {{ $notif->message }}
            </div>

            <small class="text-muted">
                {{ $notif->created_at->diffForHumans() }}
            </small>
        </div>

        <!-- KANAN (BUTTON) -->
        <div class="d-flex gap-1 align-items-center">

            <!-- LIHAT -->
            <a href="{{ route('admin.notif.show', $notif->id) }}" 
   class="btn btn-sm {{ $notif->is_read ? 'btn-success' : 'btn-secondary' }}">
    <i class="bi bi-eye"></i>
</a>
            <!-- HAPUS -->
            <button onclick="hapusNotif({{ $notif->id }})" 
                    class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
            </button>

        </div>

    </div>

</div>
@empty
<div class="text-center text-muted p-3">
    Tidak ada notifikasi
</div>
@endforelse

</div>


<!-- FOOTER FIX -->
<div class="notif-footer border-top bg-light p-2">
    <a href="{{ route('admin.notif.all') }}"
       class="btn btn-success btn-sm w-100">
        <i class="bi bi-bell"></i> Lihat Semua Notifikasi
    </a>
</div>
</div>
    </div>

    <!-- ADMIN -->
    <div>
        <i class="bi bi-person-circle"></i> Admin
    </div>

</div>

    </div>

    @yield('content')

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function openSidebar() {
    document.getElementById('sidebar').classList.add('show');
    document.getElementById('overlay').classList.add('show');
}

function closeSidebar() {
    document.getElementById('sidebar').classList.remove('show');
    document.getElementById('overlay').classList.remove('show');
}
</script>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleNotif() {
    const el = document.getElementById('notifDropdown');
    el.style.display = (el.style.display === 'block') ? 'none' : 'block';
}
</script>

<script>
let audioUnlocked = false;

// 🔓 unlock audio setelah klik pertama
document.addEventListener('click', function () {
    if (!audioUnlocked) {
        const audio = new Audio("{{ asset('sound/notif.mp3') }}");
        audio.play().then(() => {
            audio.pause();
            audio.currentTime = 0;
            audioUnlocked = true;
        }).catch(() => {});
    }
});
</script>



<script>
function confirmLogout(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Keluar dari akun?',
        text: 'Sesi login akan diakhiri',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, keluar',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/logout"; // 🔥 tetap GET
        }
    });
}



</script>

<script>
function setFilter(type, el) {

    // tombol aktif
    document.querySelectorAll('.notif-tabs button').forEach(btn => {
        btn.classList.remove('active');
    });
    el.classList.add('active');

    const now = new Date();

    document.querySelectorAll('.notif-item').forEach(item => {

        const notifDate = new Date(item.dataset.date);
        let show = false;

        // 🔥 HARI INI
        if (type === 'hari') {
            show =
                notifDate.getDate() === now.getDate() &&
                notifDate.getMonth() === now.getMonth() &&
                notifDate.getFullYear() === now.getFullYear();
        }

        // 🔥 MINGGU INI
        else if (type === 'minggu') {
            const firstDay = new Date(now);
            const day = now.getDay() || 7;
            firstDay.setDate(now.getDate() - day + 1);

            show = notifDate >= firstDay && notifDate <= now;
        }

        // 🔥 BULAN INI
        else if (type === 'bulan') {
            show =
                notifDate.getMonth() === now.getMonth() &&
                notifDate.getFullYear() === now.getFullYear();
        }

        item.style.display = show ? 'block' : 'none';
    });
}
</script>

<script>
function hapusNotif(id) {
    Swal.fire({
        title: 'Hapus notifikasi?',
        text: "Data ini akan dihapus permanen",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            // 🔄 loading biar keliatan niat
            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('/admin/notifikasi/delete/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {

                // ✅ sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Notifikasi berhasil dihapus',
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

<!-- 🔥 MOBILE BOTTOM NAV -->
<div class="bottom-nav d-md-none">

    <a href="/admin/pengaduan">
        <i class="bi bi-flag"></i>
        <span>Pengaduan</span>
    </a>

    <a href="/admin/pengajuan">
        <i class="bi bi-file-earmark-text"></i>
        <span>Pengajuan</span>
    </a>

    <a href="/admin/dashboard" class="nav-home">
        <i class="bi bi-house-door-fill"></i>
    </a>

    <a href="/admin/akun">
        <i class="bi bi-person"></i>
        <span>Akun</span>
    </a>

    <a href="javascript:history.back()">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali</span>
    </a>

</div>

</body>
</html>

</body>
</html>