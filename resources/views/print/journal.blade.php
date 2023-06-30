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
    <h4 style="text-align: center">Journal</h4>
    <table class="table">
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Debit</th>
            <th>kredit</th>
        </tr>
        @foreach ($jurnals as $jurnal)
            @if (
                $jurnal->keterangan == 'kas tabungan' or
                    $jurnal->keterangan == 'Kas Bayar Angsuran' or
                    $jurnal->keterangan == 'kas simpanan' or
                    $jurnal->keterangan == 'Kas Pembagian SHU' or
                    $jurnal->keterangan == 'kas angsuran')
                <tr>
                    <td>{{ date('d-m-Y', strtotime($jurnal->created_at)) }}</td>
                    <td>{{ $jurnal->akun->nama_akun }}<br>
                        @foreach ($jurnal->rincian_journal as $item)
                            {{ $item->keterangan }}<br>
                        @endforeach
                    </td>
                    <td>@format($jurnal->saldo_debit)</td>
                    <td> <br>
                        @foreach ($jurnal->rincian_journal as $item)
                            @format($item->saldo_kredit)<br>
                        @endforeach
                    </td>
                </tr>
            @else
                <tr>
                    <td>{{ date('d-m-Y', strtotime($jurnal->created_at)) }}</td>
                    <td>{{ $jurnal->akun->nama_akun }}<br>
                        @foreach ($jurnal->rincian_journal as $item)
                            {{ $item->keterangan }}<br>
                        @endforeach
                    </td>

                    <td> <br>
                        @foreach ($jurnal->rincian_journal as $item)
                            @format($item->saldo_debit)<br>
                        @endforeach
                    </td>
                    <td>@format($jurnal->saldo_kredit)</td>
                </tr>
            @endif
        @endforeach

    </table>
</body>

</html>
