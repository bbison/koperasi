@extends('layouts.sidebar')
@section('body')
<div class="m-5">
        
                <h3 class="text-center">Pencairan Pinjaman</h3>
    <small>*klik id pinjaman untuk melihat detail</small>
    <div class="col-8">
        <table class="table">
            <tr>
              
                <th class="text-center col-2">ID PINJAMAN</th>
                <th class=" col-3" >NAMA PEMINJAM</th>
                <th class="text-end col-2">TOTAL PINJAM</th>
                <th class="text-end col-2">PEMGEMBALIAN</th>
                <th class="text-center col-1"> PRINT</th>
            </tr>
            @foreach ($pinjaman as $pinjaman)
                <tr>
                    <td class="text-center"><a class="text-decoration-none" href="/pinjaman/detail/{{ $pinjaman->id }}">{{ $pinjaman->id }}</a></td>
                    <td>{{ $pinjaman->user->name }}</td>
                    <td class="text-end">@format( $pinjaman->angsuran_pokok * $pinjaman->lama_pinjaman )</td>
                    <td class="text-end">@format( $pinjaman->total_angsuran )</td>
                    <td>
                    <form action="" method="post" class="btn"> 
                        @csrf
                        <a href="/print/{{ $pinjaman->id }}" target="_BLANK" class="btn btn-primary text-white">PRINT</a>
                    </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{-- <div>cek terbilang {{  \Riskihajar\Terbilang\Facades\Terbilang::make($pinjaman->total_angsuran)}}</div> --}}

    </div>

</div>
@endsection
