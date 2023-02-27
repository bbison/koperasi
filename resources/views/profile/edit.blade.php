@extends('layouts.sidebar')
@section('body')
    <div class="row justify-content-center mt-3">
        <div class="col-6 align-self-center">
            <form action="/profile/1" method="post" enctype="multipart/form-data">
                @method('PUT')
                @if (url('') == 'http://127.0.0.1:8000')
                    @if ($profil->logo == 'koperasi-1.png')
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-6">
                                <img class="img-preview " style="display: block;" src="{{ url('') . '/logo/koperasi-1.png' }} " width="100%">
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-6">
                                <img class="img-preview " style="display: block;" src="{{ url('') . '/logo/' . $profil->logo }}"
                                    width="100%">
                            </div>
                        </div>
                    @endif
                @else
                    @if ($profil->logo == 'koperasi-1.png')
                    <div class="d-flex justify-content-center">
                        <div class="col-sm-6">
                            <img class="img-preview " style="display: block;" src="{{ url('') . '/logo/koperasi-1.png' }} " width="100%">
                        </div>
                    </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-6">
                                <img class="img-preview " style="display: block;" src="{{ url('') . '/public/logo/' . $profil->logo }}"
                                    width="100%">
                            </div>
                        </div>
                    @endif
                @endif

                <div class="d-flex justify-content-center">
                    <div class="col-sm-6">
                        <img class="img-preview " style="display: block;" src="" width="100%">
                    </div>
                </div>
                @if (session('pesan'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('pesan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Koperasi</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->nama_koperasi }}" name="nama_koperasi" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="image" onchange="previewImage()" name="logo"
                        >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->alamat }}" name="alamat" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->telepon }}" name="telepon" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Ketua</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->ketua }}" name="ketua" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Walik Ketua</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->wakil_ketua }}" name="wakil_ketua" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Sekertaris</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
                        value="{{ $profil->sekertaris }}" name="sekertaris" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bendahara</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com" value="{{ $profil->bendahara }}" name="bendahara">
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="align-self-center btn btn-success">Update</button>
                </div>




            </form>
        </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
