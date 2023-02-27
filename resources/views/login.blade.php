<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login </title>
    <link href="{{ url('') }}/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('') }}/css/bootstrap.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="row justify-content-center">
                    <div class="col-lg-3">
                        <div class=" border-0 rounded-lg mt-5">
                            @if (url('') == 'http://127.0.0.1:8000')
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 d-flex justify-content-center" >
                                        <img class="img-preview " style="display: block;" 
                                            src="{{ url('') . '/logo/' . $profil->logo }} " width="40%">
                                    </div>
                                </div>
                            @else
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 d-flex justify-content-center" >
                                        <img class="img-preview " style="display: block;" 
                                            src="{{ url('') . '/public/logo/' . $profil->logo }} " width="40%">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-3">

                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('logiclogin') }}" method="POST">
                                        @if (session('pesan'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('pesan') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="id" id="inputEmail" type="text"
                                                value="{{ old('id') }}" placeholder="name@example.com" />
                                            <label for="inputEmail" class="">ID</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password"
                                                name="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; {{ $profil->nama_koperasi }} {{ date('Y') }}</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ url('') }}/js/bootstrap.js"></script>
    <script src="{{ url('') }}/js/scripts.js"></script>
</body>

</html>
