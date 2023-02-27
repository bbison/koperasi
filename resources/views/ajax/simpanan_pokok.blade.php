<div class="d-flex justify-content-center">
    <div class="col-8 mt-3">
      
        <div class="fs-3 text-center">Simpanan Pokok</div>
        <hr>
        <table class="table table-stripped mt-2 text-start fs-5">
            <tr>
                <td>Nama </td>
                <td>{{ $anggota->name }}</td>
            </tr>
            <tr>
                <td>Simpanan Pokok</td>
                <td>@format( $anggota->simpanan_pokok )</td>
            </tr>
            <tr>
                <td>Dibayar Pada</td>
                <td>{{ $anggota->created_at }}</td>
            </tr>
        </table>

    </div>

</div>
