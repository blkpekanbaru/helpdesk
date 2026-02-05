<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helpdesk Teknisi</title>
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
                                <i class="mdi mdi-clipboard-check"></i>
                            </span> Tugas
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
                            text: "QR Code Berhasil ditambahkan!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    @if (session('success_update_tugas'))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil!",
                            text: "Tugas Berhasil diUpdate!",
                            showConfirmButton: true,
                        });
                    </script>
                    @endif
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="mdi mdi-playlist-plus"></i> Daftar Proyek</h4>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered table-striped" id="datatablePekerjaan">
                                            <thead>
                                                <tr>
                                                    <th> No </th>
                                                    <th> Nama proyek </th>
                                                    <th> Deskripsi </th>
                                                    <th> Status </th>
                                                    <th> Tanggal Mulai</th>
                                                    <th> Deadline </th>
                                                    <th> catatan </th>
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
                                                        @elseif($p->status == 2)
                                                        <span class="badge badge-gradient-danger">Pending</span>
                                                        @elseif($p->status == 3)
                                                        <span class="badge badge-gradient-success">Selesai</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $p->tgl_mulai }}</td>
                                                    <td>{{ $p->deadline ?? '-' }}</td>
                                                    <td>{{ $p->catatan ?? '-' }}</td>
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
                                                        <button
                                                            class="btn btn-warning btn-sm btn-edit"
                                                            data-id="{{ $p->id }}"
                                                            data-status="{{ $p->status }}"
                                                            data-bukti="{{ $p->bukti }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEdit">
                                                            <i class="mdi mdi-pencil"></i> Edit
                                                        </button>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="modalEdit" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <form action="{{ route('UpdateTugas', $p->id) }}"
                                                        method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Pekerjaan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <!-- STATUS -->
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" id="status" class="form-select" required>
                                                                    <option value="0" {{ $p->status == 0 ? 'selected' : '' }}>
                                                                        Belum dikerjakan
                                                                    </option>
                                                                    <option value="1" {{ $p->status == 1 ? 'selected' : '' }}>
                                                                        Progress
                                                                    </option>
                                                                    <option value="2" {{ $p->status == 2 ? 'selected' : '' }}>
                                                                        Pending
                                                                    </option>
                                                                    <option value="3" {{ $p->status == 3 ? 'selected' : '' }}>
                                                                        Selesai
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group d-none" id="catatanWrapper">
                                                                <label for="catatan">Catatan</label>
                                                                <textarea id="catatan" name="catatan" rows="12" class="form-control"
                                                                    placeholder="Masukkan alasan pending...">{{$p->catatan}}</textarea>
                                                            </div>

                                                            <!-- UPLOAD BUKTI -->
                                                            <div class="form-group">
                                                                <label for="bukti">Upload Bukti</label>
                                                                <input type="file" name="bukti" id="bukti" class="form-control">

                                                                @if ($p->bukti)
                                                                <small class="text-muted">
                                                                    Bukti saat ini:
                                                                    <a href="{{ asset('storage/bukti/'.$p->bukti) }}" target="_blank">
                                                                        Lihat
                                                                    </a>
                                                                </small>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary"><i class="mdi mdi-content-save-check-outline"></i> Simpan</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
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
        $('.btn-edit').on('click', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');
            let bukti = $(this).data('bukti');

            // set action form
            $('#formEdit').attr('action', '/pekerjaan/' + id);

            // set status
            $('#editStatus').val(status);

            // tampilkan bukti lama jika ada
            if (bukti) {
                $('#buktiLama')
                    .removeClass('d-none')
                    .find('a')
                    .attr('href', '/storage/bukti/' + bukti);
            } else {
                $('#buktiLama').addClass('d-none');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const catatanWrapper = document.getElementById('catatanWrapper');

            function toggleCatatan() {
                if (statusSelect.value === '2') {
                    catatanWrapper.classList.remove('d-none');
                } else {
                    catatanWrapper.classList.add('d-none');
                    document.getElementById('catatan').value = '';
                }
            }

            // saat status berubah
            statusSelect.addEventListener('change', toggleCatatan);

            // saat modal dibuka (edit)
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const status = this.dataset.status;

                    statusSelect.value = status;
                    toggleCatatan();
                });
            });
        });
    </script>




    <!-- End custom js for this page -->
</body>

</html>