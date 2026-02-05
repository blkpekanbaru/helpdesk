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
                                <i class="mdi mdi-plus"></i>
                            </span> Tambah Proyek
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-6 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('kirim.pesan') }}" method="POST">
                                        @csrf

                                        <div class="modal-body">
                                            <!-- ID teknisi -->
                                            <input type="hidden" name="teknisi_id" id="teknisi_id" value="{{$teknisi->id}}">

                                            <div class="mb-3">
                                                <label class="form-label">Nama Teknisi</label>
                                                <input type="text" class="form-control" name="nama_teknisi" id="nama_teknisi" value="{{$teknisi->nama_teknisi}}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">No HP</label>
                                                <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{$teknisi->no_hp}}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Isi Pesan</label>
                                                <textarea name="pesan" class="form-control" rows="12" required>
Halo {{$teknisi->nama_teknisi}},

@if ($proyek)
Anda ditunjuk sebagai PIC untuk pekerjaan:
- Pekerjaan : {{ $proyek->nama_proyek }}
- Lokasi    : Kantor BLK
- Tanggal   : {{ $proyek->tgl_mulai }}
@endif

Mohon konfirmasi dan ditindaklanjuti. Terima kasih.

                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="mdi mdi-send"></i> Kirim Pesan
                                            </button>
                                        </div>

                                    </form>
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
    <!-- End custom js for this page -->
</body>

</html>