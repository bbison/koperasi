@extends('layouts.sidebar')
@section('body')
    @if ($pinjaman_tunggu->count() == 1)
        Saat ini anda memiliki pinjaman yang menunggu verifikasi
    @elseif($pinjaman_aktif->count() == 1)
        Saat ini anda memiliki pinjaman yang aktif
    @else
        <img src="{{ url('') }}/asset/images/promosi.jpg" alt="" width="80%" class="rounded mx-auto d-block">
        <h4 class="text-center">Ada Kebutuhan Mendadak ? Yuk Ajukan Pinjaman</h4>
        <div class="d-flex justify-content-center">
            <a href="{{ route('pinjaman.pengajuan') }}" class="btn btn-success">Ajukan Pinjaman</a>
        </div>
    @endif
@endsection
