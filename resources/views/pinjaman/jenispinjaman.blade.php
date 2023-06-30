@extends('layouts.sidebar')
@section('body')
    <button type="button" class="btn btn-success text-white col-2 m-3" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
        Jenis Pinjaman
    </button>
    <div class="d-flex justify-content-center">

        <!-- Modal tambah anggota -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('pinjaman.jenispinjaman') }}" method="post">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah jenis pinjaman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">jenis pinjaman</label>
                                <div class="d-flex">
                                    <input type="text" name="jenis_pinjaman" placeholder="Contoh: Pinjaman STAFF" class="form-input"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" required step="0.01">
                                    <span class="fs-5 ms-2"></span>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode</label>
                                <div class="d-flex">
                                    <input type="text" name="kode pinjaman" placeholder="" class="form-input"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" required step="0.01">
                                    <span class="fs-5 ms-2"></span>
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
            <th>jenis pinjaman</th>
            <th>Kode</th>
            <th>Action</th>
        </tr>
        @foreach ($jenis_pinjaman as $jenis_pinjaman)
            <tr>
                <td>{{ $jenis_pinjaman->jenis_pinjaman }}</td>
                <td>{{ $jenis_pinjaman->kode }}</td>
                <td><button type="button" class="btn btn-success text-white m-3" data-bs-toggle="modal"
                        data-bs-target="#edit{{ $jenis_pinjaman->id }}">
                        Edit
                    </button></td>
            </tr>
            
            <div class="modal fade" id="edit{{ $jenis_pinjaman->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form action="{{route('pinjaman.editjenispinjaman')}}" method="post">
                    @csrf
                    <div class="modal-dialog">
                        <input type="hidden" name="id" value="{{$jenis_pinjaman->id}}" id="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit jenis Pinjaman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">jenis pinjaman</label>
                                    <div class="d-flex">
                                        <input type="text"  name="jenis_pinjaman"
                                            value="{{ $jenis_pinjaman->jenis_pinjaman }}" placeholder="Contoh: 1" class="form-input"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        <span class="fs-5 ms-2"> </span>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </table>
@endsection
