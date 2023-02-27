@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11 mt-4">
            <h3>Detail Simpanan Wajib</h3>
            <h6>ID   : {{ $user->id }}</h6>
            <h6>NAMA : {{ $user->name }}</h6>
            <table class="table  mt-2 text-center fs-5">
                <tr class="table-secondary">
                    <th>Tanggal</th>
                    <th>Nominal</th>
    
                </tr>
                @foreach ($user->simpananWajib as $simpanan_wajib)
                    <tr>
                        <td>{{ $simpanan_wajib->created_at }}</td>
                        <td>@currency($simpanan_wajib->simpanan_wajib)</td>
                    </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <th>@currency($user->simpanan_wajib)</th>
                </tr>
            </table>


        </main>

    </div>

@endsection
