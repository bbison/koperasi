@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <div class="col-10 mt-3 ">
            <div class="row justify-content-end">
                <form action="/download/simpanan" method="post" class="row justify-content-end">
                    @csrf
                    <button type="submit" class="btn btn-primary text-white col-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                          </svg>
                    </button>
                </form>
            </div>
            <div class="row align-items-center">

                <div class="col-3">
                    @if (url('') == 'http://127.0.0.1:8000')
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img class="img-preview " style="display: block;"
                                    src="{{ url('') . '/logo/' . $profil->logo }} " width="40%">
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img class="img-preview " style="display: block;"
                                    src="{{ url('') . '/public/logo/' . $profil->logo }} " width="40%">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-8 text-center">
                    <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                    <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
                </div>
            </div>
            <hr>
            <h4 class="text-center">Laporan Simpanan Pokok</h4>

            <table class="table">
                <tr class="">
                    <th>Nama</th>
                    {{-- <th>Simpanan Pokok</th> --}}
                    <th>Simpanan Wajib</th>
                    <th>Simpanan Sukarela</th>
                    <th>Total</th>
                    <th>Detail</th>
                </tr>

                @foreach ($user as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        {{-- <td>@format($user->simpanan_pokok)</td> --}}
                        <td class="text-end">@format($user->simpanan_wajib)</td>
                        <td class="text-end">@format($user->simpanan_sukarela)</td>
                        <th class="text-end">@format($user->simpanan_sukarela + $user->simpanan_wajib + $user->simpanan_pokok)</th>
                        <td class="text-end"><a href="/anggota/{{ Crypt::encryptString($user->id) }}" class="btn text-primary">Detail</a></td>
                    </tr>
                @endforeach
                <tr class="">
                    <th>Total</th>
                    <th class="text-end">@format($user->sum('simpanan_pokok'))</th>
                    <th class="text-end">@format($user->sum('simpanan_wajib'))</th>
                    <th class="text-end">@format($user->sum('simpanan_sukarela'))</th>
                    <th class="text-end">@format($user->sum('simpanan_sukarela') + $user->sum('simpanan_wajib') + $user->sum('simpanan_pokok'))</th>
                </tr>
            </table>
        </div>
    </div>
@endsection
