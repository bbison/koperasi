<div class="col-12 d-flex justify-content-center">
    <div class="col-11 mt-3">
        <div class="row align-items-center" style="display:flex;flex">
            <div class="col-3" style="width: 10%">
                @if (url('') == 'http://127.0.0.1:8000')
                    <div class="row justify-content-center">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <img class="img-preview " style="display: block;"
                                src=" /logo/{{ $profil->logo }}" width="40%">
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
            <div class="col-8 text-center" style="text-align: center; width:70%">
                <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
            </div>
        </div>
        <hr class="mt-4">
        <h4 class="text-center" style="text-align: center">Laporan Data Anggota</h4>

    <table class="table" style="text-align: center;width:100%">
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Wajib</th>
            <th>Pokok</th>
            <th>Sukarela</th>
            <th>Total </th>
        </tr>
        @foreach ($anggota as $anggota)
        <tr>
            <td>{{ $anggota->name }}</td>
            <td>{{ $anggota->alamat }}</td>
            <td>@format($anggota->simpanan_wajib)</td>
            <td>@format($anggota->simpanan_pokok)</td>
            <td>@format($anggota->simpanan_sukarela)</td>
            <td>@format($anggota->simpanan_wajib + $anggota->simpanan_pokok + $anggota->simpanan_sukarela)</td>
        </tr>
            
        @endforeach

      
    </table>
</div>
</div>