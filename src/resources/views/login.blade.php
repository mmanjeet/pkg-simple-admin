<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />
    <title>Admin Authentication</title>
    <link href="{{ asset('cyberzet/single-admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('cyberzet/single-admin/assets/css/toaster.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back!</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="{{ route('admin.auth') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email" value="{{ old('email') }}" placeholder="Useremail" autocomplete="new-email" />
                                            @error('email')
                                            <p style="color:red;text-align:left;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" value="{{ old('password') }}" placeholder="Password" autocomplete="new-password" />
                                            @error('password')
                                            <p style="color:red;text-align:left;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('cyberzet/single-admin/assets/js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('cyberzet/single-admin/assets/js/toaster.js') }}"></script>
    @if(Session::has('msg'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.error("{{Session::get('msg')}}")
    </script>
    @endif
</body>

</html>