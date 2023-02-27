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
        <div class="fs-3 text-start">Simpanan Wajib</div>
        <hr>
        <table class="table table-striped mt-2 text-start fs-5">
            <tr>
                <th>Tanggal</th>
                <th>Nominal</th>

            </tr>
            @foreach ($anggota->simpananWajib as $simpanan_wajib)
                <tr>
                    <td>{{ $simpanan_wajib->created_at }}</td>
                    <td>@currency($simpanan_wajib->simpanan_wajib)</td>
                </tr>
            @endforeach
            <tr>
                <th>Total</th>
                <th>@currency($anggota->simpanan_wajib)</th>
            </tr>
        </table>

    </div>

</div>
