@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center mt-3">
        <div class="col-9">
            <h3 class="text-center">Pengaturan Akun</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                TAMBAH AKUN
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profile.akun') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">AKUN</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">NO AKUN</label>
                                <input type="text" name="no_akun" class="form-control">
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">NAMA AKUN</label>
                                <input type="text" name="nama_akun" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>Nomer Akun</th>
                    <th>Nama Akun</th>
                </tr>
                @foreach ($akun as $akun)
                    <tr>
                        <td>{{ $akun->no_akun }}</td>
                        <td>{{ $akun->nama_akun }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection
