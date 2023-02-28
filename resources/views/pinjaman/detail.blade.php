@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-8">
            <div class="row align-items-center mt-3">
                <div class="col-3">
                    @if (url('') == 'http://127.0.0.1:8000')
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img class="img-preview " style="display: block;"
                                    src="{{ url('') . '/logo/' . $profil->logo }} " width="40%">
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img class="img-preview " style="display: block;"
                                    src="{{ url('') . '/public/logo/' . $profil->logo }} " width="40%">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-8 text-center">
                    <h3>Koperasi {{ $profil->nama_koperasi }}</h3>
                    <p>{{ $profil->alamat }} {{ $profil->telepon }}</p>
                </div>
            </div>
            <hr class="">
            <h4 class="text-center mb-3">KWITANSI PINJAMAN</h4>
            <div class="row">
                <div class="col-6">
                    <h5>Nama Peminjam : {{ $pinjaman->user->name }}</h5>
                    <h5>ID Anggota : {{ $pinjaman->user->id }}</h5>

                </div>
                <div class="col-6">
                    <h5>ID Pinjaman : {{ $pinjaman->id }}</h5>
                    <h5> Total Angsuran : @format($pinjaman->total_angsuran)</h5>

                </div>
            </div>

            @if ($pinjaman->status_pinjaman == 'Ditolak')
                <span class="text-danger">Pinjaman Ditolak</span>
            @elseif ($pinjaman->status_pinjaman == 'Menunggu Verifikasi')
                <span class="text-danger">Pinjaman Menunggu Verifikasi</span>
            @else
                <table class="table-bordered table border-secondary mt-3">
                    <tr class="text-center">
                        <th>Jatuh Tempo</th>
                        <th>Total Tagihan</th>
                        <th>Keterangan</th>
                        <th class="">Kwitansi</th>
                    </tr>
                    @foreach ($pinjaman->angsuran as $angsuran)
                        <tr>
                            <td>{{ $angsuran->jatuh_tempo }}</td>
                            <td class="text-end">@format($angsuran->tagihan_angsuran)</td>
                            <td class="text-center">
                                {{ $angsuran->status }}
                            </td>
                            <td class="col-2">
                                @if ($angsuran->status == 'Sudah Bayar')
                                    <div class="d-flex justify-content-center">
                                        {{-- <a class=" d-inline btn btn-success me-2"
                                            href="{{ url('') }}/pinjaman/detail/{{ $pinjaman->id }}/{{ $angsuran->id }}">Download</a> --}}
                                        <a class=" d-inline btn btn-primary" target="_Blank"
                                            href="{{ url('') }}/pinjaman/print/{{ $pinjaman->id }}/{{ $angsuran->id }}">Print</a>
                                       
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection
