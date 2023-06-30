@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <br>
            <button type="button" class="btn btn-success text-white col-2" data-bs-toggle="modal"
                data-bs-target="#tambah">Tambah
                Kode
            </button>

            <table class="table">
                <tr>
                    <th>Kode</th>
                    <th>Keterangan</th>
                </tr>
               
                @foreach ($kodes as $kode)
                    <tr>
                        <td>{{$kode->kode}}</td>
                        <td>{{$kode->keterangan}}</td>
                    </tr>
                @endforeach
            </table>

            <!-- Modal tambah anggota -->
            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="{{ route('pengaturan.tambahkode') }}" method="post">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kode</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kode</label>
                                    <input type="text" name="kode" placeholder=""
                                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" placeholder=""
                                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                </form>
            </div>

            

        </div>
    </div>
@endsection
