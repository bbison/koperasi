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
    @if (request()->get('tanggal_awal'))
    <h4  style="text-align: center">KOPERASI {{ $profil->nama_koperasi }} <br> PENJELASAN NERACA <br>
        {{ date('d M Y', strtotime(request()->get('tanggal_awal'))) }} -
        {{ date('d M Y', strtotime(request()->get('tanggal_akhir'))) }} </h4>
@else
    <h4  style="text-align: center">KOPERASI {{ $profil->nama_koperasi }} <br> PENJELASAN NERACA <br>
        {{ date('d M Y') }} </h4>
@endif
<table class="table table-bordered" style="width: 100%">
    <tr class="table-secondary" >
        <th colspan="2" class="text-center"> <u> Aktiva Lancar</u></th>
        <th colspan="2" class="text-center"> <u> PASSIVA</u></th>
    </tr>
    <tr>
        <td>Kas dan Bank</td>
        <td class='text-end'>@format($kas)</td>
        <td>Tabungan Anggota</td>
        <td class='text-end'>@format($tabungan_anggota)</td>
    </tr>
    <tr>
        <td></td>
        <td class='text-end'></td>
        <td>Hutang Lainya</td>
        <td class='text-end'>@format($lainya)</td>
    </tr>
    <tr>
        <td>Piutang Staff</td>
        <td class="text-end">@format($hutang_staf)</td>
        <td>Hutang SHU Karyawan</td>
        <td class="text-end">@format($shu_harus_dibagi)</td>
    </tr>
    <tr>
        <td>Piutang Produksi</td>
        <td class='text-end'>@format($hutang_produksi)</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Piutang Lainya</td>
        <td class='text-end'>@format($hutang_lainya)</td>
        <td></td>
        <td></td>
    </tr>
    <tr class="text-end">
        <th>SUB TOTAL</th>
        <th class='text-end'>@format($kas + $hutang_staf +$hutang_produksi + $hutang_lainya)</th>
        <th>SUB TOTAL</th>
        <th class='text-end'>@format($tabungan_anggota + $shu_harus_dibagi +$lainya )</th>
    </tr>
    <tr class="table-secondary">
        <th><u>AKTIVA TIDAK LANCAR</u></th>
        <td></td>
        <th><u>MODAL</u></th>
        <td></td>
    </tr>
    <tr>
        <td><i></i></td>
        <td></td>
        <td>Modal Staff</td>
        <td class='text-end'>@format($modal_staff)</td>
    </tr>
    <tr>
        <td><i></i></td>
        <td></td>
        <td>Modal Produksi</td>
        <td class='text-end'>@format($modal_produksi)</td>
    </tr>
    <tr>
        <td><i></i></td>
        <td></td>
        <td>Laba DItahan </td>
        <td class='text-end'>@format($laba_ditahan)</td>
    </tr>
    <tr>
        <th>SUB TOTAL</th>
        <th>-</th>
        <th>SUB TOTAL</th>
        <th class='text-end'> @format($laba_ditahan +$modal_produksi+$modal_staff) </th>
    </tr>
    <tr>
        <th>Jumlah Aktiva</th>
        <th class='text-end'>@format($kas + $hutang_staf +$hutang_produksi + $hutang_lainya)</th>
        <th>Jumlah Passiva</th>
        <th class='text-end'>@format($tabungan_anggota + $shu_harus_dibagi +$lainya + $laba_ditahan +$modal_produksi+$modal_staff ) </th>
    </tr>
</table>
</body>

</html>
