<!doctype html>
<html lang="en">

<head>
    <title>Registrasi Akun</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/IMG/logowaled.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/login-form-18/css/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-2">
                    <h2 class="heading-section">Silahkan Daftar</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class=" d-flex align-items-center justify-content-center mb-4">
                            <img width="200px" src="{{ asset('public/IMG/logo1.png') }}" alt="">
                        </div>
                        <form action="{{ route('register') }}" class="login-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    aria-describedby="emailHelp" value="{{ old('nama') }}">
                                @error('nama')
                                    <small id="emailHelp" class="form-text text-danger">Nama Tidak Boleh Kosong !</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                                @error('username')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Unit</label>
                                <input type="text" class="form-control" id="unit" name="unit">
                                <input hidden type="text" class="form-control" id="kode_unit" name="kode_unit">
                                @error('kode_unit')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hak Akses</label>
                                <select class="form-control" id="hak_akses" name="hak_akses">
                                    <option value="1">Admin</option>
                                    <option value="2">Pendaftaran</option>
                                    <option value="3">Perawat</option>
                                    <option value="4">Dokter</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Retype Password</label>
                                <input type="password" class="form-control" id="password2" name="password2">
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-40">
                                </div>
                                <div class="w-60 text-md-right">
                                    <a href="{{ route('/login') }}" class="text-dark">Sudah Punya Akun ? Login</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success rounded submit p-3 px-5">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="{{ asset('public/login-form-18/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/popper.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/login-form-18/js/main.js') }}"></script>
    <script src="{{ asset('public/dist/js/jquery-3.js') }}"></script>
    <script src="{{ asset('public/dist/js/jquery-ui.min.js') }}"></script>
</body>
<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#unit').autocomplete({
                source: "<?= route('cariunit') ?>",
                select: function(event, ui) {
                    $('[id="unit"]').val(ui.item.label);
                    $('[id="kode_unit"]').val(ui.item.kode);
                }
            });
        })
    })
</script>

</html>
