
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
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px
}
    </style>
</head>
<body>
    


    <div class="d-flex justify-content-center">
        <div class="col-12">

            {{-- @dd($pinjamans->pinjamanstaff) --}}
            <br>
            <br>
            <h4 style="text-align: center">KOPERASI {{ $profil->nama_koperasi }} <br> PENJELASAN NERACA <br>
                @if ($awal)
                    {{date('d M Y', strtotime($awal))}} -   {{date('d M Y', strtotime($akhir))}}
                @else
                
                {{ date('d M Y') }}
                @endif
                
               </h4>
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->kode }}</td>
                        <td>{{ $user->name }}</td>
                        <td></td>
                        <td>@format($user->simpanan_sukarela)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>@format($user->simpanan_sukarela)</td>
                    </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>@format($users->sum('simpanan_sukarela'))</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>@format($users->sum('simpanan_sukarela'))</th>
                </tr>

            </table>
        </div>
    </div>
    <script>
        window.print()
    </script>
    

</body>
</html>