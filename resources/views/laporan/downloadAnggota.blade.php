<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table#tab,
        th#tab,
        td#tab {
            border: 1px solid;
        }

        table#tab {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="col-12 d-flex justify-content-center">
        <div class="col-11 mt-3">
            <table style="width:100%;border:none">
                <tr>
                    <td style="width: 30%">
                        <img class="img-preview " style="display:inline;margin-left:10%" src="{{ public_path('/logo/' . $profil->logo) }}"
                            width="40%">
                    </td>
                    <td style="width:70%;text-align:center">
                        <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                        <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
                    </td>
                </tr>
            </table>
            {{-- <div class="row align-items-center" style="grid-template-columns: 30% 70%;">
                <div class="col-3" style="width: 10%">
                    @if (url('') == 'http://127.0.0.1:8000')
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                    <img class="img-preview " style="display: block;"
                                    src="{{ public_path('/logo/'.$profil->logo) }}" width="40%">
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img class="img-preview " style="display: block;"
                                src="{{ public_path('/logo/'.$profil->logo) }}" width="40%">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-8 text-center" style="text-align: center; width:70%">
                    <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                    <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
                </div>
            </div> --}}
            <hr class="mt-4">
            <h4 class="text-center" style="text-align: center">Laporan Data Anggota</h4>

            <table class="table" style=";width:100%" id="tab">
                <tr>
                    <th id="tab">NO</th>
                    <th id="tab">Nama</th>
                    <th id="tab" style="text-align:center">Wajib</th>
                    <th id="tab" style="text-align:center">Sukarela</th>
                    <th id="tab" style="text-align:center">Total </th>
                </tr>
                @foreach ($anggota as $anggota)
                    <tr>
                        <td id="tab">{{ $loop->iteration }}</td>
                        <td id="tab">{{ $anggota->name }}</td>
                        <td id="tab" style="text-align:right">@format($anggota->simpanan_wajib)</td>
                        <td id="tab" style="text-align:right">@format($anggota->simpanan_sukarela)</td>
                        <td id="tab" style="text-align:right">@format($anggota->simpanan_wajib + $anggota->simpanan_pokok + $anggota->simpanan_sukarela)</td>
                    </tr>
                @endforeach


            </table>
        </div>
    </div>
</body>

</html>
