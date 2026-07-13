<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratDomisiliController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\SuratUsahaController;
use App\Http\Controllers\SuratTidakMampuController;
use App\Http\Controllers\SuratKelahiranController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\BeritaController as AdminBerita;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\Admin\StatistikController as AdminStatistik;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\NotifikasiController;



// --------------------------------------------------------------------------
// WEB ROUTES
// --------------------------------------------------------------------------
// ================= BERANDA =================


Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});


// ================= USER =================

// FORM PENGAJUAN DOMISILI
Route::get('/domisili', [SuratDomisiliController::class, 'create'])->name('domisili.form');
Route::post('/domisili/store', [SuratDomisiliController::class, 'store'])->name('domisili.store');

// CEK STATUS
Route::get('/cek-status', [SuratDomisiliController::class, 'formCek'])->name('cek.form');
Route::post('/cek-status', [SuratDomisiliController::class, 'cekStatus'])->name('cek.proses');

// Form Surat Usaha
Route::get('/usaha', [SuratUsahaController::class, 'create'])->name('usaha.form');
Route::post('/usaha/store', [SuratUsahaController::class, 'store'])->name('usaha.store');

// ✅ FORM PENGAJUAN SURAT TIDAK MAMPU
Route::get('/tidak-mampu', [SuratTidakMampuController::class, 'create'])->name('tidak-mampu.form');
Route::post('/tidak-mampu/store', [SuratTidakMampuController::class, 'store'])->name('tidak-mampu.store');

// Form Surat Kelahiran
Route::get('/kelahiran', [SuratKelahiranController::class, 'create'])->name('kelahiran.form');
Route::post('/kelahiran/store', [SuratKelahiranController::class, 'store'])->name('kelahiran.store');

// FORM INPUT PENGADUAN
Route::get('/pengaduan', [PengaduanController::class, 'create'])->name('pengaduan.form');
Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

// FORM CEK STATUS PENGADUAN
Route::get('/cek-status-pengaduan', [PengaduanController::class, 'formCek'])->name('pengaduan.cek.form');
Route::post('/cek-status-pengaduan', [PengaduanController::class, 'cekStatus'])->name('pengaduan.cek.proses');

Route::get('/peta', function () {
    return view('peta');
});

Route::get('/riwayat-surat/{nik}', [SuratDomisiliController::class, 'riwayat'])
    ->name('riwayat.surat');
    
Route::get('/visi-misi', function () {
    return view('visi_misi');
});

Route::get('/sejarah', function () {
    return view('sejarah');
});

Route::get('/statistik', [StatistikController::class, 'index']);



// berita//

// DETAIL BERITA (USER)
Route::get('/berita/{slug}', [BeritaController::class, 'show']);

Route::get('/', [BeritaController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);
// ================= ADMIN =================
// ================= ADMIN =================

// 🔓 LOGIN (TIDAK DIKUNCI)
Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);

});


// 🔒 SEMUA INI WAJIB LOGIN
Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    // ================= AKUN ADMIN =================
Route::get('/akun', [AuthController::class, 'profile'])->name('admin.akun');
Route::post('/akun/update', [AuthController::class, 'updateProfile'])->name('admin.akun.update');

    // ================= PENGAJUAN =================
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan');

    Route::post('/proses/{jenis}/{id}', [PengajuanController::class, 'proses'])->name('admin.proses');

    Route::get('/edit/{jenis}/{id}', [PengajuanController::class, 'edit'])->name('admin.edit');

    Route::post('/update/{jenis}/{id}', [PengajuanController::class, 'update'])->name('admin.update');

    Route::get('/generate/{jenis}/{id}', [PengajuanController::class, 'generate'])->name('admin.generate');

    Route::post('/final/{jenis}/{id}', [PengajuanController::class, 'final'])->name('admin.final');

    Route::get('/tolak/{jenis}/{id}', [PengajuanController::class, 'formTolak'])->name('admin.tolak.form');

    Route::post('/tolak/{jenis}/{id}', [PengajuanController::class, 'tolak'])->name('admin.tolak');

    Route::delete('/hapus/{jenis}/{id}', [PengajuanController::class, 'hapus'])->name('admin.hapus');

    Route::get('/pdf/{jenis}/{id}', [PengajuanController::class, 'pdf'])->name('admin.pdf');

    Route::post('/set-nomor-awal', [PengajuanController::class, 'setNomorAwal'])
    ->name('admin.setNomorAwal');
    Route::get('/generate-nomor/{jenis}/{id}', [PengajuanController::class, 'generateNomor']);
   Route::get('/cek-nomor', [PengajuanController::class, 'cekNomor']);
   Route::get('/arsip', [PengajuanController::class, 'arsip'])
    ->name('admin.arsip');
   Route::post('/reset-nomor', [PengajuanController::class, 'resetNomor']);
