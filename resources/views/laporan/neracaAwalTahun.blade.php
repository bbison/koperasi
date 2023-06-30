@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-10 mt-3">
            <form action="/laporan/neraca" method="get">
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
                            href="/laporan/neraca-download?tanggal_awal={{ request()->get('tanggal_awal') }}&tanggal_akhir={{ request()->get('tanggal_akhir') }}">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                        </a>
                    @else
                        <a href="/laporan/neraca-download">


                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                    @endif

                    <a href="{{ route('print.pinjamanstaff') }}" target="_blank" rel="noopener noreferrer">
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
            <br>
            <h3 class="text-center">Laporan Neraca {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }} </h3>
            <table class="table table-bordered">
                <tr class="table-secondary" >
                    <th colspan="2" class="text-center"> <u> Aktiva Lancar</u></th>
                    <th colspan="2" class="text-center"> <u> PASSIVA</u></th>
                </tr>
                <tr>
                    <td>Kas dan Bank</td>
                    <td class='text-end'>@format($kas)</td>
                    <td>Tabungan Anggota</td>
                    <td class='text-end'>@format($tabungan_anggota)</td>
                </tr>
                <tr>
                    <td></td>
                    <td class='text-end'></td>
                    <td>Hutang Lainya</td>
                    <td class='text-end'>@format($lainya)</td>
                </tr>
                <tr>
                    <td>Piutang Staff</td>
                    <td class="text-end">@format($hutang_staf)</td>
                    <td>Hutang SHU Karyawan</td>
                    <td class="text-end">@format($shu_harus_dibagi)</td>
                </tr>
                <tr>
                    <td>Piutang Produksi</td>
                    <td class='text-end'>@format($hutang_produksi)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Piutang Lainya</td>
                    <td class='text-end'>@format($hutang_lainya)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="text-end">
                    <th>SUB TOTAL</th>
                    <th class='text-end'>@format($kas + $hutang_staf +$hutang_produksi + $hutang_lainya)</th>
                    <th>SUB TOTAL</th>
                    <th class='text-end'>@format($tabungan_anggota + $shu_harus_dibagi +$lainya )</th>
                </tr>
                <tr class="table-secondary">
                    <th><u>AKTIVA TIDAK LANCAR</u></th>
                    <td></td>
                    <th><u>MODAL</u></th>
                    <td></td>
                </tr>
                <tr>
                    <td><i></i></td>
                    <td></td>
                    <td>Modal Staff</td>
                    <td class='text-end'>@format($modal_staff)</td>
                </tr>
                <tr>
                    <td><i></i></td>
                    <td></td>
                    <td>Modal Produksi</td>
                    <td class='text-end'>@format($modal_produksi)</td>
                </tr>
                <tr>
                    <td><i></i></td>
                    <td></td>
                    <td>Laba DItahan </td>
                    <td class='text-end'>@format($laba_ditahan)</td>
                </tr>
                <tr>
                    <th>SUB TOTAL</th>
                    <th>-</th>
                    <th>SUB TOTAL</th>
                    <th class='text-end'> @format($laba_ditahan +$modal_produksi+$modal_staff) </th>
                </tr>
                <tr>
                    <th>Jumlah Aktiva</th>
                    <th class='text-end'>@format($kas + $hutang_staf +$hutang_produksi + $hutang_lainya)</th>
                    <th>Jumlah Passiva</th>
                    <th class='text-end'>@format($tabungan_anggota + $shu_harus_dibagi +$lainya + $laba_ditahan +$modal_produksi+$modal_staff ) </th>
                </tr>
            </table>

        </div>
    </div>
@endsection
