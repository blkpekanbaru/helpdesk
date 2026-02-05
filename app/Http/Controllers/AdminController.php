<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Pengaduan;
use App\Models\Proyek;
use App\Models\Teknisi;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function pengguna()
    {
        $user = User::where('role', '!=', 'admin')->get();
        return view('admin.user.tampil_data', compact('user'));
    }

    public function store_pengguna(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
            'password' => bcrypt('123456'), // Password default
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function destroy_pengguna($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success_delete_user', 'User berhasil dihapus');
    }

    public function pekerjaan()
    {
        $teknisi = Teknisi::with('proyek')->get();
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
            'bukti'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'status'      => $request->status,
            'tgl_mulai'   => $request->tgl_mulai,
            'deadline'    => $request->deadline,
        ]);

        if ($request->hasFile('bukti')) {

            // hapus file lama (jika ada)
            if ($proyek->bukti && Storage::exists('public/bukti/' . $proyek->bukti)) {
                Storage::delete('public/bukti/' . $proyek->bukti);
            }

            $file = $request->file('bukti');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/bukti', $namaFile);

            $proyek->update([
                'bukti' => $namaFile
            ]);
        }

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

    public function lokasi()
    {
        $lokasi = Lokasi::all();
        return view('admin.lokasi.tampil_data', compact('lokasi'));
    }

    public function store_lokasi(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'gedung'  => 'required|string|max:100',
            'ruangan' => 'required|string|max:100',
            'status'  => 'required|in:0,1',
        ]);

        // 2. Generate token QR unik
        do {
            $token = Str::random(32);
        } while (Lokasi::where('qr_token', $token)->exists());

        // 3. Simpan ke database
        Lokasi::create([
            'gedung'   => $request->gedung,
            'ruangan'  => $request->ruangan,
            'qr_token' => $token,
            'status'   => $request->status,
        ]);

        // 4. Redirect
        return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan & QR Token dibuat.');
    }

    public function update_lokasi(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'gedung'  => 'required|string|max:100',
            'ruangan' => 'unique:lokasis,ruangan,' . $id,
            'status'  => 'required|in:0,1',
        ]);

        // 2. Ambil data lokasi
        $lokasi = Lokasi::findOrFail($id);

        // 3. Update data (QR token tidak diubah)
        $lokasi->update([
            'gedung'  => $request->gedung,
            'ruangan' => $request->ruangan,
            'status'  => $request->status,
        ]);

        // 4. Redirect
        return redirect()
            ->back()
            ->with('success_update_lokasi', 'Lokasi berhasil diperbarui.');
    }

    public function destroy_lokasi($id)
    {
        Lokasi::findOrFail($id)->delete();

        return back()->with('success_delete_lokasi', 'Teknisi berhasil dihapus');
    }

    public function generateQr($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $urlPengaduan = url('/pengaduan?token=' . $lokasi->qr_token);

        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data="
            . urlencode($urlPengaduan);

        $image = Http::get($qrUrl)->body();

        return response($image)
            ->header('Content-Type', 'image/png')
            ->header(
                'Content-Disposition',
                'attachment; filename="QR-' . $lokasi->gedung . '.png"'
            );
    }


    // laporan
    public function laporan(Request $request)
    {
        $laporan = collect();

        // hanya jalan kalau tombol filter ditekan
        if ($request->filled('tgl_mulai') || $request->filled('deadline')) {

            $query = Proyek::query();

            if ($request->filled('tgl_mulai')) {
                $query->whereDate('tgl_mulai', '>=', $request->tgl_mulai);
            }

            if ($request->filled('deadline')) {
                $query->whereDate('deadline', '<=', $request->deadline);
            }

            $laporan = $query->get();
        }

        return view('admin.laporan.laporan', compact('laporan'));
    }

    public function tampil_pesan($id)
    {
        $teknisi = Teknisi::with('proyek')->findOrFail($id);
        $proyek = Proyek::where('pic', $teknisi->id)->first();
        return view('admin.pekerjaan.kirim_pesan', compact('teknisi', 'proyek'));
    }

    public function kirim_pesan(Request $request)
    {
        $token = "NXA2LKAMfwhw7F9afon7";

        $target = $request->no_hp;   // nomor tujuan
        // $target = "083809808665";
        $pesan  = $request->pesan;    // isi pesan

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => $pesan,
                'delay' => '2',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error_msg = curl_error($curl);
        curl_close($curl);

        if ($error_msg || $httpCode != 200) {
            return redirect()->route('ShowPekerjaan')->with('error_kirim_pesan', 'Gagal kirim pesan!');
        }

        return redirect()->route('ShowPekerjaan')->with('success_kirim_pesan', 'Pesan berhasil dikirim!');
    }

    public function broadcast_pesan(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduans,id',
        ]);

        // 🔑 ambil proyek
        $pengaduan = Pengaduan::findOrFail($request->pengaduan_id);

        $users = User::whereNotNull('no_hp')->get();

        foreach ($users as $user) {
            $noHp = preg_replace('/^0/', '62', $user->no_hp);

            $pesan =
                "Halo " . $user->username . ", 👋\n\n"
                . "Anda mendapat *laporan kerusakan baru*.\n\n"
                . "📌 Proyek : " . $pengaduan->nama . "\n"
                . "📍 Gedung: " . $pengaduan->gedung . "\n"
                . "📍 Ruangan: " . $pengaduan->ruangan . "\n"
                . "📝 Detail : " . $pengaduan->deskripsi . "\n\n"
                . "Mohon segera ditindaklanjuti.\n"
                . "Terima kasih 🙏";

            WhatsAppService::send($noHp, $pesan);

            sleep(1);
        }

        return back()->with('success_broadcast', 'Broadcast WhatsApp berhasil dikirim');
    }
}
