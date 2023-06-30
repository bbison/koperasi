@extends('layouts.sidebar')
@section('body')
    <div class="col-12 d-flex justify-content-center">
  <div class="col-11">
    <div class="d-flex justify-content-center">
        <div class="col-10">

            @if (session('berhasil'))
                <div class="alert alert-success alert-dismissible m-2 fade show" role="alert">
                    {{ session('berhasil') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('gagal'))
                <div class="alert alert-warning alert-dismissible m-2 fade show" role="alert">
                    {{ session('gagal') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="text-center">Penyesuaian SHU</h3>

            <form action="{{route('profile.penyesuaianlabaditahan')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nominal Laba Ditahan</label>
                    <input type="number" name="sisa_shu" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nominal SHU Yang Harus Dibagi</label>
                    <input type="number" name="harus_bagi" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </div>

    </div>
@endsection
