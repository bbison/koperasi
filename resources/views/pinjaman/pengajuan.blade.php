@extends('layouts.sidebar')
@section('body')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <form action="{{ route('pinjaman.pengajuan.logic') }}" method="post" class="d-flex justify-content-center mt-3">
        @csrf

        <div class="row col-8">
            <div class="fs-4">Detail Peminjam</div>
            <hr>
            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">Nama Peminjam</label>
                <input type="text" readonly value="{{ auth()->user()->name }}" class="form-control"
                    id="exampleFormControlInput1" placeholder="1000000" name="user_name">
            </div>
            <div class="mb-3 col-6">
                <label for="exampleFormControlInput1" class="form-label">ID</label>
                <input type="text" readonly value="{{ auth()->user()->id }}" class="form-control"
                    id="exampleFormControlInput1" placeholder="name@example.com" name="user_id">
            </div>
            <div class="fs-4 mt-2"> Detail Pinjaman</div>
            <hr>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Nominal</label>
                    <input type="integer" value="" class="form-control" id="nominal" placeholder="1000000"
                        name="nominal_pinjaman" required onchange="rencana()">
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleFormControlInput1" class="form-label">Lama Pinjaman</label>
                    <select name="lama_pinjaman" id="bulan" class="form-control" onchange="rencana()">
                        <option value="">==Pilih Bulan==</option>
                        @foreach ($lama_pinjam as $lama)
                            <option value="{{ $lama->lama }}">{{ $lama->lama }} Bulan</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="fs-4 mt-2"> Rencana Pengembalian</div>
            <hr>
            <table class="table-bordered border-secondary" id="hasil">
            </table>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success">Ajukan Sekarang</button>
            </div>
        </div>


        <script>
            function rencana() {
                let nominal = document.getElementById("nominal").value
                let bulan = document.getElementById("bulan").value

                console.log(nominal)
                console.log(bulan)

                if (bulan.length == 0) {
                    document.getElementById("hasil").innerHTML = 'Silahkan Masukan Data Yang Sesuai';


                } else if (bulan.length != 0) {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("hasil").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "/ajax/pengajuan/" + nominal + "/" + bulan, true);
                    xmlhttp.send();
                }

                // var xmlhttp = new XMLHttpRequest();
                //     xmlhttp.onreadystatechange = function() {
                //         if (this.readyState == 4 && this.status == 200) {
                //             document.getElementById("hasil").innerHTML = this.responseText;
                //         }
                //     };
                //     xmlhttp.open("GET", "/ajax/anggota/" + $filter, true);
                //     xmlhttp.send();
            }
        </script>




    </form>
@endsection
