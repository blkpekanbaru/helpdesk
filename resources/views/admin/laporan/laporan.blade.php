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
                                <i class="mdi mdi-file-check-outline"></i>
                            </span> Laporan
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
    <div class="col-md-6 grid-margin">
        <div class="card">
            <form action="{{ route('laporan') }}" method="GET">
                <div class="card-body">
                    <h4 class="card-title mb-4">Filter Laporan</h4>

                    <!-- Tanggal -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date"
                                name="tgl_mulai"
                                class="form-control"
                                value="{{ request('tgl_mulai') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date"
                                name="deadline"
                                class="form-control"
                                value="{{ request('deadline') }}">
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-flex align-items-center gap-2 mt-3">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-eye-outline"></i> Tampilkan
                        </button>

                        @if(request()->filled('tgl_mulai') || request()->filled('deadline'))
                            <a href="{{ route('laporan') }}" class="btn btn-sm btn-outline-secondary">
                                Reset
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

                    <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Project Status</h4>

                            <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Proyek</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Deadline</th>
                                    <th>Progres</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $i => $row)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $row->nama_proyek }}</td>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td>{{ $row->tgl_mulai }}</td>
                                        <td>{{ $row->deadline }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if ($laporan->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                    @endif
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
    <!-- End custom js for this page -->
</body>

</html>
