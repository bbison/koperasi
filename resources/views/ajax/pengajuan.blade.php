<table class="table-bordered border-secondary mt-3">
    <tr class="text-center">
        <th>Nama Peminjam</th>
        <th>Alamat</th>
        <th>Tanggal Pinjam</th>
        <th>Nominal Pinjam</th>
        <th>Lama Pinjam</th>
        <th>Angsuran Pokok</th>
        <th>Angsuran Bunga</th>
        <th>Total Angsuran</th>
    </tr>
    <tr>
        <td>{{ $peminjam->name }}</td>
        <td>{{ $peminjam->alamat }}</td>
        <td>{{ $tanggal }}</td>
         <td>@format($nominal_pinjam )</td>
        <td>{{ $lama_pinjam }} Bulan</td>
        <td>@format($angsuran_pokok )</td>
        <td>@format($angsuran_bunga )</td>
        <td>@format($total_angsuran )</td>
    </tr>
  
</table>