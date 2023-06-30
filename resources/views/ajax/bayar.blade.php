<br>
<table>
    <tr>
        <td>Nama</td>
        <td class="ms-5"> {{ $peminjam->user->name }}</td>
    </tr>
    <tr>
        <td>Bagian</td>
        <td class="ms-5"> {{ $peminjam->user->bagian }}</td>
    </tr>
    <tr>
        <td>Jenis Pinjaman</td>
        <td class="ms-5"> {{ $peminjam->jenis_pinjaman->jenis_pinjaman }}</td>
    </tr>
    <tr>
        <td>Kekurangan</td>
        <td class="ms-5"> @format($peminjam->angsuran_belum_terbayar)</td>
    </tr>
</table>
<br>
<hr>
<div class="mb-3 col-6">
    <label for="exampleInputEmail1" class="form-label">Tanggal</label>
    <input type="date" name="tanggal" required class="form-control" id="exampleInputEmail1"
        aria-describedby="emailHelp">
</div>
<div class="mb-3 col-6">
    <label for="exampleInputEmail1" class="form-label">Nominal Pembayaran Angsuran Pokok</label>
    <input type="number" required name="nominal_angsuran_pokok" class="form-control" id="exampleInputEmail1"
        aria-describedby="emailHelp">
</div>
<div class="mb-3 col-6">
    <label for="exampleInputEmail1" class="form-label">Nominal Pembayaran Bunga</label>
    <input type="number" required name="nominal_angsuran_bunga" class="form-control" id="exampleInputEmail1"
        aria-describedby="emailHelp">
</div>
<div class="mb-3 col-6">
    <label for="exampleInputEmail1" class="form-label">Pembulatan</label>
    <input type="number" name="pembulatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
@csrf
<input type="hidden" name="pinjaman_id" value="{{ $peminjam->id }}">
<input type="hidden" name="user_id" value="{{ $peminjam->user->id }}">

<input type="submit" value="Bayar" class="btn btn-danger">
