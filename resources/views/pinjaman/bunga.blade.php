@extends('layouts.sidebar')
@section('body')
    <button type="button" class="btn btn-success text-white col-2 m-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
        Bunga
    </button>
    <div class="d-flex justify-content-center">

        <!-- Modal tambah anggota -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('pinjaman.bunga') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Bunga</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bunga</label>
                                <div class="d-flex">
                                    <input type="number" name="bunga" placeholder="Contoh: 1" class="form-input"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                    <span class="fs-5 ms-2"> % / Tahun </span>
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
    </div>
            @if (session('pesan'))
            <div class="alert alert-success col-4 mt-3 alert-dismissible fade show" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <table class="col-4 m-3">
        <tr>
            <th>Bunga</th>
        </tr>
        @foreach ($bunga as $bunga)
            <tr>
                <td>{{ $bunga->bunga }} % / Tahun</td>
                {{-- <td><button type="button" class="btn btn-success text-white m-3" data-bs-toggle="modal"
                        data-bs-target="#edit{{ $bunga->id }}">
                        Edit Bunga
                    </button></td> --}}
            </tr>
            <div class="modal fade" id="edit{{ $bunga->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="/bunga-pinjaman/edit/{{ $bunga->id }}" method="post">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bunga</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Bunga</label>
                                    <div class="d-flex">
                                        <input type="number" name="bunga" value="{{ $bunga->bunga }}" placeholder="Contoh: 1" class="form-input"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <span class="fs-5 ms-2"> % / Tahun </span>
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
        @endforeach
    </table>
@endsection
