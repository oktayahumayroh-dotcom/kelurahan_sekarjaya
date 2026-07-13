<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistic;

class StatistikController extends Controller
{
    // =======================
    // INDEX (TAMPIL DATA)
    // =======================
    public function index()
    {
        $penduduk = Statistic::where('key', 'penduduk')->first();
        $rt = Statistic::where('key', 'rt')->first();
        $rw = Statistic::where('key', 'rw')->first();

        return view('admin.statistik.index', compact('penduduk', 'rt', 'rw'));
    }

    // =======================
    // FORM EDIT (1 FORM SEMUA DATA)
    // =======================
    public function edit()
    {
        $penduduk = Statistic::where('key', 'penduduk')->first();
        $rt = Statistic::where('key', 'rt')->first();
        $rw = Statistic::where('key', 'rw')->first();

        return view('admin.statistik.edit', compact('penduduk', 'rt', 'rw'));
    }

    // =======================
    // UPDATE SEMUA DATA SEKALIGUS
    // =======================
    public function update(Request $request)
{
    $request->validate([
        'penduduk' => 'required',
        'rt' => 'required',
        'rw' => 'required',
    ]);

    Statistic::updateOrCreate(
    ['key' => 'penduduk'],
    [
        'name' => 'penduduk',
        'value' => str_replace('.', '', $request->penduduk)
    ]
);

Statistic::updateOrCreate(
    ['key' => 'rt'],
    [
        'name' => 'rt',
        'value' => str_replace('.', '', $request->rt)
    ]
);

Statistic::updateOrCreate(
    ['key' => 'rw'],
    [
        'name' => 'rw',
        'value' => str_replace('.', '', $request->rw)
    ]
);
    return redirect('/admin/statistik')->with('success', 'Semua data berhasil diupdate');
}
    // =======================
    // DELETE (opsional)
    // =======================
    public function destroy($id)
    {
        $data = Statistic::findOrFail($id);
        $data->delete();

        return redirect('/admin/statistik')->with('success', 'Data berhasil dihapus');
    }
}