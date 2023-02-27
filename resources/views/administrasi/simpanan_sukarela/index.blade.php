@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            {{-- @if ($pinjaman->count() >= 1) --}}
            <div class="ms-3 text-center fs-1">Simpanan Wajib</div>
            <div class="d-flex ms-3 me-3 justify-content-between">
                <button type="button" class="btn btn-success text-white col-2" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                    Anggo
                </button>
                <div class="col-4">
                    <form action="" method="get">
                        <input type="text" name="filter" class="form-control" placeholder="cari ID atau Nama">
                    </form>
                </div>
             

                <!-- Modal -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="{{ route('anggota.tambah') }}" method="post">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name="name" placeholder="Contoh: KOPERASI SUBUR MAKMUR"
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Simpanan Wajib</label>
                                        <input type="text" name="simpanan_Wajib" placeholder="Contoh: 500000 "
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Simpanan Pokok</label>
                                        <input type="text" name="simpanan_pokok" placeholder="Contoh: 500000 "
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">SImpanan Sukarela</label>
                                        <input type="text" name="simpanan_sukarela" placeholder="Contoh: 500000 "
                                            class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
            <div class="alert alert-success alert-dismissible m-2 fade show" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <hr>
            <div class="d-flex justify-content-center mt-3">
               
                <table class="table col-7">
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA ANGGOTA</th>
                        <th>TANGGAL MASUK</th>
                        <th>SIMPANAN WAJIB</th>
                        <th>SIMPANAN POKOK</th>
                        <th>SIMPANAN SUKARELA</th>
                        <th>ACTION</th>
                    </tr>
                    @foreach ($anggotas as $anggota)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $anggota->name }}</td>
                        <td>{{ $anggota->created_at }}</td>
                        <td>{{ $anggota->simpanan_wajib }}</td>
                        <td>{{ $anggota->simpanan_pokok }}</td>
                        <td>{{ $anggota->simpanan_sukarela }}</td>
                        <td><a href="" class="btn btn-success">Detail</a></td>
                    </tr>
                        
                    @endforeach
                </table>
            </div>
        </main>

    </div>
@endsection
