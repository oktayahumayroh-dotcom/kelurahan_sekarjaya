<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // 🔥 INI YANG KURANG
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {

            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()
            ->with('error', 'Username atau password salah')
            ->withInput($request->only('username'));
    }

 public function dashboard()
{
    // ================= SURAT =================

    // TOTAL
    $total =
        DB::table('surat_domisilis')->count() +
        DB::table('surat_usaha')->count() +
        DB::table('surat_tidak_mampu')->count() +
        DB::table('surat_kelahiran')->count();

    // PENDING
    $pending =
        DB::table('surat_domisilis')->where('status_surat', 'pending')->count() +
        DB::table('surat_usaha')->where('status_surat', 'pending')->count() +
        DB::table('surat_tidak_mampu')->where('status_surat', 'pending')->count() +
        DB::table('surat_kelahiran')->where('status_surat', 'pending')->count();

    // PROSES
    $proses =
        DB::table('surat_domisilis')->where('status_surat', 'proses')->count() +
        DB::table('surat_usaha')->where('status_surat', 'proses')->count() +
        DB::table('surat_tidak_mampu')->where('status_surat', 'proses')->count() +
        DB::table('surat_kelahiran')->where('status_surat', 'proses')->count();

    // SELESAI
    $selesai =
        DB::table('surat_domisilis')->where('status_surat', 'selesai')->count() +
        DB::table('surat_usaha')->where('status_surat', 'selesai')->count() +
        DB::table('surat_tidak_mampu')->where('status_surat', 'selesai')->count() +
        DB::table('surat_kelahiran')->where('status_surat', 'selesai')->count();

    // DITOLAK
    $ditolak =
        DB::table('surat_domisilis')->where('status_surat', 'ditolak')->count() +
        DB::table('surat_usaha')->where('status_surat', 'ditolak')->count() +
        DB::table('surat_tidak_mampu')->where('status_surat', 'ditolak')->count() +
        DB::table('surat_kelahiran')->where('status_surat', 'ditolak')->count();

    // ================= PENGADUAN =================

    $pengaduan_pending = DB::table('pengaduans')->where('status', 'pending')->count();

    $pengaduan_proses = DB::table('pengaduans')->where('status', 'proses')->count();

    $pengaduan_selesai = DB::table('pengaduans')->where('status', 'selesai')->count();

    $total_pengaduan = DB::table('pengaduans')->count();

    return view('admin.dashboard', compact(
        'total',
        'pending',
        'proses',
        'selesai',
        'ditolak',
        'pengaduan_pending',
        'pengaduan_proses',
        'pengaduan_selesai',
        'total_pengaduan' // 🔥 INI YANG TADI ERROR
    ));
}

public function profile()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.akun', compact('admin'));
}

public function updateProfile(Request $request)
{
    /** @var \App\Models\Admin $admin */
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'username' => 'required|max:255',
        'old_password' => 'nullable',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $admin->username = $request->username;

    if ($request->password) {
        if (!Hash::check($request->old_password, $admin->password)) {
            return back()->with('error', 'Password lama salah');
        }

        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return back()->with('success', 'Akun berhasil diperbarui');
}

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}