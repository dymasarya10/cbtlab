@include('admin.layouts.head')

<body class="d-flex align-items-center bg-primarycust-non-gr" style="min-height: 100vh;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius: 2em;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row row-cols-1 row-cols-lg-2 justify-content-center">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/admin/img/logo.png') }}" alt=""
                                            class="img-fluid w-25 mb-4">
                                        <h1 class="h4 text-gray-900 mb-4 font-weight-bold">CBT-LAB</h1>
                                    </div>
                                    @if (session()->has('loginError'))
                                        <div class="alert alert-danger alert-dismissible fade show  animate__animated animate__fadeIn mt-3"
                                            role="alert" style="border-radius: 3em">
                                            {{ session('loginError') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form class="user" action="{{ route('auth') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Username" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn text-white btn-user btn-block"
                                            style="background: radial-gradient(circle,#1B1464,#1289A7)">
                                            Login
                                        </button>
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Registrasi !</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('admin.layouts.foot')
