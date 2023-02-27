@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center mt-3">
        <main class="col-11">
            <h4>Penerima SHU</h4>
            <h4>ID SHU : {{ $shu->id }}</h4>
            <h4>TAHUN SHU : {{ $shu->created_at }}</h4>
            <table class="table col-6 text-center">
                <tr class="text-center table-secondary text-center">
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>TAHUN</th>
                    <th>BESAR SHU</th>
                    <th>PRESENTASE MODAL</th>
                    <th>NOMINAL TERIMA</th>
                </tr>
                @foreach ($shu->Pembagian_shu as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->created_at }}</td>
                    <td>@format( $p->shu->besar_shu_bersih - $p->shu->sisa_shu )</td>
                    <td>{{ number_format($p->presentase *100,2,'.') }}</td>
                    <td>@format( $p->nominal )</td>
                </tr>
                  
                
                @endforeach
            </table>
        </main>
    </div>
@endsection
