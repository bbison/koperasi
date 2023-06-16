@extends('layouts.sidebar')
@section('body')
   <div class="d-flex justify-content-center">
    <div class="col-4">
        <h3 class="text-center">Import Anggota</h3>
        <form action="{{ route('profile.ImportAnggota') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="" class="form-label">Import Anggota</label>
            <input type="file" name="file_import_anggota" class="form-control">
            <div class="d-flex mt-3 justify-content-center">
                <button class="btn btn-success">Submit</button>
            </div>

        </form>
        
    </div>
   </div>
@endsection
