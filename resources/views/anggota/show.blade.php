@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
        <main class="col-11">
            {{-- <div class="col-6">
                <table class="fs-3 table-borderless table">
                    <tr>
                        <td>NAMA</td>
                        <td>{{ $anggota->name }}</td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td>{{ $anggota->id }}</td>
                    </tr>
                </table>
            </div> --}}
            <div class="justify-content-around g-2">
                <div class="fs-3 mt-3">SIMPANAN</div>
                <a href="" class="">Kembali</a>
            </div>
            <hr>
            <div class="d-flex justify-content-between fs-5">
                {{-- <div class="col-3 bg-success text-white p-4 text-center">
                    <div class="row">
                        <div class="">Simpanan Pokok</div>
                        <div class="">@currency($anggota->simpanan_pokok)</div>
                    </div>
                </div> --}}
                <button class="col-3 bg-secondary fw-4  p-4 text-center text-white btn" type="button"
                    onclick="simpananWajib('{{ Crypt::encryptString($anggota->id) }}')">
                    <div class="row">
                        <div class="">Simpanan Wajib</div>
                        <div class="">@currency($anggota->simpanan_wajib)</div>
                    </div>
                </button>
                <button class="col-3 bg-primary  p-4 text-center text-white btn" type="button"  onclick="simpananSukarela('{{ Crypt::encryptString($anggota->id) }}')">
                    <div class="row">
                        <div class="">Simpanan Sukarela</div>
                        <div class="">@currency($anggota->simpanan_sukarela)</div>
                    </div>
                </button>
            </div>
            <div id="hasil"></div>
           
        </main>

    </div>
    <script>
        function simpananWajib($parameter) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("hasil").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/ajax/simpanan-wajib/" + $parameter, true);
            xmlhttp.send();
        }
        function simpananSukarela($parameter) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("hasil").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "/ajax/simpanan-sukarela/" + $parameter, true);
            xmlhttp.send();
        }
    </script>
@endsection
