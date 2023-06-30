@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-8">
<br>
            <div class="btn btn-danger">@format($saldo)</div>
            <table class="table">
                <tr>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                </tr>
                @foreach ($keuangan as $keuangan)
                    @if ($keuangan ->jenis_transaksi =='MASUK')
                        <tr>
                            <td>{{$keuangan->keterangan}}</td>
                            <td>@format($keuangan->saldo_debit)</td>
                            <td></td>
                            <td>@format($keuangan->saldo)</td>
                        </tr>
                    @elseif($keuangan ->jenis_transaksi =='KELUAR')
                    <tr>
                        <td>{{$keuangan->keterangan}}</td>
                        <td></td>
                        <td>@format($keuangan->saldo_kredit)</td>
                        <td>@format($keuangan->saldo)</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection
