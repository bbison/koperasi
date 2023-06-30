<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\akun;
use App\Models\simpanan; 
use App\Models\profil;
use App\Models\journal;
use App\Models\catatan_keuangan;
use App\Models\laba_ditahan;
use App\Models\penyesuaian;
use App\Models\shu;
use App\Models\jenis_pinjaman;
use App\Models\simpanan_Wajib;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\File;



class laporan_controller extends Controller
{
    public function simpananPokok()
    {
       return view('laporan.simpananPokok',[
        'user'=>User::orderBy('name','ASC')->get(),
        'profil'=>profil::find(1)
       ]);
    }
    public function printSimpanan()
    {
       return view('laporan.printSimpanan',[
        'user'=>User::orderBy('name','ASC')->get(),
        'profil'=>profil::find(1)
       ]);
    }


    public function simpananWajib()
    {
        return view('laporan.simpananWajib',[
            'user'=>User::orderBy('name','ASC')->get(),
            'sWajib'=>simpanan_Wajib::all(),
            'profil'=>profil::find(1)
        ]);
    }
    public function simpananSukarela()
    {
        return view('laporan.simpananSukarela',[
            'user'=>User::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function angsuran()
    {
        return view('laporan.angsuran',[
            'pinjaman'=>pinjaman::orderBy('id', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function printAngsuran()
    {
        return view('laporan.printAngsuran',[
            'pinjaman'=>pinjaman::orderBy('id', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    
    
    public function anggota()
    {
        return view('laporan.anggota',[
            'anggota'=>user::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function printAnggota()
    {
        return view('laporan.printAnggota',[
            'anggota'=>user::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }

    // pinjaman::find($request->id_pinjaman)->update([
    //     'angsuran_terbayar'=>angsuran::where('pinjaman_id', $request->pinjaman_id)->where('status', 'Sudah Bayar')->sum('tagihan_angsuran'),
    //     'angsuran_belum_terbayar'=>angsuran::where('pinjaman_id', $request->pinjaman_id)->where('status', 'Belum Bayar')->sum('tagihan_angsuran')
    //  ]);

    public function downloadSimpanan()
    {
        $anggota = User::orderBy('name','ASC')->get();
        $pdf = PDF::loadView('laporan.downloadSimpanan', [
            'user' => User::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
        return $pdf->download('laporan_simpanan_'.date('Y'));
    }

    public function downloadAngsuran()
    {
      
        $pdf = PDF::loadView('laporan.downloadAngsuran', [
            'pinjaman'=>pinjaman::orderBy('id', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
        return $pdf->download('laporan_Angsuran_'.date('Y'));
    }
    public function downloadAnggota()
    {
        // $dompdf = new Dompdf();
        // $dompdf->loadHtml('laporan.downloadAnggota', [
        //     'anggota'=>user::orderBy('name','ASC')->get(),
        //     'profil'=>profil::find(1)
        // ]);
        // $dompdf->render();

        // // Output the generated PDF to Browser
        // $dompdf->stream();
      
        $pdf = PDF::loadView('laporan.downloadAnggota', [
            'anggota'=>user::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
        return $pdf->download('laporan_Anggota_'.date('Y'));
    }
    

    public function neracaAwalTahun(Request $request)
    {  

        if($request->tanggal_awal){
        
                    //get modal produksi
          $modal_produksi = User::where('bagian','PRODUKSI')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('simpanan_wajib');
          //get modal staff
          $modal_staff = User::where('bagian','STAFF')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('simpanan_wajib');
          //kas dan bank
          $kas = catatan_keuangan::where('jenis_transaksi', 'MASUK')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('nominal') -
          catatan_keuangan::where('jenis_transaksi', 'KELUAR')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('nominal');



          $getdata = pinjaman::all();

          //piutang staff
          $hs = pinjaman::where('jenis_pinjaman_id','1')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('angsuran_belum_terbayar');
        //piutang karyawan
          $kry = pinjaman::where('jenis_pinjaman_id','2')->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])->sum('angsuran_belum_terbayar');
           //piutang lainya
            $hutanglainya = pinjaman::
            Where('jenis_pinjaman_id', '!=' ,'1')
            ->Where('jenis_pinjaman_id', '!=' ,'2')
            ->Where('jenis_pinjaman_id', '!=' ,'5')
            ->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
            ->sum('angsuran_belum_terbayar');
        
            $datashu = shu::latest()->first();
       //hutang lainyya
       $lainya = pinjaman::Where('jenis_pinjaman_id', 5)->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
       ->sum('angsuran_belum_terbayar');
         
          

        return view('laporan.neracaAwalTahun',[
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
         
          

        return view('laporan.neracaAwalTahun',[
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
    }
    public function neracaAkhirTahun()
    {
        $pitutang_Poduksi = User::where('bagian','PRODUKSI')->get();
        // dd($pitutang_Poduksi);


        //get modal produksi
        $modal_produksi =[];
        $produksi = User::where('bagian','PRODUKSI')->get();
        foreach($produksi as $produksi){
            array_push($modal_produksi, $produksi->simpananWajib);
        }
        // dd($modal_produksi);


        //get modal staff
        $modal_staff =[];
        $produksi = User::where('bagian','STAFF')->get();
        foreach($produksi as $produksi){
            array_push($modal_staff, $produksi->simpananWajib);
        }


        return view('laporan.neracaAkhirTahun',[
            'profil'=>profil::find(1),
            'piutang_produksi'=>$pitutang_Poduksi,
            'modal_staff'=>$modal_staff,
            'modal_produksi'=>$modal_produksi
        ]);
    }

    public function saldoAwal()
    {
        return view('laporan.saldoAwal' ,[
            'profil'=>profil::find(1)
        ]);
    }

    public function ImportAnggota()
    {
        return view('laporan.importAnggota' ,[
            'profil'=>profil::find(1)
        ]);
    }
    public function ImportPinjaman()
    {
        return view('laporan.importPinjaman' ,[
            'profil'=>profil::find(1)
        ]);
    }
    public function journalPenyesuaian()
    {
        return view('laporan.journalPenyesuaian',[
            'profil'=>profil::find(1),
            'akun'=>akun::orderBy('id','ASC')->get(),
            'penyesuaian'=>penyesuaian::orderBy('id','ASC')->get()
        ]);
    }
    public function tambahjournalPenyesuaian(Request $request)
    {
        penyesuaian::create([
            'akun_id'=>$request->akun_id,
            'no_transaksi'=>$request->no_transaksi,
            'keterangan'=>$request->keterangan,
            'nominal'=>$request->nominal,
        ]);
        return back();
    }
    public function akun()
    {
        return view('laporan.akun',[
            'profil'=>profil::find(1),
            'akun'=>akun::orderBy('id','ASC')->get()
        ]);
    }
    public function tambahakun(Request $request)
    {
      
        akun::create([
            'no_akun'=>$request->no_akun,
            'nama_akun'=>$request->nama_akun,
        ]);
        return back();
        
    }

    public function labaditahan()
    {
        return view('administrasi.labaditahan',[
            'profil'=>profil::find(1),
        ]);
    }
    public function penyesuaianlabaditahan(Request $request)
    {
        $cek = shu::all()->count();
        if($cek > 0){
            return back()->with('gagal','Data Sudah Ada');
        }
        shu::create([
         'sisa_shu'=>$request->sisa_shu,
         'besar_shu_dibagi'=>$request->harus_bagi
        ]);
        return back()->with('berhasil','Data Berhasil Disesuaikan');
    }
    public function penyesuaianshu()
    {
        return view('administrasi.penyesuaianshu',[
            'profil'=>profil::find(1),
        ]);
    }
    public function penyesuaianshuyangdibagi(Request $request)
    {
        return dd($request);
        $cek = laba_ditahan::where('keterangan','PENYESUAIAN AWAL SHU')->count();
        if($cek > 0){
            return back()->with('gagal','Data Sudah Ada');
        }
        laba_ditahan::create([
         'sisa_shu'=>$request->sisa_shu,
         'besar_shu_dibagi'=>$request->harus_bagi
        ]);
        return back()->with('berhasil','Data Berhasil Disesuaikan');
    }

    public function pinjamanProduksi(Request $request)
    { 
        if($request->tanggal_awal){
            return view('laporan.pinjamanProduksi',[
                'profil'=>profil::find(1),
                'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','2')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->where('status_pinjaman', 'AKTIF')->get(),
                
            ]);
    }

        return view('laporan.pinjamanProduksi',[
            'profil'=>profil::find(1),
            'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','2')
            ->where('status_pinjaman', 'AKTIF')->get()
        ]);
    }
    public function pinjamanStaff(Request $request)
    {
        if($request->tanggal_awal){
            return view('laporan.pinjamanStaff',[
                'profil'=>profil::find(1),
                'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','1')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->where('status_pinjaman', 'AKTIF')->get()
            ]);
        }
        return view('laporan.pinjamanStaff',[
            'profil'=>profil::find(1),
            'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','1')
            ->where('status_pinjaman', 'AKTIF')->get()
        ]);
    }
    public function pinjamanLainya(Request $request)
    {
        if($request->tanggal_awal){
            return view('laporan.pinjamanLainya',[
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
                ->sum('angsuran_belum_terbayar')
            ]);
            }
        return view('laporan.pinjamanLainya',[
            'profil'=>profil::find(1),
            'pinjamans'=>jenis_pinjaman::Where('id','!=', '1')
            // ->where('status_pinjaman', 'AKTIF')
            ->Where('id','!=', '2')
            ->Where('id','!=', '5')
            ->get(),
            'total'=>pinjaman::Where('jenis_pinjaman_id','!=', '1')
            ->Where('jenis_pinjaman_id','!=', '2')
            ->Where('jenis_pinjaman_id','!=', '5')
            ->sum('angsuran_belum_terbayar')
        ]);
    }

    public function hutangLainya(Request $request)
    {
        if($request->tanggal_awal){
            return view('laporan.hutangLainya',[
                'profil'=>profil::find(1),
                'pinjamans'=>jenis_pinjaman::Where('id','5')
                ->whereBetween('created_at',[$request->tanggal_awal , $request->tanggal_akhir])
                ->get(),
                'total'=>jenis_pinjaman::find(5)->pinjaman->sum('angsuran_belum_terbayar')
            ]);
        }

        return view('laporan.hutangLainya',[
            'profil'=>profil::find(1),
            'pinjamans'=>jenis_pinjaman::Where('id','5')
            ->get(),
            'total'=>jenis_pinjaman::find(5)->pinjaman->sum('angsuran_belum_terbayar')
        ]);
    }

    public function keuangan()
    {
        $keuangan =  catatan_keuangan::all();

        //masuk
        $masuk = $keuangan->where('jenis_transaksi','MASUK')->sum('nominal');
        $keluar = $keuangan->where('jenis_transaksi','KELUAR')->sum('nominal');

        return view('laporan.keuangan',[
            'profil'=>profil::find(1),
            'keuangan'=>$keuangan ,
            'saldo'=>$masuk - $keluar

        ]);
      
    }

    public function jurnal( Request $request)
    {
        if($request->tanggal_awal){
        return view('laporan.jurnal',[
            'profil'=>profil::find(1),
            'akun'=>akun::all(),
            'jurnals'=>journal::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get()
        ]);
    }

        return view('laporan.jurnal',[
            'profil'=>profil::find(1),
            'akun'=>akun::all(),
            'jurnals'=>journal::all()
        ]);
    }
    public function tambahjurnal(Request $request)
    {
       journal::create([
        'akun_id'=>$request->akun_id,
        'keterangan'=>$request->keterangan,
        'saldo_debit'=>$request->debit,
        'saldo_kredit'=>$request->kredit,
        'created_at'=>$request->tanggal
       ]);

       return back();
    }
}
