@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11 mt-4">
            <div class="row">
                <div class="mb-3 col-4">
                    <input type="text" name="user_id" class="form-control" id="user_id" placeholder="ID USER">
                    {{-- <select name="" id="" class="form-control">
                        <option value="">== Silahkan Pilih Anggota</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="mb-3 col-3">
                    <select name="jenis_simpanan" id="jenis_simpanan" class="form-control">
                        <option value="">== Pilih Jenis Simpanan ==</option>
                        <option value="simpanan_pokok">Simpanan Pokok</option>
                        <option value="simpanan_wajib">Simpanan Wajib</option>
                        <option value="simpanan_sukarela">Simpanan Suka Rela</option>
                    </select>
                </div>
                <div class="mb-3 col-3">
                    <button class="btn btn-success" type="button" id="cek" onclick="simpanan()">Cek</button>
                </div>
            </div>
            <div class="mt-4" id="hasil">

            </div>


        </main>

    </div>
    <script>
        function simpanan(){


            let id = document.getElementById('user_id').value
            let jenis_simpanan = document.getElementById('jenis_simpanan').value

            console.log(id)
            console.log(jenis_simpanan)

            if (id.length == 0) {

                        document.getElementById("hasil").innerHTML = 'Silahkan Masukan ID';

            } else if (jenis_simpanan == "") {

                        document.getElementById("hasil").innerHTML = "Silahkan Masukan Jenis Simpanan";
            }
            else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax/simpanan/" + jenis_simpanan + "/" + id, true);
                xmlhttp.send();
            }
        }

    </script>
@endsection
