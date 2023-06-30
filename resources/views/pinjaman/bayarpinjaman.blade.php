@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <form class="mt-3" action="{{ route('pinjaman.bayar') }}" method="post">
                <div class="flex">
                    <div class="col-8">
                        <select onchange="ajax(this.value)" class="form-control" name="" id="">
                            <option value="">==Pilih Peminjam==</option>
                            @foreach ($peminjam as $peminjam)
                                <option value="{{$peminjam->id}}"> {{ $peminjam->user->name }} </option>
                            @endforeach

                        </select>
                    </div>
                    <div id="hasil"></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function ajax(id) {
            if (id == "") {
                document.getElementById("hasil").innerHTML = "";
                return;
            } else {
          
                
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("hasil").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "/ajax-bayar/" + id, true);
                xmlhttp.send();
            }
        }
    </script>
@endsection
