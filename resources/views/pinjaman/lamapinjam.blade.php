@extends('layouts.sidebar')
@section('body')
    <div class="col-4 align-self-center m-4">
        <button type="button" class="btn btn-success text-white col-4" data-bs-toggle="modal" data-bs-target="#tambah">Add
            Periode
        </button>
        <!-- Modal tambah anggota -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('pinjaman.logic.lama') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Periode</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="exampleInputEmail1" class="form-label">Lama Pinjaman</label>
                                <div class="d-flex">
                                    <input type="number" name="lama_pinjam" placeholder="Contoh: 1" class="form-input"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    <span class="ms-2 fs-4">Bulan</span>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if (session('pesan'))
            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-hover m-3">
            <tr>
                <th>Lama Pinjam</th>
            </tr>
            @foreach ($lama_pinjam as $lama)
                <tr>
                    <td>{{ $lama->lama }} Bulan</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
