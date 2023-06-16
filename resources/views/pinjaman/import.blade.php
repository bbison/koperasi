@extends('layouts.sidebar')
@section('body')
   <div class="d-flex justify-content-center">
    <div class="col-4">
        <h3 class="text-center">Import Pinjaman</h3>
        <form action="{{ route('proses.import.pinjaman') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="" class="form-label">Import Pinjaman</label>
            <input type="file" name="file_import_pinjaman" class="form-control">
            <div class="d-flex mt-3 justify-content-center">
                <button class="btn btn-success">Submit</button>
            </div>

        </form>
        
    </div>
   </div>
@endsection
