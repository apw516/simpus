<!doctype html>
<html lang="en">

<head>
    <title>LOGIN SIMPUS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/IMG/logo-puskesmas.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/login-form-18/css/style.css') }}">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-2">
                    <h2 class="heading-section">Silahkan Login</h2>
                                    </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class=" d-flex align-items-center justify-content-center mb-4">
                            <img width="200px" src="{{ asset('public/IMG/logo-puskesmas.png') }}" alt="">
                        </div>
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button class="btn-close" data-bs-dismiss="alert" aria-label="close"
                                type="button"></button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button class="btn-close" data-bs-dismiss="alert" aria-label="close"
                                type="button"></button>
                        </div>
                    @endif
                        <form action="{{ route('login') }}" class="login-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="username" class="form-control rounded-left"
                                    placeholder="Username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" name="password" class="form-control rounded-left"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-40">
                                </div>
                                <div class="w-60 text-md-right">
                                    <a href="{{ route('/register')}}" class="text-dark">Tidak Punya Akun ? Register</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success rounded submit p-3 px-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('public/login-form-18/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/popper.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/main.js') }}"></script>

</body>

</html>
