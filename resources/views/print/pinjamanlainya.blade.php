<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
    <link href="{{ url('') }}/css/styles.css" rel="stylesheet" />
    <link href="{{ url('') }}/css/bootstraps.css" rel="stylesheet" />
    {{-- <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> --}}
    <script src="{{ url('') }}/css/bootstraps.js" crossorigin="anonymous"></script>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center">
        <div class="col-8">
            @if (request()->get('tanggal_awal'))
                <h4  style="text-align: center">KOPERASI {{ $profil->nama_koperasi }} <br> PENJELASAN NERACA <br>
                    {{ date('d M Y', strtotime(request()->get('tanggal_awal'))) }} -
                    {{ date('d M Y', strtotime(request()->get('tanggal_akhir'))) }} </h4>
            @else
                <h4  style="text-align: center">KOPERASI {{ $profil->nama_koperasi }} <br> PENJELASAN NERACA <br>
                    {{ date('d M Y') }} </h4>
            @endif
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


                @foreach ($pinjamans as $jenis_pinjaman)
                    @if ($jenis_pinjaman->jenis_pinjaman != 'Hutang Lainya')
                        <tr>
                            <td></td>
                            <td> <strong> {{ $jenis_pinjaman->jenis_pinjaman }} </strong></td>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif


                    @foreach ($jenis_pinjaman->pinjaman as $pinjaman)
                        <tr>
                            <td>{{ $pinjaman->kode }}</td>
                            <td>{{ $pinjaman->user->name }}</td>
                            <td></td>
                            <td>@format($pinjaman->angsuran_belum_terbayar)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@format($pinjaman->angsuran_belum_terbayar)</td>
                        </tr>
                    @endforeach
                @endforeach





                <tr>
                    <th></th>
                    <th>TOTAL</th>
                    <th></th>
                    <th>@format($total)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>@format($total)</th>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>
