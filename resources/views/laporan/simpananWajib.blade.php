@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <div class="col-6 mt-3">
            <h4>Laporan Simpanan Wajib</h4>
  
        <table class="table">
            <tr>
                <th>Nama</th>
                <th>Jumlah Simpanan</th>
            </tr>

            @foreach ($user as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>@format($user->simpanan_wajib )</td>
                </tr>
            @endforeach
            <tr>
                <th>Total</th>
                <th>@format( $user->sum('simpanan_wajib') )</th>
            </tr>
        </table>
    </div>
    </div>
@endsection
