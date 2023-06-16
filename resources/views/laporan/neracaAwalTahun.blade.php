@extends('layouts.sidebar')
@section('body')
    <div class="d-flex justify-content-center">
        <div class="col-10">
            <h3 class="text-center">Laporan Neraca {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }} </h3>
            <table class="table table-bordered">
                <tr class="table-secondary" >
                    <th colspan="2" class="text-center"> <u> Aktiva Lancar</u></th>
                    <th colspan="2" class="text-center"> <u> PASSIVA</u></th>
                </tr>
                <tr>
                    <td>Kas dan Bank</td>
                    <td class='text-end'>@format($kas)</td>
                    <td>Hutang Anggota</td>
                    <td class='text-end'>@format($hutang_anggota->sum('simpanan_sukarela'))</td>
                </tr>
                <tr>
                    <td></td>
                    <td class='text-end'></td>
                    <td>Hutang Lainya</td>
                    <td class='text-end'>1.054.000</td>
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
                    <td class='text-end'>14.581..000</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="text-end">
                    <th>SUB TOTAL</th>
                    <th class='text-end'>477.824.000</th>
                    <th>SUB TOTAL</th>
                    <th class='text-end'>107.023.000</th>
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
                    <th class='text-end'>477.824.000</th>
                    <th>Jumlah Passiva</th>
                    <th class='text-end'>477.824.000</th>
                </tr>
            </table>

        </div>
    </div>
@endsection
