<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profil;
use App\Models\simpanan;
use App\Models\simpanan_Wajib;
use App\Models\journal;
use App\Models\rincian_journal;
use App\Models\catatan_keuangan;

class simpanan_Controller extends Controller
{
    public function index()
    {
        return view('simpanan.index',[
            'users'=>User::orderBy('name', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }

    //simpanan pokok
    public function pokokIndex()
    {
        return view('administrasi.simpanan_pokok.index',[
            'anggotas'=>User::orderBy('name', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function pokokStore(Request $request)
    {
        User::find($request->id)->update([
            'simpanan_pokok'=>$request->simpanan_pokok
        ]);
        return back();
    }








    //simpanan wajib
    public function wajibIndex()
    {
        return view('administrasi.simpanan_wajib.index',[
            'anggotas'=>User::orderBy('name', 'ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function wajibStore(Request $request)
    {
        
        //cek journal
        $cek = journal::where('akun_id',1)->where('created_at',$request->tanggal)->where('keterangan','like','%'.'kas simpanan'.'%');

        if($cek->count() == 0){

            //create jurnal kas
            journal ::create([
                'keterangan'=>'kas simpanan',
                'akun_id'=>1,
                'saldo_debit'=>$request->simpanan_wajib,
                'created_at'=>$request->tanggal
                
            ]);
        }

            //data journal 
            $data = $cek->first()->id;

            //masukan jurnal simpanan
            rincian_journal ::create([
            'journal_id'=> $data,
            'keterangan'=>'Simpanan '.user::find($request->id)->name,
            'akun_id'=>$data,
            // 'saldo_debit'=>$request->debit,
            'saldo_kredit'=>$request->simpanan_wajib,
            'created_at'=>$request->tanggal
            ]);

            //update debit kas
            $debit_kas = rincian_journal ::where('journal_id',$data)->where('created_at', $request->tanggal)->where('keterangan','like','%'.'Simpanan'.'%')->sum('saldo_kredit');

            // return $debit_kas;+
            journal::find($data)->update([
            'saldo_debit'=>$debit_kas,
            ]);

        simpanan_Wajib::create([
            'simpanan_wajib'=>$request->simpanan_wajib,
            'user_id'=>$request->id,
            'no_simpanan'=>$request->id,
            'created_at'=>$request->tanggal
        ]);







        //saldo sekarang
        $saldo =  catatan_keuangan::latest()->first()->saldo;

        $cek = catatan_keuangan::create([
            'keterangan'=>'simpanan Wajib '.User::find($request->id)->name,
            'saldo_kredit'=>'',
            'saldo_debit'=>$request->simpanan_wajib,
            'nominal'=>$request->simpanan_wajib,
            'akun_id'=>1,
            'saldo'=>$request->simpanan_wajib + $saldo,
            'jenis_transaksi'=>'MASUK'

        ]);

   

        $hasil = simpanan_wajib::where('user_id',$request->id)->sum('simpanan_Wajib');
    
        User::find($request->id)->update([
            'simpanan_wajib'=>$hasil
        ]);
      

        return redirect('/simpanan-wajib/detail/'.$request->id);
    }








    //simpanan sukarela
    public function pokoksukarela()
    {
        return view('administrasi.simpanan_sukarela.index',[
            'anggotas'=>User::orderBy('name','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }


    public function sukarelaStore(Request $request)
    {
              //cek journal
              $cek = journal::where('akun_id',1)->where('created_at',$request->tanggal)->where('keterangan','like','%'.'kas tabungan'.'%');

                if($cek->count() == 0){
      
                  //create jurnal kas
                  journal ::create([
                      'keterangan'=>'kas tabungan',
                      'akun_id'=>1,
                      'saldo_debit'=>$request->simpanan_wajib,
                      'created_at'=>$request->tanggal
                      
                  ]);
                }
      
                  //data journal 
                  $data = $cek->first()->id;
      
                  //masukan jurnal simpanan
                  rincian_journal ::create([
                  'journal_id'=> $data,
                  'keterangan'=>'Tabungan '.user::find($request->id)->name,
                  'akun_id'=>$data,
                  // 'saldo_debit'=>$request->debit,
                  'saldo_kredit'=>$request->simpanan_sukarela,
                  'created_at'=>$request->tanggal
                  ]);
      
                  //update debit kas
                  $debit_kas = rincian_journal ::where('journal_id',$data)->where('created_at', $request->tanggal)->where('keterangan','like','%'.'Tabungan'.'%')->sum('saldo_kredit');
      
                  // return $debit_kas;+
                  journal::find($data)->update([
                  'saldo_debit'=>$debit_kas,
                  ]);

        simpanan::create([
            'simpanan_suka_rela'=>$request->simpanan_sukarela,
            'user_id'=>$request->id,
            'no_simpanan'=>$request->id,
            'created_at'=>$request->tanggal
        ]);
        $saldo =  catatan_keuangan::latest()->first()->saldo;

        $cek = catatan_keuangan::create([
            'keterangan'=>'Tabungan '.User::find($request->id)->name,
            'saldo_kredit'=>'',
            'saldo_debit'=>$request->simpanan_sukarela,
            'nominal'=>$request->simpanan_sukarela,
            'akun_id'=>1,
            'saldo'=>$request->simpanan_sukarela + $saldo,
            'jenis_transaksi'=>'MASUK'

        ]);
        $hasil = simpanan::where('user_id',$request->id)->sum('simpanan_suka_rela');
           //update total
        User::find($request->id)->update([
            'simpanan_sukarela'=>$hasil
        ]);
      
        return back();
    }


    public function ajaxSimpanan($jenis_simpanan, $user_id)
    {
        $data = User::find($user_id);
        if(!$data){
            return 'Data Tidak Ada';
        }

        elseif($jenis_simpanan == "simpanan_wajib"){   

          
            return view('ajax.simpanan_wajib',[
                'anggota'=>$data,
                'profil'=>profil::find(1)
            ]);
        }
        elseif($jenis_simpanan == "simpanan_pokok"){   

          
            return view('ajax.simpanan_pokok',[
                'anggota'=>$data,
                'profil'=>profil::find(1)
            ]);
        }
        elseif($jenis_simpanan == "simpanan_sukarela"){
            return view('ajax.simpanan_sukarela',[
                'anggota'=>$data,
                'profil'=>profil::find(1)
            ]);
        }
    }

    public function pokokDetail($user_id)
    {
        return view('simpanan.detailWajib',[
            'user'=>User::find($user_id),
            'profil'=>profil::find(1)
        ]);
    }

    //terbaru
    public function simpananWajibStaff(Request $request)
    {
        if($request->tanggal_awal){
            return view('simpanan.wajibstaff',[
          
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'STAFF')
                ->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
                ->where('simpanan_wajib','!=','0')->get()
            ]); 
        }
       return view('simpanan.wajibstaff',[
          
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'STAFF')->where('simpanan_wajib','!=','0')->get()
        ]);
    }
    public function simpananWajibProduksi(Request $request)
    {
        if($request->tanggal_awal){
            return view('simpanan.wajibproduksi',[
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'PRODUKSI')
                ->whereBetween('created_at',[$request->tanggal_awal, $request->tanggal_akhir])
                ->where('simpanan_wajib','!=','0')->get()
            ]); 
        }
        return view('simpanan.wajibproduksi',[
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'PRODUKSI')
            ->where('simpanan_wajib','!=','0')->get()
        ]);
    }
    public function simpananSukarelaStaff(Request $request)
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
         
            return view('simpanan.sukarelastaff',[
                'profil'=>profil::find(1),
                'users'=>user::where('bagian', 'STAFF')
                ->where('simpanan_sukarela','!=','0')->get()
            ]);
        }
        return view('simpanan.sukarelastaff',[
            'profil'=>profil::find(1),
            'users'=>user::where('bagian', 'STAFF')->where('simpanan_sukarela','!=','0')->get()
        ]);
    }
    public function FunctionName()
    {
        # code...
    }


     
    
}
