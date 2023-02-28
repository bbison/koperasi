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
            <div class="d-flex ">
                <a href="{{ url()->previous()}}" class="fs-3 text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                  </svg>
                </a>
                <div class=" ms-2 fs-3 d-inline">SIMPANAN</div>
            </div>
            <hr>
            <div class="row">
            <div class="col-4 fs-5">
                {{-- <div class="col-3 bg-success text-white p-4 text-center">
                    <div class="row">
                        <div class="">Simpanan Pokok</div>
                        <div class="">@currency($anggota->simpanan_pokok)</div>
                    </div>
                </div> --}}
                <button class="col-12 m-2 bg-secondary fw-4  p-4 text-center text-white btn" type="button"
                    onclick="simpananWajib('{{ Crypt::encryptString($anggota->id) }}')">
                    <div class="row">
                        <div class="">Simpanan Wajib</div>
                        <div class="">@format($anggota->simpanan_wajib)</div>
                    </div>
                </button>
                <button class="col-12 m-2 bg-primary  p-4 text-center text-white btn" type="button"  onclick="simpananSukarela('{{ Crypt::encryptString($anggota->id) }}')">
                    <div class="row">
                        <div class="">Simpanan Sukarela</div>
                        <div class="">@format($anggota->simpanan_sukarela)</div>
                    </div>
                </button>
                <small>*klik jenis simpanan untuk melihat riwayat simpanan</small>
            </div>
            <div class="col-8">
                <div id="hasil"></div>
            </div>
        </div>
           
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
