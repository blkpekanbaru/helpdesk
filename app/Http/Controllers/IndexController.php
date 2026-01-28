<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('pengaduan');
    }

    public function store_pengaduan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gedung' => 'required|string|max:50',
            'ruangan' => 'nullable|string|max:100',
            'fasilitas' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        // Upload file jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('uploads', 'public');
            $validated['foto'] = basename($path); // simpan nama file
        }

        Pengaduan::create($validated);

        // Redirect atau kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }
}
