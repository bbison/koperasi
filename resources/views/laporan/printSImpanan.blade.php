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

    <script>
        window.print()
    </script>


</body>
<div class="col-12 d-flex justify-content-center">
    <div class="col-10 mt-3 ">
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
        <h4 class="text-center">Laporan Simpanan</h4>
        <br>
        <table class="table table-bordered">
            <tr class="">
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                {{-- <th>Simpanan Pokok</th> --}}
                <th class="text-center col-3">Simpanan Wajib</th>
                <th class="text-center">Simpanan Sukarela</th>
                <th class="text-center">Total</th>
              
            </tr>

            @foreach ($user as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    {{-- <td>@format($user->simpanan_pokok)</td> --}}
                    <td class="text-end col-3 ">@format($user->simpanan_wajib)</td>
                    <td class="text-end">@format($user->simpanan_sukarela)</td>
                    <th class="text-end">@format($user->simpanan_sukarela + $user->simpanan_wajib + $user->simpanan_pokok)</th>
            
                </tr>
            @endforeach
            <tr class="">
                <th>Total</th>
                <th></th>
                <th class="text-end col-3">@format($user->sum('simpanan_wajib'))</th>
                <th class="text-end">@format($user->sum('simpanan_sukarela'))</th>
                <th class="text-end">@format($user->sum('simpanan_sukarela') + $user->sum('simpanan_wajib') + $user->sum('simpanan_pokok'))</th>
            </tr>
        </table>
    </div>
</div>
</html>
