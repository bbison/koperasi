@extends('layouts.sidebar')
@section('body')
<div class="col-12 d-flex justify-content-center">

  <main class="col-11">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
      <form action="{{ route('pinjaman.pengajuanpenyesuaian.logic') }}" method="post" class="d-flex justify-content-center mt-3">
          @csrf
          <div class="row col-10">
              @if (session('pesan'))
                  <div class="alert alert-primary alert-dismissible m-2 fade show" role="alert">
                      {{ session('pesan') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              <div class="fs-4">Detail Pinjaman</div>
              <hr>
              <div class="mb-3 col-6">
                  <label for="exampleFormControlInput1" class="form-label">ID Pinjaman</label>
                  <input type="text" value="{{ $id_pinjaman + 1 }}" class="form-control"
                      id="exampleFormControlInput1" placeholder="1000000" name="id_pinjaman" readonly>
              </div>
              <div class="mb-3 col-6">
                  <label for="exampleFormControlInput1" class="form-label">Tangal Pinjaman</label>
                  <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="tanggal"
                      placeholder="1000000" name="tanggal_pinjam">
              </div>
              <div class="fs-4 mt-2"> Detail Peminjam</div>
              <hr>
              <div class="row">
                  <div class="mb-3 col-6">
                      <label for="exampleFormControlInput1" class="form-label">Peminjam</label>
                      <select name="peminjam" class="form-control" id="peminjam" required>
                          <option value="">==Silahkan Pilih Peminjam==</option>
                          @foreach ($user as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                          @endforeach

                      </select>
                  </div>
                  <div class="mb-3 col-6">
                      <label for="exampleFormControlInput1" class="form-label">Nominal</label>
                      <input type="integer" value="" class="form-control" id="nominal" placeholder="1000000"
                          name="nominal_pinjaman" required>
                  </div>
                  <div class="mb-3 col-6">
                      <label for="exampleFormControlInput1" class="form-label">Lama Pinjaman</label>
                      <select name="lama_pinjaman" id="bulan" class="form-control" required>
                          <option value="">==Pilih Bulan==</option>
                          @foreach ($lama_pinjam as $lama)
                              <option value="{{ $lama->lama }}">{{ $lama->lama }} Bulan</option>
                          @endforeach

                      </select>

                  </div>
                  <div class="mb-3 col-6">
                      <label for="exampleFormControlInput1" class="form-label">Bunga Per Tahun</label>
                      <select name="bunga" id="bunga" class="form-control" required>
                          <option value="">==Pilih Bunga==</option>
                          @foreach ($bunga as $bunga)
                              <option value="{{ $bunga->bunga }}">{{ $bunga->bunga }} % </option>
                          @endforeach

                      </select>
                  </div>

                  <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Sudah Dibayar</label>
                    <select name="sudahbayar" id="sudahdibayar" class="form-control" required>
                        <option value="">==Pilih Bulan==</option>
                        @foreach ($lama_pinjam as $lama)
                            <option value="{{ $lama->lama }}">{{ $lama->lama }} Bulan</option>
                        @endforeach

                    </select>

                </div>
                  <button class="btn btn-danger col-2" type="button" onclick="ajax()">Detail</button>


              </div>
              <div class=" mt-3" id="hasil">
              </div>

              <div class="d-flex justify-content-center mt-4">
                  <button type="submit" class="btn btn-success">Simpan Data</button>
              </div>
          </div>


          <script>
              function ajax() {
                  let nominal = document.getElementById("nominal").value
                  let bulan = document.getElementById("bulan").value
                  let tanggal = document.getElementById("tanggal").value
                  let bunga = document.getElementById("bunga").value
                  let peminjam = document.getElementById("peminjam").value
                  let sudahbayar = document.getElementById("sudahdibayar").value

                  console.log(bunga)

                  if (bulan.length == 0) {
                      document.getElementById("hasil").innerHTML = 'Silahkan Masukan Data Yang Sesuai';


                  } else if (bulan.length != 0) {
                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {
                              document.getElementById("hasil").innerHTML = this.responseText;
                          }
                      };
                      xmlhttp.open("GET", "/ajax/pengajuan-penyesuaian/" + nominal + "/" + bulan + "/" + peminjam + "/" + tanggal + "/" +
                          bunga + "/" + sudahbayar, true);
                      xmlhttp.send();
                  }
              }
          </script>




      </form>
  </main>


</div>

@endsection
