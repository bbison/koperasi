@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div  class="col-10 mt-2">
            {{-- <div class="col-10 mt-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Journal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="{{ route('laporan.tambahjurnal') }}" method="post">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jurnal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                                        <input required type="date" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="tanggal">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                        <input required type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="keterangan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Akun</label>
                                        <select required name="akun_id" id="" class="form-control">
                                            <option value="">==Pilih Akun==</option>
                                            @foreach ($akun as $akun)
                                                <option value="{{ $akun->id }}">{{ $akun->nama_akun }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Debit</label>
                                        <input required type="number" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="debit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kredit</label>
                                        <input required type="number" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="kredit">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div> --}}

            <form action="/journal" method="get">
                @csrf
                <div class="d-flex">
                    <input type="date" required name="tanggal_awal" class="form-control me-2">
                    <input type="date" required name="tanggal_akhir" class="form-control me-2">
                    <input type="submit" value="Filter" class="btn btn-danger">
                </div>
            </form>

            <div class="d-flex justify-content-end mt-3">
                <div>

                    @if (request()->get('tanggal_awal'))
                        <a
                            href="/journal-download?tanggal_awal={{ request()->get('tanggal_awal') }}&tanggal_akhir={{ request()->get('tanggal_akhir') }}">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                        </a>
                    @else
                        <a href="/journal-download">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                    @endif

                    <a href="" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path
                                d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                            <path
                                d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        </svg>
                    </a>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Debit</th>
                    <th>kredit</th>
                </tr>
                @foreach ($jurnals as $jurnal)
                    @if (
                        $jurnal->keterangan == 'kas tabungan' or
                            $jurnal->keterangan == 'Kas Bayar Angsuran' or
                            $jurnal->keterangan == 'kas simpanan' or
                            $jurnal->keterangan == 'Kas Pembagian SHU' or
                            $jurnal->keterangan == 'kas angsuran')
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($jurnal->created_at)) }}</td>
                            <td>{{ $jurnal->akun->nama_akun }}<br>
                                @foreach ($jurnal->rincian_journal as $item)
                                    {{ $item->keterangan }}<br>
                                @endforeach
                            </td>
                            <td>@format($jurnal->saldo_debit)</td>
                            <td> <br>
                                @foreach ($jurnal->rincian_journal as $item)
                                    @format($item->saldo_kredit)<br>
                                @endforeach
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($jurnal->created_at)) }}</td>
                            <td>{{ $jurnal->akun->nama_akun }}<br>
                                @foreach ($jurnal->rincian_journal as $item)
                                    {{ $item->keterangan }}<br>
                                @endforeach
                            </td>

                            <td> <br>
                                @foreach ($jurnal->rincian_journal as $item)
                                    @format($item->saldo_debit)<br>
                                @endforeach
                            </td>
                            <td>@format($jurnal->saldo_kredit)</td>
                        </tr>
                    @endif
                @endforeach

            </table>

        </div>
    </div>
@endsection
