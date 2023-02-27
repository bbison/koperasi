@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
     <main class="col-6 mt-3">
        <h1 class="text-center">Bayar Agsuran</h1>
        @if (session('pesan'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
        <form action="{{ route('pinjaman.logic.bayar') }}" method="post" >
            @csrf
            <div class="row mt-3">
                <div class="form-floating mb-3 col-8 ">
                    <input class="form-control" name="id" id="id" type="text" value="{{ old('pembayaran_ke') }}"
                    placeholder="name@example.com" />
                <label for="inputEmail" class="ms-3">ID ANGSURAN</label>
                </div>
                <div class="d-inline  col-4 mt-2">
                    <button type="button" class="btn btn-success" onclick="ajaxBayar()"> Check </button>
                    <button type="submit" class="btn btn-danger"> Bayar </button>
                </div>

            </div>
       

            {{-- <div class="form-floating mb-3">
                <input class="form-control" name="pembayaran_ke" id="pembayaran_ke" type="text" value="{{ old('pembayaran_ke') }}"
                    placeholder="name@example.com" />
                <label for="inputEmail" class="">Pembayaran Ke</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control" name="nominal" id="nominal" type="text" value="{{ old('id') }}"
                    placeholder="name@example.com" />
                <label for="inputEmail" class="">Jumlah Pembayaran</label>
            </div>
            <button type="button" class="btn btn-success" onclick="ajaxBayar()"> Check </button>
            <button type="submit" class="btn btn-danger"> Bayar </button> --}}
            <div id="hasil" class="mt-3"></div>
        </form>
       
     </main>
    </div>

    <script>
        function ajaxBayar() {
            let id_angsuran =  document.getElementById("id").value;
            if(!id_angsuran){
                document.getElementById("hasil").innerHTML = "ID Pinjaman Tidak Sesuai";
            }
            else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/angsuran/"+id_angsuran, true);
                xmlhttp.send();

            }
           
               
            
        }
    </script>
@endsection
