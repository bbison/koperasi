@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            <div class="d-flex justify-content-center mt-3">

                <div class="col-11">
                    <div class="h3 text-center">Riwayat Pembagian SHU</div>

                    <!-- Modal tambah shu -->

                    <table class="table col-10">
                        <tr class="text-center table-secondary">
                            <th>NOMER</th>
                            <th>ID</th>
                            <th>TANGGAL</th>
                            <th>BESAR SHU</th>
                            <th>BIAYA OPERASIONAL</th>
                            <th>SHU BERSIH</th>
                            <th>PRESENTASE PEMBAGIAN</th>
                            <th>UNTUK DIBAGI</th>
                            <th>SISA SHU</th>
                            <th>LIHAT PENERIMA</th>
                        </tr>
                        @foreach ($shu as $shu)
                            <tr class="text-center table-secondary">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $shu->id }}</td>
                                <td>{{ $shu->created_at }}</td>
                                <td>@format($shu->besar_shu_kotor)</td>
                                <td>@format($shu->biaya_operasional)</td>
                                <td>@format($shu->besar_shu_bersih)</td>
                                <td>@format($shu->presentase_pembagian) %</td>
                                <td>@format($shu->besar_shu_bersih - $shu->sisa_shu) </td>
                                <td>@format($shu->sisa_shu)</td>
                                <td>
                                    <a class="text-decoration-none" href="/shu-penerima/{{ $shu->id }}">LIHAT</a>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </main>

    </div>
@endsection
