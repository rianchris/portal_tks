<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets_portal/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Halaman Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets_forsa/images/brand-logos/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets_portal/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets_portal/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets_portal/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets_portal/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/login_cover.jpg') }}');">
        <div class="authentication-inner row m-0 g-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-end ">
                <div class="w-100 d-flex justify-content-center">
                    {{-- <img src="{{ asset('img/login_cover.jpg') }}" class="img-fluid" alt="Login image" /> --}}
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center  p-sm-5 p-4 bg-white">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <div class="d-flex justify-content-between">
                            <a href="https://www.bpkp.go.id" class="app-brand-link gap-2">
                                <img src="{{ asset('img/logo_BPKP.png') }}" class="img-fluid bg-light rounded-end p-2" alt="" width="100px">
                            </a>
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <img src="{{ asset('img/aplikasi/LogoDAN.png') }}" class="img-fluid bg-light rounded-start p-2" alt="" width="60px">
                            </a>
                        </div>
                        <a href="{{ route('home') }}" class="app-brand-link gap-2">
                            <img src="{{ asset('img/aplikasi/Forsa.png') }}" class="img-fluid bg-light rounded-start p-2" alt="" width="75px">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to Forsa DAN! 👋</h4>
                    <p class="mb-4">Silahkan login menggunakan akun Warga BPKP</p>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- <form id="formLogin" class="mb-3" method="post" action="{{ route('auth.redirectTo') }}"> --}}
                    <form id="formLogin" class="mb-3" method="post" action="#">
                        @csrf
                        <input id="url_previous" type="hidden" name="url_previous" value="{{ request('redirect') ?? route('forsa.index') }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your  username" autofocus />
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>
                    <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('auth.google.index') }}" class="btn btn-label-google-plus w-100">
                            <i class="tf-icons bx bxl-google me-2"></i>Login with Google
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets_portal/vendor/js/core.js -->

    <script src="{{ asset('assets_portal/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets_portal/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets_portal/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets_portal/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets_portal/js/pages-auth.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();
                const username = $('#username').val();
                const password = $('#password').val();
                const url_previous = $('#url_previous').val();
                const authCallBack = '{{ route('auth.callback') }}';

                $.ajax({
                    url: '{{ route('auth.login') }}',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    data: JSON.stringify({
                        username: username,
                        password: password,
                        url_previous: url_previous
                    }),
                    success: function(response) {

                        // console.log(authCallBack);
                        const url = authCallBack + '?token=' + response.data.token_forsa + '&url_previous=' + url_previous;
                        // console.log(url);
                        window.location.href = url;
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan:', xhr.responseText);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });

            });
        });
    </script>


</body>

</html>
