@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <br>
            <br>
            <form action="/laporan/neraca" method="get">
                @csrf
                <div class="d-flex">
                    <input type="date" required name="tanggal_awal" class="form-control me-2">
                    <input type="date" required name="tanggal_akhir" class="form-control me-2">
                    <input type="submit" value="Filter" class="btn btn-danger">
                </div>
            </form>
            <br>
            <div class="d-flex justify-content-end mt-3">
                <div>

                    @if (request()->get('tanggal_awal'))
                        <a
                            href="/simpananSukarelaStaff-download?tanggal_awal={{ request()->get('tanggal_awal') }}&tanggal_akhir={{ request()->get('tanggal_akhir') }}">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                        </a>
                    @else
                        <a href="/simpananSukarelaStaff-download">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                    @endif

                    <a href="{{ route('print.pinjamanstaff') }}" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path
                                d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                            <path
                                d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        </svg>
                    </a>
                </div>
            </div>
            <br>
            <h4>KOPERASI {{ $profil->nama_koperasi }} PENJELASAN NERACA {{ date('d M Y') }} </h4>
            <br>

           
            <table class="table table-bordered border-dark">

                <tr>
                    <th rowspan="2">KODE</th>
                    <th rowspan="2">DESCRIPTION</th>
                    <th colspan="2">SALDO AWAL</th>
                    <th colspan="2">MUTASI</th>
                    <th colspan="2">SALDO AKHIR</th>

                </tr>
                <tr>
                    <th>DEBET</th>
                    <th>KREDIT</th>
                    <th>DEBET</th>
                    <th>KREDIT</th>
                    <th>DEBET</th>
                    <th>KREDIT</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->kode }}</td>
                        <td>{{ $user->name }}</td>
                        <td></td>
                        <td>@format($user->simpanan_sukarela)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>@format($user->simpanan_sukarela)</td>
                    </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>@format($users->sum('simpanan_sukarela'))</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>@format($users->sum('simpanan_sukarela'))</th>
                </tr>

            </table>
        </div>
    </div>
@endsection
