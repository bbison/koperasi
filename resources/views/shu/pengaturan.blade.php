@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            <div class="d-flex justify-content-center mt-3">

                <div class="col-8">
                    <div class="h3 text-center">Pengaturan Besar Pembagian SHU</div>
                    <button type="button" class="btn btn-success text-white col-2 mb-3" data-bs-toggle="modal"
                        data-bs-target="#tambah">Atur Besar Pembagian SHU
                        
                    </button>
                    <!-- Modal tambah shu -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="{{ route('shu.tambah') }}" method="post">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pengaturan SHU</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">BESAR SHU</label>
                                            <input type="text" name="besarshu" placeholder="Contoh: 20"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (session('pesan'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                    <table class="table col-6">
                        <tr class="text-center table-secondary">
                            <th>BESAR PEMBAGIAN</th>
                        </tr>
                        @foreach ($shu as $shu)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shu->id }}</td>
                            </tr>
                            <!-- Modal edit shu -->
                            <div class="modal fade" id="edit{{ $shu->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('shu.pengaturan') }}" method="post">
                                    @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT SHU</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">BESAR SHU</label>
                                                    <input type="text" name="besarshu" placeholder="Contoh: 5000000"
                                                        class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" >
                                                </div>
                                                <input type="hidden" value="{{ $shu->id }}" name="idshu"
                                                    id="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach

                    </table>
                </div>

            </div>
        </main>

    </div>
@endsection
