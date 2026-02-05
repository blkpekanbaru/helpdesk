<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Proyek;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeknisiController extends Controller
{
    public function index()
    {
        $totalProyek = Proyek::count();

        $belumSelesai = Proyek::whereIn('status', [0, 1, 2])->count();
        $progress     = Proyek::where('status', 1)->count();
        $pending      = Proyek::where('status', 2)->count();
        $selesai      = Proyek::where('status', 3)->count();

        return view('teknisi.dashboard', compact(
            'totalProyek',
            'belumSelesai',
            'progress',
            'pending',
            'selesai'
        ));
    }

    public function tugas()
    {
        $teknisi = Teknisi::where('id', auth()->id())->first();

        if (!$teknisi) {
            return redirect()->back()->with('error', 'Anda bukan teknisi');
        }

        $proyek = Proyek::where('pic', $teknisi->id)->get();

        return view('teknisi.tugas.tampil_data', compact('proyek'));
    }

    public function update_tugas(Request $request, $id)
    {
        // Ambil data proyek
        $proyek = Proyek::findOrFail($id);

        // Validasi
        $request->validate([
            'status' => 'required|in:0,1,2,3',
            'catatan'  => $request->status == 2 ? 'required|string' : 'nullable|string',
            'bukti'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Jika upload bukti baru
        if ($request->hasFile('bukti')) {

            // Hapus bukti lama jika ada
            if ($proyek->bukti && Storage::exists('public/bukti/' . $proyek->bukti)) {
                Storage::delete('public/bukti/' . $proyek->bukti);
            }

            // Simpan bukti baru
            $file = $request->file('bukti');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti', $namaFile);

            $proyek->bukti = $namaFile;
        }

        // Update status
        $proyek->status = $request->status;

        if ($request->status == 2) {
            $proyek->catatan = $request->catatan;
        } else {
            $proyek->catatan = null;
        }

        $proyek->save();

        return redirect()->back()->with('success_update_tugas', 'Proyek berhasil diperbarui');
    }

    public function update_pelaporan(Request $request, $id)
    {
        $pelaporan = Pengaduan::findOrFail($id);

        // Validasi
        $request->validate([
            'status' => 'required|in:0,1,2,3',
            'catatan'  => $request->status == 2 ? 'required|string' : 'nullable|string',
            'bukti'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Jika upload bukti baru
        if ($request->hasFile('bukti')) {

            // Hapus bukti lama jika ada
            if ($pelaporan->bukti && Storage::exists('public/bukti/' . $pelaporan->bukti)) {
                Storage::delete('public/bukti/' . $pelaporan->bukti);
            }

            // Simpan bukti baru
            $file = $request->file('bukti');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti', $namaFile);

            $pelaporan->bukti = $namaFile;
        }

        // Update status
        $pelaporan->status = $request->status;

        if ($request->status == 2) {
            $pelaporan->catatan = $request->catatan;
        } else {
            $pelaporan->catatan = null;
        }

        $pelaporan->save();

        return redirect()->back()->with('success_update_pelaporan', 'Pelaporan berhasil diperbarui');
    }

    public function pelaporan()
    {
        $pelaporan = Pengaduan::all();
        return view('teknisi.pelaporan.tampil_data', compact('pelaporan'));
    }
}
