<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row align-items-center" style="display: grid">

        {{-- <div class="col-3">
            @if (url('') == 'http://127.0.0.1:8000')
                <div class="row justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <img class="img-preview " style="display: block;"
                            src="{{  public_path('logo/'.$profil->logo)}}" width="20%">
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <img class="img-preview " style="display: block;"
                            src="/public/logo/{{ $profil->logo }} " width="40%">
                    </div>
                </div>
            @endif
        </div> --}}
        <div class="col-8 text-center" style="text-align:center">
            <h4 class="text-center" style="text-align:center">LAPORAN SIMPANAN</h4>
            <h3>KOPERASI {{ $profil->nama_koperasi }}</h3>
            <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
        </div>
    </div>
    <hr>

    <div class="col-sm-12 text-center">
        <div class="border-bottom border-dark mt-2 mb-1"></div>
        <div class="border border-dark mb-2"></div>
    </div>

    <div class="container">
        <table class="table" style="width:100%;">
            <tr class="" style="text-align:center;border-bottom:2px solid #000 ">
                <th style="text-center">Nama</th>
                {{-- <th>Simpanan Pokok</th> --}}
                <th style="text-center">Simpanan Wajib</th>
                <th style="text-center">Simpanan Sukarela</th>
                <th style="text-center">Total</th>
            </tr>

            @foreach ($user as $user)
                <tr class="text-start" >
                    <td class="text-start" style="text-align:left">{{ $user->name }}</td>
                    {{-- <td class="text-end">@format($user->simpanan_pokok)</td> --}}
                    <td class="text-end" style="text-align:right">@format($user->simpanan_wajib)</td>
                    <td class="text-end" style="text-align:right">@format($user->simpanan_sukarela)</td>
                    <th class="text-end" style="text-align:right">@format($user->simpanan_sukarela + $user->simpanan_wajib + $user->simpanan_pokok)</th>
                </tr>
            @endforeach
            <tr class="text-end">
                <th >Total</th>
                {{-- <th class="text-end">@format($user->sum('simpanan_pokok'))</th> --}}
                <th class="text-end" style="text-align:right">@format($user->sum('simpanan_wajib'))</th>
                <th class="text-end" style="text-align:right">@format($user->sum('simpanan_sukarela'))</th>
                <th class="text-end" style="text-align:right"> @format($user->sum('simpanan_sukarela') + $user->sum('simpanan_wajib') + $user->sum('simpanan_pokok'))</th>
            </tr>
        </table>
    </div>

</body>

</html>
