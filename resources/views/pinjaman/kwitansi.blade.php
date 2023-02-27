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
            <div>No : {{ $angsuran->id.'/SM/'. date("m",strtotime($angsuran->created_at)).'/'. date("Y",strtotime($angsuran->created_at)) }}</div>
            <table class="mt-2">
                <tr>
                    <td>Telah Terima Dari</td>
                    <td>:</td>
                    <td>{{ $angsuran->pinjaman->user->name }}</td>
                </tr>
                <tr>
                    <td>Terbilang</td>
                    <td>:</td>
                    <td><i>{{ ucwords(\Riskihajar\Terbilang\Facades\Terbilang::make($angsuran->tagihan_angsuran))}}</i></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>Pembayaran Angsuran Ke-{{ $angsuran->bulan_angsuran }} sisa angsuran @format($sisa_angsuran)</td>
                </tr>
            </table>

            <div class="row col-12">
                <div class="col-8">
                    <small class="mt-3">catatan :</small><br>
                    <small>Kwitansi ini sah apabila ada tanda tangan dan stempel dari pengurus koperasi</small> <br> <br>
                    <strong class="mt-5 border border-2 ps-3 pe-3 border-dark p-2" >@currency($angsuran->tagihan_angsuran)</strong><br>        
                </div>
                <div class="col-4">
                    <div class="row mt-3 justify-content-between">
                        <div class="col-md-4 text-center"></div>
                        <div class="col-md-4 text-center">
                            <p >Ungaran, {{ $angsuran->created_at }}</p>
                            <br>
                            <br>
                            <p>{{ $angsuran->pinjaman->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <script>
        window.print()
    </script>


</body>

</html>
