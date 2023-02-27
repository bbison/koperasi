@extends('layouts.sidebar')
@section('body')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-body">
                        <form action="{{ route('anggota.logicgantipassword') }}" method="POST">
                            @if (session('pesan'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    {{ session('pesan') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name="password_lama" id="inputEmail" type="password" value="{{ old('id') }}"
                                    placeholder="name@example.com" />
                                <label for="inputEmail" class="">Password Lama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password"
                                    name="password_baru" placeholder="Password" />
                                <label for="inputPassword">Password Baru</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button class="btn btn-primary" type="submit">Ganti Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
