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

    <div class="col-12 d-flex justify-content-center">
        <div class="col-10 mt-3">
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
            <h4 class="text-center mb-3">Laporan Angsuran</h4>
  
        <table class="table table-bordered">
            <tr>
                <th>ID </th>
                <th>Nama</th>
                <th>Lama (Bulan)</th>
                <th>Nominal Pengembalian</th>
                <th>Bunga</th>
                <th>Sudah Bayar</th>
                <th>Kekurangan</th>
            </tr>

            @foreach ($pinjaman as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->lama_pinjaman }}</td>
                    <td class="text-end">@format($p->total_angsuran )</td>
                    <td>{{ $p->bunga_pinjaman->bunga }} %</td>
                    <td class="text-end">@format($p->angsuran_terbayar )</td>
                    <td class="text-end">@format($p->angsuran_belum_terbayar )</td>

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