// 🔔 preview notif kecil dropdown
Route::get('/notifikasi', [NotifikasiController::class, 'index']);
// 🗑 hapus semua notif
Route::delete('/notifikasi/hapus-semua', [NotifikasiController::class, 'deleteAll']);

// 🔥 halaman semua notif
Route::get('/notifikasi/all', [NotifikasiController::class, 'all'])
    ->name('admin.notif.all');

// ✅ tandai dibaca
Route::post('/notifikasi/read/{id}', [NotifikasiController::class, 'read']);

// 🗑 hapus notif
Route::delete('/notifikasi/delete/{id}', [NotifikasiController::class, 'delete']);

// 👁 lihat detail notif
Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])
    ->name('admin.notif.show');

    // ================= PENGADUAN =================
    Route::get('/pengaduan', [AdminPengaduan::class, 'index'])->name('admin.pengaduan');

    Route::post('/pengaduan/proses/{id}', [AdminPengaduan::class, 'proses'])->name('admin.pengaduan.proses');

    Route::post('/pengaduan/selesai/{id}', [AdminPengaduan::class, 'selesai'])->name('admin.pengaduan.selesai');

    Route::delete('/pengaduan/hapus/{id}', [AdminPengaduan::class, 'hapus'])->name('admin.pengaduan.hapus');

    Route::get('/pengaduan/detail/{id}', [AdminPengaduan::class, 'detail'])->name('admin.pengaduan.detail');

    Route::get('/pengaduan/tanggapi/{id}', [AdminPengaduan::class, 'formTanggapi'])->name('admin.pengaduan.tanggapi');

    Route::post('/pengaduan/kirim-tanggapan/{id}', [AdminPengaduan::class, 'kirimTanggapan'])->name('admin.pengaduan.kirim');
 // FORM TOLAK (buka halaman)
Route::get('/pengaduan/tolak/{id}', [AdminPengaduan::class, 'formTolak'])
    ->name('admin.pengaduan.tolak');

// PROSES TOLAK (submit form)
Route::post('/pengaduan/tolak/{id}', [AdminPengaduan::class, 'tolak'])
    ->name('admin.pengaduan.tolak.kirim');

    Route::get('/history-surat', [PengajuanController::class, 'history'])
    ->name('admin.history');
Route::post('/ambil-nomor', [PengajuanController::class, 'ambilNomorManual']);

Route::get('/pengaduan/arsip', [AdminPengaduan::class, 'arsip'])
    ->name('admin.pengaduan.arsip');

    // ================= BERITA =================
    Route::get('/berita', [AdminBerita::class, 'index']);
    Route::get('/berita/create', [AdminBerita::class, 'create']);
    Route::post('/berita/store', [AdminBerita::class, 'store']);
    Route::get('/berita/edit/{id}', [AdminBerita::class, 'edit']);
    Route::post('/berita/update/{id}', [AdminBerita::class, 'update']);
    Route::get('/berita/delete/{id}', [AdminBerita::class, 'delete']);


    // ================= STATISTIK =================
    Route::get('/statistik', [AdminStatistik::class, 'index']);
    Route::get('/statistik/create', [AdminStatistik::class, 'create']);
    Route::post('/statistik/store', [AdminStatistik::class, 'store']);

Route::get('/statistik/edit', [AdminStatistik::class, 'edit']);
Route::post('/statistik/update', [AdminStatistik::class, 'update']);
Route::delete('/statistik/delete/{id}', [AdminStatistik::class, 'destroy']);

    // 🔔 CEK NOTIF SURAT MASUK
Route::get('/cek-surat', function () {

    $data1 = DB::table('surat_domisilis')
        ->where('status_surat', 'pending')
        ->latest()->first();

    $data2 = DB::table('surat_usaha')
        ->where('status_surat', 'pending')
        ->latest()->first();

    $data3 = DB::table('surat_tidak_mampu')
        ->where('status_surat', 'pending')
        ->latest()->first();

    $data4 = DB::table('surat_kelahiran')
        ->where('status_surat', 'pending')
        ->latest()->first();

    $all = collect([
        $data1 ? (object)[
            'nama' => $data1->nama,
            'jenis' => 'Domisili',
            'created_at' => $data1->created_at
        ] : null,

        $data2 ? (object)[
            'nama' => $data2->nama,
            'jenis' => 'Usaha',
            'created_at' => $data2->created_at
        ] : null,

        $data3 ? (object)[
            'nama' => $data3->nama,
            'jenis' => 'Tidak Mampu',
            'created_at' => $data3->created_at
        ] : null,

        $data4 ? (object)[
            'nama' => $data4->nama,
            'jenis' => 'Kelahiran',
            'created_at' => $data4->created_at
        ] : null,

    ])->filter()->sortByDesc('created_at')->first();

    if ($all) {
        return response()->json([
            'status' => true,
            'nama' => $all->nama,
            'jenis' => $all->jenis,
            'created_at' => $all->created_at
        ]);
    }

    return response()->json(['status' => false]);
});


    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

});