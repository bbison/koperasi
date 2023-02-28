<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ url('') }}/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        table {
    border: solid #000 !important;
    border-width: 1px 0 0 1px !important;
}
th, td {
    border: solid #000 !important;
    border-width: 0 1px 1px 0 !important;
}
    </style>

</head>

<body>
    <div class="row align-items-center">

        <div class="col-3">
            @if (url('') == 'http://127.0.0.1:8000')
                <div class="row justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <img class="img-preview " style="display: block;"
                            src="{{ url('') . '/logo/' . $profil->logo }} " width="40%">
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <img class="img-preview " style="display: block;"
                            src="{{ url('') . '/public/logo/' . $profil->logo }} " width="40%">
                    </div>
                </div>
            @endif
        </div>
        <div class="col-8 text-center">
            <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
            <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
        </div>
    </div>
    <hr class="mt-4">
    <h4 class="text-center">Laporan Data Anggota</h4>
    <div class="d-flex justify-content-center">


        <div class="col-12">


            <table class="table table-bordered">
                <tr>
                    <th>N0</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Simpanan Wajib</th>
                    <th>Simpanan Sukarela</th>
                    <th>Total Simpanan</th>
                </tr>
                @foreach ($anggota as $anggota)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $anggota->name }}</td>
                        <td>{{ $anggota->alamat }}</td>
                        <td class="text-end">@format($anggota->simpanan_wajib)</td>
                        <td class="text-end">@format($anggota->simpanan_sukarela)</td>
                        <td class="text-end">@format($anggota->simpanan_wajib + $anggota->simpanan_pokok + $anggota->simpanan_sukarela)</td>
                    </tr>
                @endforeach


            </table>
        </div>
    </div>

    <script>
        window.print()
    </script>


</body>
</html>
