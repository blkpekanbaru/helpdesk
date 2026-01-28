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

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center mb-3">
                                <div class="mb-3">
                                    <img src="{{ asset('template/dist/assets/images/logo_satpel_mini.png')}}" width="40%" alt="Logo">
                                </div>
                                <h4>Helpdesk BLK</h4>
                                <h6 class="font-weight-light">Login Untuk Melanjutkan</h6>
                            </div>

                            <form class="pt-3" action="{{ route('AuthLogin') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#"
                                        class="auth-link text-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#forgotPasswordModal">
                                        Forgot password?
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white text-dark">

                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="mdi mdi-key-variant"></i> Forgot Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control mt-3" placeholder="Masukkan email">
                                    </div>
                                    <button class="btn btn-gradient-primary w-100">
                                        Kirim Reset Link
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('layout.script')
    <!-- endinject -->
</body>

</html>