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
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mt-3">
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
                                    src="{{ url('') . '/public/logo/' . $profil->logo }} " width="50%">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-8 text-center">
                    <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                    <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
                </div>
            </div>
            <hr class="border" style="border:2px solid black">
            <h4 class="text-center mb-3">DETAIL PINJAMAN</h4>
            <div class="d-flex justify-content-center">
                <div class="row col-9">
                    <div class="col-6">
                        <h6>Nama Peminjam : {{ $pinjaman->user->name }}</h5>
                            <h6>ID Anggota : {{ $pinjaman->user->id }}</h6>
    
                    </div>
                    <div class="col-6">
                        <h6>ID Pinjaman : {{ $pinjaman->id }}</h6>
                        <h6> Total Angsuran : @format($pinjaman->total_angsuran)</h6>
    
                    </div>
                </div>
            </div>
           

            @if ($pinjaman->status_pinjaman == 'Ditolak')
                <span class="text-danger">Pinjaman Ditolak</span>
            @elseif ($pinjaman->status_pinjaman == 'Menunggu Verifikasi')
                <span class="text-danger">Pinjaman Menunggu Verifikasi</span>
            @else
                <div class="d-flex justify-content-center">
                    <div class="col-9">
                        <table class="table table-bordered  border-secondary mt-3">
                            <tr class="text-center table-secondary" style="background-color: C6E1F0">
                                <th>Jatuh Tempo</th>
                                <th>Total Tagihan</th>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($pinjaman->angsuran as $angsuran)
                                <tr>
                                    <td class="text-center">{{ $angsuran->jatuh_tempo }}</td>
                                    <td class="text-end">@format($angsuran->tagihan_angsuran)</td>
                                    <td class="text-center">
                                        {{ $angsuran->status }}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        <small>*Harap bayar angsuran tepat waktu</small>

                    </div>
                </div>

            @endif
        </div>
    </div>
    <script>
        window.print()
    </script>


</body>

</html>
