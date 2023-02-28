@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-8 mt-4">
            <h3>  <a href="{{ url()->previous()}}" class="fs-3 text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
              </svg>
            </a>  Detail Simpanan Wajib</h3>
            <h5 class="mt-2">ID   : {{ $user->id }}</h5>
            <h5>NAMA : {{ $user->name }}</h5>
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
