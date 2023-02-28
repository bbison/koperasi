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
    <div class="col-12 d-flex justify-content-center mt-3">
        <main class="col-11">
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
            <hr>
        
            <h4 class="text-center">Data Penerima SHU</h4>
            <h4>ID SHU : {{ $shu->id }}</h4>
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
                        <td>@format($p->shu->besar_shu_bersih - $p->shu->sisa_shu)</td>
                        <td>{{ number_format($p->presentase * 100, 0, '.') }} % </td>
                        <td>@format($p->nominal)</td>
                    </tr>
                @endforeach
            </table>
        </main>
    </div>


    <script>
        window.print()
    </script>


</body>
</html>
