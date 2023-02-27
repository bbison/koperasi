<div class="d-flex justify-content-center">
    <div class="col-8 mt-3">
        <table class="fs-5">
            <tr>
                <td>Nama </td>
                <td>:  {{ $anggota->name }}</td>
            </tr>
            <tr>
                <td>ID </td>
                <td>:  {{ $anggota->id }}</td>
            </tr>
        </table>
        <div class="fs-5 text-start">Simpanan Sukarela</div>
        <hr>
        <table class="table table-striped mt-2 text-start fs-5">
            <tr>
                <th>Tanggal</th>
                <th>Nominal</th>
            </tr>
            @foreach ($anggota->simpanan as $simpanan_sukarela)
            <tr>
                <td>{{ $simpanan_sukarela->created_at }}</td>
                <td>@currency($simpanan_sukarela->simpanan_suka_rela)
            </tr>
            @endforeach
            <tr>
                <th>Total</th>
                <th>@currency($anggota->simpanan_sukarela)</th>
            </tr>
        </table>

    </div>

</div>
