<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helpdesk Admin</title>
    <!-- plugins:css -->
    @include('layout.style')
</head>
<style>
    .logo-main {
        max-height: 80px;
        /* sebelumnya 48px */
        transform: scale(1.8);
        width: auto;
        object-fit: contain;
    }


    .logo-mini {
        max-height: 36px;
        width: auto;
        object-fit: contain;
    }
</style>

<body>
    <div class="container-scroller">
        @if (session('success_update_password'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Berhasil!",
                text: "Password Berhasil diUpdate!",
                showConfirmButton: true,
            });
        </script>
        @endif
        @include('layout.modals_user')
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="#">
                    <img src="{{ asset('template/dist/assets/images/logo-satpel.png') }}"
                        class="logo-main"
                        alt="logo">
                </a>

                <a class="navbar-brand brand-logo-mini" href="#">
                    <img src="{{ asset('template/dist/assets/images/logo_satpel_mini.png') }}"
                        class="logo-mini"
                        alt="logo">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('template/dist/assets/images/faces-clipart/pic-1.png')}}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ auth()->user()->username }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            @include('layout.user')
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ asset('template/dist/assets/images/faces-clipart/pic-1.png')}}" alt="profile" />
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ auth()->user()->username }}</span>
                                <span class="text-secondary text-small">{{ auth()->user()->role }}</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    @include('layout.sidebar')
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-briefcase"></i>
                            </span> Pekerjaan
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @if (session('success'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Proyek Berhasil ditambahkan!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    @if (session('success_kirim_pesan'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Pesan Berhasil terkirim!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    @if (session('success_update_proyek'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Proyek Berhasil diUpdate!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    @if (session('success_delete_proyek'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Proyek Berhasil dihapus!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-playlist-plus"></i> Daftar Proyek</h4>
                                    <div>
                                        <a href="{{route('addPekerjaan')}}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> Tambah Proyek</a>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-striped" id="datatablePekerjaan">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> Nama proyek </th>
                                                    <th> Deskripsi </th>
                                                    <th> Status </th>
                                                    <th> PIC </th>
                                                    <th> Tanggal Mulai</th>
                                                    <th> Deadline </th>
                                                    <th> Bukti </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($proyek as $index => $p)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $p->nama_proyek }}</td>
                                                    <td>{{ $p->deskripsi }}</td>
                                                    <td>
                                                        @if ($p->status == 0)
                                                        <span class="badge badge-gradient-danger">Belum dikerjakan</span>
                                                        @elseif($p->status == 1)
                                                        <span class="badge badge-gradient-warning">Progress</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $p->teknisi?->nama_teknisi ?? '-' }}</td>
                                                    <td>{{ $p->tgl_mulai }}</td>
                                                    <td>{{ $p->deadline ?? '-' }}</td>
                                                    <td>
                                                        @if ($p->bukti)
                                                        <a href="{{ asset('storage/bukti/'.$p->bukti) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-info">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Tombol Edit -->
                                                        <a href="{{ route('editPekerjaan', $p->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="mdi mdi-pencil"></i> Edit
                                                        </a>


                                                        <a href="{{ route('TampilPesan', $p->teknisi->id) }}" class="btn btn-success btn-sm">
                                                            <i class="mdi mdi-chat"></i> Pesan
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('destroyPekerjaan', $p->id) }}" method="POST"
                                                            class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="mdi mdi-trash-can"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('success_teknisi'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Teknisi Berhasil ditambahkan!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif

                    @if (session('success_update_teknisi'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Teknisi Berhasil diupdate!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif

                    @if (session('success_delete_teknisi'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Teknisi Berhasil dihapus!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif

                    <div class="row">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-account-group"></i> Teknisi</h4>
                                    <div>
                                        <a href="#"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalTambahTeknisi">
                                            <i class="mdi mdi-plus"></i> Tambah Teknisi
                                        </a>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-striped" id="datatableTeknisi">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> Nama </th>
                                                    <th> No HP </th>
                                                    <th> Tugas Utama </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teknisi as $index => $t)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $t->nama_teknisi }}</td>
                                                    <td>{{ $t->no_hp }}</td>
                                                    <td>{{ $t->tugas ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <!-- Tombol Edit -->
                                                        <button
                                                            class="btn btn-sm btn-warning btn-edit-teknisi"
                                                            data-id="{{ $t->id }}"
                                                            data-nama="{{ $t->nama_teknisi }}"
                                                            data-hp="{{ $t->no_hp }}"
                                                            data-tugas="{{ $t->tugas }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalTambahTeknisi">
                                                            <i class="mdi mdi-pencil"></i> Edit
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('destroyTeknisi', $t->id) }}" method="POST"
                                                            class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="mdi mdi-trash-can"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalTambahTeknisi" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form id="formTeknisi" action="{{ route('storeTeknisi') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" id="formMethod" value="POST">
                                    <input type="hidden" name="id" id="teknisi_id">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle">Tambah Teknisi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Nama Teknisi</label>
                                                <input type="text" name="nama_teknisi" id="nama_teknisi" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">No HP</label>
                                                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tugas Utama</label>
                                                <input type="text" name="tugas" id="tugas" class="form-control">
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-content-save-check-outline"></i> Simpan
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-history"></i> History Proyek</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="datatableHistory">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Proyek</th>
                                                    <th>Deskripsi</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Deadline</th>
                                                    <th>PIC</th>
                                                    <th>Status</th>
                                                    <th>Bukti</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($history as $key => $p)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $p->nama_proyek }}</td>
                                                    <td>{{ $p->deskripsi }}</td>
                                                    <td>{{ $p->tgl_mulai }}</td>
                                                    <td>{{ $p->deadline }}</td>
                                                    <td>{{ $p->teknisi?->nama_teknisi ?? '-' }}</td>
                                                    <td>
                                                        @if ($p->bukti)
                                                        <a href="{{ asset('storage/bukti/'.$p->bukti) }}"
                                                            target="_blank"
                                                            class="btn btn-sm btn-info">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($p->status == 2)
                                                        <span class="badge badge-gradient-danger">Pending</span>
                                                        @else
                                                        <span class="badge badge-gradient-success">Selesai</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('layout.script')
    <script>
        $(document).ready(function() {

            const tableIds = ['#datatablePekerjaan', '#datatableTeknisi', '#datatableHistory'];

            tableIds.forEach(function(id) {
                $(id).DataTable({
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    language: {
                        search: "Cari:",
                        lengthMenu: "Tampilkan _MENU_ data",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        infoEmpty: "Data tidak tersedia",
                        zeroRecords: "Data tidak ditemukan",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "›",
                            previous: "‹"
                        }
                    },
                    columnDefs: [{
                        orderable: false,
                        targets: -1 // kolom terakhir
                    }]
                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('formTeknisi');
            const modalTitle = document.getElementById('modalTitle');

            const inputId = document.getElementById('teknisi_id');
            const inputNama = document.getElementById('nama_teknisi');
            const inputHp = document.getElementById('no_hp');
            const inputTugas = document.getElementById('tugas');

            // ✅ DELEGATED EVENT (AMAN UNTUK DATATABLES)
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-edit-teknisi');
                if (!btn) return;

                modalTitle.innerText = 'Edit Teknisi';

                form.action = `/teknisi/${btn.dataset.id}`;
                document.getElementById('formMethod').value = 'PUT';

                inputId.value = btn.dataset.id;
                inputNama.value = btn.dataset.nama;
                inputHp.value = btn.dataset.hp;
                inputTugas.value = btn.dataset.tugas;
            });

            // Reset modal → mode TAMBAH
            document.getElementById('modalTambahTeknisi')
                .addEventListener('hidden.bs.modal', function() {

                    modalTitle.innerText = 'Tambah Teknisi';

                    form.action = "{{ route('storeTeknisi') }}";
                    document.getElementById('formMethod').value = 'POST';

                    inputId.value = '';
                    inputNama.value = '';
                    inputHp.value = '';
                    inputTugas.value = '';
                });
        });
    </script>

    <script>
        // saat tombol delete diklik
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // stop submit default

                Swal.fire({
                    title: "Yakin ingin menghapus?",
                    text: "Data tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });

            });
        });
    </script>


    <!-- End custom js for this page -->
</body>

</html>