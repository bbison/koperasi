@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            <div class="d-flex justify-content-center mt-3">

                <div class="col-11">
                    <div class="h3 text-center">Pembagian SHU</div>
                    <div class="d-flex justify-content-between">

                        <button type="button" class="btn btn-success text-white col-2 mb-3" data-bs-toggle="modal"
                            data-bs-target="#tambah">Selesai Periode
                        </button>
                        <button type="button" class="btn btn-danger col-4 mb-3">Total SHU Periode Ini @format($total_shu_kotor)
                        </button>
                    </div>

                    <!-- Modal tambah shu -->
                    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="{{ route('shu.tambah') }}" method="post">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Selesai Periode</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">NOMINAL SHU KOTOR</label>
                                            <input type="text" name="nominal" placeholder="Contoh: 5000000"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="{{ $total_shu_kotor }}" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">BIAYA OPERASIONAL</label>
                                            <input type="text" name="operasional" placeholder="Contoh: 5000000"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">PRESENTASE PEMBAGIAN
                                                (%)</label>
                                            <input type="number" name="presentase" placeholder="Contoh: 80"
                                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Selesai Periode</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (session('pesan'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{ session('pesan') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table col-10">
                        <tr class="text-center table-secondary">
                            <th>NOMER</th>
                            <th>ID</th>
                            <th>TANGGAL</th>
                            <th>BESAR SHU</th>
                            <th>BIAYA OPERASIONAL</th>
                            <th>SHU BERSIH</th>
                            <th>PRESENTASE PEMBAGIAN</th>
                            <th>UNTUK DIBAGI</th>
                            <th>SISA SHU</th>
                            <th>BAGI</th>
                        </tr>
                        @foreach ($shu as $shu)
                            <tr class="text-center table-secondary">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shu->id }}</td>
                                <td>{{ $shu->created_at }}</td>
                                <td>@format($shu->besar_shu_kotor)</td>
                                <td>@format($shu->biaya_operasional)</td>
                                <td>@format($shu->besar_shu_bersih)</td>
                                <td>@format($shu->presentase_pembagian) %</td>
                                <td>@format($shu->besar_shu_bersih - $shu->sisa_shu) </td>
                                <td>@format($shu->sisa_shu)</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if($shu->pembagian_shu->count() == 0 )
                                            <li>
                                                <form action='/shu-bagi/{{ $shu->id }}' method='POST'>
                                                    @csrf
                                                    <input type='hidden' name='shu_id' value='{{ $shu->id }}'>
                                                    <button class='dropdown-item' type='submit'
                                                        onclick="return confirm('Yakin Ingin Membagi SHU ?')">
                                                        Bagi
                                                    </button>
                                                    <form>
                                            </li>
                                            @endif
                                            <li><a class="dropdown-item" href="/shu-penerima/{{ $shu->id }}">lihat
                                                    Hasil Peneriman</a></li>
                                        </ul>
                                    </div>
                                    </th>

                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </main>

    </div>
@endsection
