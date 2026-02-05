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
                                <i class="mdi mdi-map-marker"></i>
                            </span> Lokasi
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
                            text: "User Berhasil ditambahkan!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    @if (session('success_delete_user'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "User Berhasil dihapus!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-account"></i> Daftar Pengguna</h4>
                                    <div>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                                            <i class="mdi mdi-account-multiple-plus-outline"></i> Tambah Pengguna
                                        </a>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-striped" id="datatablePekerjaan">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> Username </th>
                                                    <th> Email </th>
                                                    <th> No Telepon</th>
                                                    <th> Role </th>
                                                    <th class="text-center"> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $index => $u)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $u->username }}</td>
                                                    <td>{{ $u->email }}</td>
                                                    <td>{{ $u->no_hp ?? '-' }}</td>
                                                    <td>{{ $u->role ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <!-- Tombol Hapus -->
                                                        <form action="{{route('DeleteUser',$u->id)}}" method="POST"
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
                    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('StoreUser') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahUserModalLabel">Tambah Pengguna</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">No Telepon</label>
                                            <input type="number" name="no_hp" class="form-control" id="no_hp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" id="role" class="form-select" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="admin">Admin</option>
                                                <option value="teknisi">Teknisi</option>
                                                <!-- Tambah role lain jika ada -->
                                            </select>
                                        </div>
                                        <!-- Password default tidak perlu inputan -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
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