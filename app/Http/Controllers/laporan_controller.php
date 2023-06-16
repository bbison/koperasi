<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\akun;
use App\Models\simpanan;
use App\Models\profil;
use App\Models\catatan_keuangan;
use App\Models\laba_ditahan;
use App\Models\penyesuaian;
use App\Models\shu;
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
    

    public function neracaAwalTahun()
    {  
       

          //get modal produksi
          $modal_produksi =[];
          $produksi = User::where('bagian','PRODUKSI')->get();
          foreach($produksi as $produksi){
              array_push($modal_produksi, $produksi->simpanan_wajib);
          }
  
  
          //get modal staff
          $modal_staff =[];
          $produksi = User::where('bagian','STAFF')->get();
          foreach($produksi as $produksi){
              array_push($modal_staff, $produksi->simpanan_wajib);
          }

          $kas = catatan_keuangan::where('jenis_transaksi', 'MASUK')->sum('nominal') -
          catatan_keuangan::where('jenis_transaksi', 'KELUAR')->sum('nominal');

          $getdata = pinjaman::all();
          $hs = [];
          $kry=[];
          foreach($getdata as $data){

            if($data->user->bagian == 'STAFF'){
                array_push($hs, $data->angsuran_belum_terbayar);
            }
            if($data->user->bagian == 'PRODUKSI'){
                array_push($kry, $data->angsuran_belum_terbayar);
            }
          }

          if(shu::all()->count() == 0){
            $labaditahan = laba_ditahan::find(1)->nominal;
          }
          else{
            $labaditahan = shu::all()->latest()->first()->sisa_shu;
          }

          if(shu::all()->count() == 0){
            $shu = laba_ditahan::find(2)->nominal;
          }
          else{
            $nom = shu::all()->latest()->first();
            $shu = $nom->besar_shu_bersih * $nom->presentase_pembagian / 100;
          }
          
         

        return view('laporan.neracaAwalTahun',[
            'profil'=>profil::find(1),
            'modal_staff'=>array_sum($modal_staff),
            'modal_produksi'=>array_sum($modal_produksi),
            'hutang_anggota'=>User::where('hak_akses','ANGGOTA')->get(),
            'kas'=>$kas,
            'laba_ditahan'=>$labaditahan,
            'hutang_staf'=>array_sum($hs),
            'shu_harus_dibagi'=>$shu,
            'hutang_produksi'=>array_sum($kry)
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
    public function tambahjournalPenyesuaian(Request$request)
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
        $request->validate([
            'no_akun'=>['max:4'],
            'nama_akun'=>['max:25']
        ]);
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
        $cek = laba_ditahan::where('keterangan','PENYESUAIAN AWAL')->count();
        if($cek > 0){
            return back()->with('gagal','Data Sudah Ada');
        }
        laba_ditahan::create([
            'keterangan'=>'PENYESUAIAN AWAL',
            'nominal'=>$request->nominal
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
        $cek = laba_ditahan::where('keterangan','PENYESUAIAN AWAL SHU')->count();
        if($cek > 0){
            return back()->with('gagal','Data Sudah Ada');
        }
        laba_ditahan::create([
            'keterangan'=>'PENYESUAIAN AWAL SHU',
            'nominal'=>$request->nominal
        ]);
        return back()->with('berhasil','Data Berhasil Disesuaikan');
    }

    public function pinjamanProduksi()
    {
        return view('laporan.pinjamanProduksi',[
            'profil'=>profil::find(1),
        ]);
    }
    public function pinjamanStaff()
    {
        return view('laporan.pinjamanStaff',[
            'profil'=>profil::find(1),
            'pinjamans'=>pinjaman::firstWhere('status_pinjaman','AKTIF')->get()
        ]);
    }
    public function pinjamanLainya()
    {
        return view('laporan.pinjamanLainya',[
            'profil'=>profil::find(1),
        ]);
    }
}
