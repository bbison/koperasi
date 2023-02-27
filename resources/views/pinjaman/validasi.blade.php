@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <main class="col-11">
            <div class="text-center fs-3 mt-2 mb-3"> PINJAMAN</div>
            <div class="col-4 m-2">
                <input type="text" class="form-control" onkeyup="filter(this.value)" name="" id=""
                    placeholder="cari Nama, ID PINJAMAN, atau Status Pinjaman">
            </div>
            <div id="hasil">
                @if (session('pesan'))
                    <div class="alert alert-warning alert-dismissible m-2 fade show" role="alert">
                        {{ session('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table col-7">
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>ID PINJAMAN</th>
                        <th>NOMINAL Pinjaman</th>
                        <th>NOMINAL PENGEMBALIAN</th>
                        <th>LAMA PINJAMAN</th>
                        <th>BUNGA</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                    @foreach ($pinjaman as $p)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->id }}</td>
                            <td>@format($p->angsuran_pokok * $p->lama_pinjaman)</td>
                            <td>@format($p->total_angsuran)</td>
                            <td>{{ $p->lama_pinjaman }} Bulan</td>
                            <td>{{ $p->bunga_pinjaman->bunga }} %</td>
                            <td>
                                @if ($p->status_pinjaman == 'Menunggu Verifikasi')
                                    <button class="btn btn-warning text-white">{{ $p->status_pinjaman }}</button>
                                @elseif($p->status_pinjaman == 'Aktif')
                                    <button class="btn btn-danger text-white">{{ $p->status_pinjaman }}</button>
                                @elseif($p->status_pinjaman == 'Ditolak')
                                    <button class="btn btn-danger text-white">{{ $p->status_pinjaman }}</button>
                                @elseif($p->status_pinjaman == 'Selesai')
                                    <button class="btn btn-primary text-white">{{ $p->status_pinjaman }}</button>
                                @endif
                                {{-- <button class="btn btn-warning text-white">Aktif</button>  --}}
                            </td>
                            <td>
                                @if ($p->status_pinjaman == 'Selesai')
                                    <button class="btn btn-white" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="20"
                                            height="20" fill="currentColor" class="bi bi-check-square-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                        </svg>
                                    </button>
                                @elseif($p->status_pinjaman == 'Ditolak')
                                    <button class="btn btn-white" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="20"
                                            height="20" fill="currentColor" class="bi bi-x-square-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                                        </svg>
                                    </button>
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action

                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                @if ($p->status_pinjaman != 'Selesai')
                                                    @if ($p->status_pinjaman != 'Aktif')
                                                        <form action="/validasi-pinjaman/{{ $p->id }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Terima</button>
                                                        </form>

                                                        <form action="/validasi-pinjaman/tolak/{{ $p->id }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Ditolak</button>
                                                        </form>
                                                    @endif
                                                    @if ($p->status_pinjaman == 'Selesai' or $p->status_pinjaman == 'Aktif')
                                                        <form action="/validasi-pinjaman/selesai/{{ $p->id }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Selesai</button>
                                                        </form>
                                                    @endif
                                                @endif


                                            </li>
                                            <li>
                                                {{-- <a class="dropdown-item" href="">Lihat Detail</a> --}}
                                            </li>
                                        </ul>
                                @endif
            </div>
            </td>
            </tr>
            @endforeach

            </table>
    </div>
    </main>
    </div>
    <script>
        function filter(str) {
            if (str == "") {
                let st = "PaRaMeTeR"
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/validasi/" + st, true);
                xmlhttp.send();
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/validasi/" + str, true);
                xmlhttp.send();

            }




        }
    </script>
@endsection
