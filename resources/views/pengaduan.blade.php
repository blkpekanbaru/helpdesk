<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Kerusakan Fasilitas</title>
    <link rel="icon" href="{{ asset('template/dist/assets/images/logo_satpel_mini.png')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --background: #f8fafc;
            --foreground: #0f172a;
            --card: #ffffff;
            --card-foreground: #0f172a;
            --popover: #ffffff;
            --popover-foreground: #0f172a;
            --primary: #2563eb;
            --primary-foreground: #ffffff;
            --secondary: #f8fafc;
            --secondary-foreground: #0f172a;
            --muted: #f1f5f9;
            --muted-foreground: #64748b;
            --accent: #f97316;
            --accent-foreground: #ffffff;
            --border: #e2e8f0;
        }

        body {
            background-color: var(--background);
            color: var(--foreground);
        }

        .border-color {
            border-color: var(--border);
        }

        .text-accent {
            color: var(--accent);
        }

        .bg-muted {
            background-color: var(--muted);
        }

        .text-muted-foreground {
            color: var(--muted-foreground);
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        .hidden-file {
            display: none;
        }

        .success-message {
            display: none;
        }

        .success-message.show {
            display: flex;
        }

        .loading-spinner {
            display: none;
        }

        .loading-spinner.show {
            display: inline-block;
        }

        .success-message {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen py-8 px-4 sm:px-6 lg:px-8 bg-no-repeat bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('template/dist/assets/images/kantor.jpeg') }}');">
    <div class="mx-auto max-w-2xl">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('template/dist/assets/images/logo_satpel_mini.png')}}"
                alt="Logo BLK"
                class="w-1/5">
        </div>
        <!-- Header -->
        <div class="mb-8 rounded-xl bg-white/90 p-6 text-center shadow-lg backdrop-blur-sm">
            <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">
                Lapor Kerusakan Fasilitas
            </h1>
            <p class="mt-2 text-slate-600">
                Kami siap membantu memperbaiki fasilitas yang rusak dengan cepat
            </p>
        </div>


        <!-- Success Message -->
        @if (session('success'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Berhasil!",
                text: "Laporan Anda akan kami tangani 1 x 24 jam",
                showConfirmButton: true,
            });
        </script>
        @endif
        @if (session('error_pengaduan'))
        <script>
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Kesalahan!",
                text: "Token tidak valid atau lokasi tidak aktif",
                showConfirmButton: true,
            });
        </script>
        @endif

        <!-- Form Card -->
        <div class="rounded-xl border border-slate-200 bg-white shadow-lg">
            <!-- Card Header -->
            <div class="border-b border-slate-200 bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-6 sm:px-8">
                <h2 class="text-xl font-semibold text-white">
                    Form Pengaduan
                </h2>
                <p class="mt-1 text-sm text-blue-100">
                    Mohon isi semua data yang diperlukan dengan lengkap dan akurat
                </p>
            </div>

            <!-- Form Content -->
            <form id="complaintForm" action="{{route('postPengaduan')}}" class="space-y-6 p-6 sm:p-8" enctype="multipart/form-data" method="post">
                <!-- Nama Pelapor -->
                @csrf
                <input type="hidden" name="lokasi_id" value="{{ $lokasi->id }}">
                <div>
                    <label for="nama" class="block text-sm font-semibold text-slate-900">
                        Nama Pelapor <span class="text-orange-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder-slate-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>

                <!-- Unit / Ruangan -->
                <div>
                    <label for="gedung" class="block text-sm font-semibold text-slate-900">
                        Gedung <span class="text-orange-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="gedung"
                        name="gedung"
                        value="{{$lokasi->gedung}}"
                        readonly
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder-slate-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />

                </div>

                <div>
                    <label for="ruangan" class="block text-sm font-semibold text-slate-900">
                        Ruangan <span class="text-orange-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="ruangan"
                        name="ruangan"
                        value="{{$lokasi->ruangan}}"
                        readonly
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder-slate-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>

                <!-- Jenis Fasilitas -->
                <div>
                    <label for="fasilitas" class="block text-sm font-semibold text-slate-900">
                        Jenis Fasilitas <span class="text-orange-500">*</span>
                    </label>
                    <select
                        id="fasilitas"
                        name="fasilitas"
                        required
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">-- Pilih Fasilitas --</option>
                        <option value="Listrik">Listrik</option>
                        <option value="AC">AC</option>
                        <option value="Komputer">Komputer</option>
                        <option value="Jaringan / Internet">Jaringan / Internet</option>
                        <option value="Bangunan">Bangunan</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-slate-900">
                        Deskripsi Kerusakan <span class="text-orange-500">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        placeholder="Jelaskan secara detail kerusakan yang terjadi dan dampaknya"
                        rows="5"
                        required
                        class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder-slate-500 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                </div>

                <!-- Upload Foto -->
                <div>
                    <label for="foto" class="block text-sm font-semibold text-slate-900">
                        Upload Foto Kerusakan
                    </label>
                    <div class="mt-2 flex flex-col gap-3">
                        <label class="flex cursor-pointer items-center justify-center gap-2 rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 py-8 px-4 transition-all hover:border-blue-500 hover:bg-blue-50">
                            <svg class="h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <div class="text-center">
                                <p class="text-sm font-medium text-slate-900">
                                    Klik untuk upload atau drag & drop
                                </p>
                                <p class="text-xs text-slate-500">
                                    <span id="fileInfo">Format JPG / PNG, max 2MB</span>
                                </p>
                            </div>
                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                accept="image/*"
                                class="hidden-file" />
                        </label>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="flex gap-3 rounded-lg border border-blue-200 bg-blue-50 p-4 text-blue-900">
                    <svg class="h-5 w-5 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p class="text-sm">
                        Pastikan semua data terisi dengan benar. Tim maintenance kami
                        akan merespon dalam waktu maksimal 24 jam.
                    </p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 py-3 font-semibold text-white transition-all hover:shadow-lg hover:from-blue-700 hover:to-blue-600 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <span class="loading-spinner" id="spinner">
                        <svg class="h-5 w-5 animate-spin rounded-full border-2 border-white border-t-transparent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"></svg>
                    </span>
                    <span id="btnText">Kirim Pengaduan</span>
                </button>
            </form>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 rounded-lg bg-slate-100 p-6 text-center text-sm text-slate-600">
            <p>
                Memiliki pertanyaan? Hubungi tim support kami di
                <span class="font-semibold text-slate-900"> blkpekanbaru7@gmail.com</span>
            </p>
        </div>
    </div>

    <script>
        const form = document.getElementById('complaintForm');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        const successMessage = document.querySelector('.success-message');
        const fotoInput = document.getElementById('foto');
        const fileInfo = document.getElementById('fileInfo');

        // File upload
        fotoInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                fileInfo.textContent = e.target.files[0].name;
            }
        });
    </script>
</body>

</html>