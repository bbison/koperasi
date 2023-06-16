@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center mt-3">
        <div class="col-9">
            <h3 class="text-center">Journal Penyesuaian</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Penyesuaian
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profile.journalPenyesuaian') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Penyesuaian</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">NO Transaksi</label>
                                <input type="text" name="no_transaksi" class="form-control">
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">TANGGAL</label>
                                <input type="date" name="tanggal" class="form-control">
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control">
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">Akun</label>
                               <select name="akun_id" id="" class="form-control">
                                <option value="">== SILAHKAN PILIH AKUN ==</option>
                                @foreach ($akun as $akun)
                                    <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="modal-body">
                                <label for="" class="form-label">Nominal</label>
                                <input type="number" name="nominal" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>AKUN</th>
                    <th>NO TRANSAKSI</th>
                    <th>KETERANGAN</th>
                    <th>NOMINAL</th>
                </tr>
                @foreach ($penyesuaian as $penyesuaian)
                    <tr>
                        <td>{{ $penyesuaian->akun->nama_akun }}</td>
                        <td>{{ $penyesuaian->no_transaksi }}</td>
                        <td>{{ $penyesuaian->keterangan }}</td>
                        <td>{{ $penyesuaian->nominal }}</td>
                     
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection
