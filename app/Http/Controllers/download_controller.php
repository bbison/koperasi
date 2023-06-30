<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profil;
use App\Models\akun;
use App\Models\journal;
use App\Models\shu;
use App\Models\rincian_journal;
use App\Models\catatan_keuangan;
use App\Models\pembagian_shu;
use App\Models\pinjaman;
use App\Models\jenis_pinjaman;
use App\Models\angsuran;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\File;


class download_controller extends Controller
{
    public function pinjamanstaff(Request $request)
    {
        if($request->tanggal_awal)
        {
            $pdf = Pdf::loadView('print.pinjamanstaff',[
                'profil'=>profil::find(1),
                'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','1')
                ->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])
                ->where('status_pinjaman', 'AKTIF')->get(),
                'awal'=>$request->tanggal_awal,
                'akhir'=>$request->tanggal_akhir,
            ]);
            return $pdf->download('pinjamanstaff.pdf');
        }
      
        $pdf = Pdf::loadView('print.pinjamanstaff',[
            'profil'=>profil::find(1),
            'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','1')
            ->where('status_pinjaman', 'AKTIF')->get(),
            'awal'=>date('d M Y',),
            'akhir'=>'',
        ]);
        return $pdf->download('pinjamanstaff.pdf');
    }
    public function pinjamanproduksi(Request $request)
    {
        if($request->tanggal_awal)
        {
            $pdf = Pdf::loadView('print.pinjamanproduksi',[
                'profil'=>profil::find(1),
                'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','2')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->where('status_pinjaman', 'AKTIF')->get(),
                'awal'=>$request->tanggal_awal,
                'akhir'=>$request->tanggal_akhir,
            ]);
            return $pdf->download('pinjamanproduksi.pdf');
        }
      
        $pdf = Pdf::loadView('print.pinjamanproduksi',[
            'profil'=>profil::find(1),
                'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','2')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->where('status_pinjaman', 'AKTIF')->get(),
        ]);
        return $pdf->download('pinjamanproduksi.pdf');
    }
    public function pinjamanlainya(Request $request)
    {
        if($request->tanggal_awal)
        {
            $pdf = Pdf::loadView('print.pinjamanlainya',[
                'profil'=>profil::find(1),
                'pinjamans'=>jenis_pinjaman::Where('id','!=', '1')
                // ->where('status_pinjaman', 'AKTIF')
                ->Where('id','!=', '2')
                ->Where('id','!=', '5')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->get(),
                'total'=>pinjaman::Where('jenis_pinjaman_id','!=', '1')
                ->Where('jenis_pinjaman_id','!=', '2')
                ->Where('jenis_pinjaman_id','!=', '5')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->sum('angsuran_belum_terbayar'),
                'awal'=>$request->tanggal_awal,
                'akhir'=>$request->tanggal_akhir,
            ]);
            return $pdf->download('pinjamanlainya.pdf');
        }
      
        $pdf = Pdf::loadView('print.pinjamanlainya',[
            'profil'=>profil::find(1),
            'profil'=>profil::find(1),
            'pinjamans'=>jenis_pinjaman::Where('id','!=', '1')
            // ->where('status_pinjaman', 'AKTIF')
            ->Where('id','!=', '2')
            ->Where('id','!=', '5')
            ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
            ->get(),
            'total'=>pinjaman::Where('jenis_pinjaman_id','!=', '1')
            ->Where('jenis_pinjaman_id','!=', '2')
            ->Where('jenis_pinjaman_id','!=', '5')
            ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
            ->sum('angsuran_belum_terbayar'),
            'awal'=>$request->tanggal_awal,
            'akhir'=>$request->tanggal_akhir,
        ]);
        return $pdf->download('pinjamanlainya.pdf');
    }
    public function simpananwajibstaff(Request $request)
    {
        if($request->tanggal_awal){
            $pdf = Pdf::loadView('print.simpananwajibstaff',[
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'STAFF')
                ->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
                ->where('simpanan_wajib','!=','0')->get(),
                'awal'=>$request->tanggal_awal,
                'akhir'=>$request->tanggal_akhir,
            ]);
            return $pdf->download('wajibstaff.pdf');
        }
        $pdf = Pdf::loadView('print.simpananwajibstaff',[
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'STAFF')
            ->where('simpanan_wajib','!=','0')->get(),
            'awal'=>$request->tanggal_awal,
            'akhir'=>$request->tanggal_akhir,
        ]);
        return $pdf->download('wajibstaff.pdf');
    }
    public function simpananwajibproduksi(Request $request)
    {
        if($request->tanggal_awal){
            $pdf = Pdf::loadView('print.simpananwajibproduksi',[
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'PRODUKSI')
                ->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
                ->where('simpanan_wajib','!=','0')->get(),
                'awal'=>$request->tanggal_awal,
                'akhir'=>$request->tanggal_akhir,
            ]);
            return $pdf->download('wajibproduksi.pdf');
        }
        $pdf = Pdf::loadView('print.simpananwajibproduksi',[
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'PRODUKSI')
            ->where('simpanan_wajib','!=','0')->get(),
            'awal'=>$request->tanggal_awal,
            'akhir'=>'',
        ]);
        return $pdf->download('wajibproduksi.pdf');
    }
    public function simpanansukarelastaff(Request $request)
    {
        if($request->tanggal_awal){
            $pdf = Pdf::loadView('print.simpanansukarelastaff',[
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'STAFF')
                ->where('simpanan_sukarela','!=','0')->get(),
                'awal'=>date('d M Y'),
                'akhir'=>'',
            ]);
            return $pdf->download('sukarelastaff.pdf');
        }
        $pdf = Pdf::loadView('print.simpanansukarelastaff',[
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'STAFF')
            ->where('simpanan_sukarela','!=','0')->get(),
           'awal'=>date('d M Y'),
            'akhir'=>'',
        ]);
        return $pdf->download('sukarelastaff.pdf');
    }

    public function journal(Request $request)
    {

        if($request->tanggal_awal){
            $pdf = Pdf::loadView('print.journal',[
                'profil'=>profil::find(1),
                'akun'=>akun::all(),
                'jurnals'=>journal::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get()
            ]);
            return $pdf->download('journal.pdf');
        }
            $pdf = Pdf::loadView('print.journal',[
                'profil'=>profil::find(1),
                'akun'=>akun::all(),
                'jurnals'=>journal::all()
            ]);
            return $pdf->download('journal.pdf');
    }

    public function neraca(Request $request)
    {
        if($request->tanggal_awal){
            $pdf = Pdf::loadView('print.neraca',[
                'profil'=>profil::find(1),
                'modal_staff'=>$modal_staff,
                'modal_produksi'=>$modal_produksi,
                'tabungan_anggota'=>User::where('bagian','STAFF')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('simpanan_sukarela'),
                'kas'=>$kas,
                'lainya'=>$lainya, 
                'laba_ditahan'=>$datashu->sisa_shu,
                'hutang_lainya'=>$hutanglainya,
                'hutang_staf'=>$hs,
                'shu_harus_dibagi'=>$datashu->besar_shu_dibagi,
                'hutang_produksi'=>$kry
            ]);
            return $pdf->download('journal.pdf');
        }

          //get modal produksi
          $modal_produksi = User::where('bagian','PRODUKSI')->sum('simpanan_wajib');
          //get modal staff
          $modal_staff = User::where('bagian','STAFF')->sum('simpanan_wajib');
          //kas dan bank
          $kas = catatan_keuangan::where('jenis_transaksi', 'MASUK')->sum('nominal') -
          catatan_keuangan::where('jenis_transaksi', 'KELUAR')->sum('nominal');



          $getdata = pinjaman::all();

          //piutang staff
          $hs = pinjaman::where('jenis_pinjaman_id','1')->sum('angsuran_belum_terbayar');
        //piutang karyawan
          $kry = pinjaman::where('jenis_pinjaman_id','2')->sum('angsuran_belum_terbayar');
           //piutang lainya
            $hutanglainya = pinjaman::
            Where('jenis_pinjaman_id', '!=' ,'1')
            ->Where('jenis_pinjaman_id', '!=' ,'2')
            ->Where('jenis_pinjaman_id', '!=' ,'5')
            ->sum('angsuran_belum_terbayar');
        
            $datashu = shu::latest()->first();
       //hutang lainyya
       $lainya = pinjaman::Where('jenis_pinjaman_id', 5)
       ->sum('angsuran_belum_terbayar');
         
          
            $pdf = Pdf::loadView('print.neraca',[
                'profil'=>profil::find(1),
            'modal_staff'=>$modal_staff,
            'modal_produksi'=>$modal_produksi,
            'tabungan_anggota'=>User::where('bagian','STAFF')->sum('simpanan_sukarela'),
            'kas'=>$kas,
            'lainya'=>$lainya, 
            'laba_ditahan'=>$datashu->sisa_shu,
            'hutang_lainya'=>$hutanglainya,
            'hutang_staf'=>$hs,
            'shu_harus_dibagi'=>$datashu->besar_shu_dibagi,
            'hutang_produksi'=>$kry
            ]);
            return $pdf->download('journal.pdf');
    }
}
