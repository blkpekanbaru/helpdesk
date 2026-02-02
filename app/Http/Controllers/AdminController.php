<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Proyek;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::all();
        $proyek = Proyek::with('teknisi')
            ->whereIn('status', [0, 1])
            ->get();
        return view('admin.dashboard', compact('pengaduan', 'proyek'));
    }

    public function pekerjaan()
    {
        $teknisi = Teknisi::all();
        $proyek = Proyek::with('teknisi')
            ->whereIn('status', [0, 1])
            ->get();

        $history = Proyek::with('teknisi')
            ->whereNotIn('status', [0, 1])
            ->get();
        return view('admin.pekerjaan.tampil_data', compact('teknisi', 'proyek', 'history'));
    }

    public function tambahPekerjaan()
    {
        $teknisi = Teknisi::all();
        return view('admin.pekerjaan.tambah_data', compact('teknisi'));
    }

    public function storePekerjaan(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'pic'         => 'required|string',
            'tgl_mulai'   => 'required|date',
            'deadline'    => 'required|date|after_or_equal:tgl_mulai',
        ]);

        Proyek::create($request->all());

        return redirect()->route('ShowPekerjaan')->with('success', 'Proyek berhasil disimpan');
    }

    public function editPekerjaan($id)
    {
        $proyek = Proyek::findOrFail($id);
        $teknisi = Teknisi::all();
        return view('admin.pekerjaan.edit_data', compact('proyek', 'teknisi'));
    }

    public function updatePekerjaan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'pic'         => 'required|exists:teknisis,id',
            'tgl_mulai'   => 'required|date',
            'deadline'    => 'required|date|after_or_equal:tgl_mulai',
        ]);

        // Ambil proyek berdasarkan id
        $proyek = Proyek::findOrFail($id);

        // Update data
        $proyek->update([
            'nama_proyek' => $request->nama_proyek,
            'deskripsi'   => $request->deskripsi,
            'pic'         => $request->pic,
            'tgl_mulai'   => $request->tgl_mulai,
            'deadline'    => $request->deadline,
        ]);

        // Redirect balik dengan pesan sukses
        return redirect()->route('ShowPekerjaan')->with('success_update_proyek', 'Proyek berhasil diperbarui.');
    }

    public function destroyPekerjaan($id)
    {
        Proyek::findOrFail($id)->delete();

        return back()->with('success_delete_proyek', 'Teknisi berhasil dihapus');
    }

    public function storeTeknisi(Request $request)
    {
        $request->validate([
            'nama_teknisi' => 'required',
            'no_hp' => 'required',
            'tugas' => 'nullable'
        ]);

        Teknisi::create($request->all());

        return back()->with('success_teknisi', 'Teknisi berhasil ditambahkan');
    }

    public function updateTeknisi(Request $request, $id)
    {
        $teknisi = Teknisi::findOrFail($id);
        $teknisi->update($request->all());

        return back()->with('success_update_teknisi', 'Teknisi berhasil diupdate');
    }

    public function destroyTeknisi($id)
    {
        Teknisi::findOrFail($id)->delete();

        return back()->with('success_delete_teknisi', 'Teknisi berhasil dihapus');
    }

    public function pelatihan()
    {
        return view('admin.pelatihan.tampil_data');
    }


    // laporan
    public function laporan(Request $request)
    {
        $query = Proyek::select(
            'nama_proyek',
            'deskripsi',
            'status',
            'tgl_mulai',
            'deadline'
        );

        if ($request->filled('tgl_mulai')) {
            $query->whereDate('tgl_mulai', $request->tgl_mulai);
        }

        if ($request->filled('deadline')) {
            $query->whereDate('deadline', $request->deadline);
        }

        $laporan = $query->get();

        return view('admin.laporan.laporan', compact('laporan'));
    }
}
