<table class="table col-7 mt-3">
  
        <h3>Nama : {{ $pinjaman->user->name }}</h3>
        <h3>ID Pinjaman : {{ $pinjaman->id }}</h3>
        <input type="hidden" name="id_pinjaman" value="{{ $pinjaman->id }}">

    <hr>
    <tr class="text-center">
        <th>Jatuh Tempo</th>
        <th>Tagihan Ke</th>
        <th>Tanggal Pelunasan</th>
        <th>Total Tagihan</th>
        <th>Status</th>
        <th>Bayar Sekarang</th>
    </tr>
    @foreach ($pinjaman->angsuran as $angsuran)
    <tr>
        <td>{{ $angsuran->jatuh_tempo }}</td>
        <td>Bulan Ke-{{ $angsuran->bulan_angsuran }}</td>
        <td>
            
            {{ $angsuran->updated_at }}
        </td>
        <td>@format( $angsuran->tagihan_angsuran )</td>
        <td>{{ $angsuran->status }}</td>
        <td>
            @if($angsuran->status == "Sudah Bayar")
            <button type="button" class="btn btn-success text-white">Sudah Bayar</button>
            @else
            <input type="checkbox" name="bulanke[]" id="" value="{{ $angsuran->bulan_angsuran }}">
            @endif
        </td>
    </tr>     
    @endforeach
 
</table>
