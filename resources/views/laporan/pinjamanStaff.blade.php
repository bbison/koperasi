@extends('layouts.sidebar')
@section('body')
  <div class="d-flex justify-content-center">
    <div class="col-8">

        {{-- @dd($users->pinjamanstaff) --}}
        <br>
        <br>
        <h4>KOPERASI {{$profil->nama_koperasi}} PENJELASAN NERACA  {{date('d M Y')}} </h4>
        <br>
        <table class="table table-bordered border-dark">
       
        <tr>
            <th rowspan="2">KODE</th>
            <th rowspan="2">DESCRIPTION</th>
            <th colspan="2"  >SALDO AWAL</th>
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
        @foreach ($pinjamans as $pinjaman)
        {{$pinjaman->user->name}}

        
        {{-- @if ($pinjman->user->bagian =='STAFF')
        <tr>
            <td>{{$user->kode}}</td>
            <td>{{$user->name}}</td>
            <td></td>
            <td>@format($user->simpanan_sukarela)</td>
            <td></td>
            <td></td>
            <td></td>
            <td>@format($user->simpanan_sukarela)</td>
        </tr>
        @endif --}}
          
        @endforeach
        {{-- <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>@format($users->sum('simpanan_sukarela'))</th>
            <th></th>
            <th></th>
            <th></th>
            <th>@format($users->sum('simpanan_sukarela'))</th>
        </tr> --}}
             
    </table>
    </div>
  </div>
@endsection
