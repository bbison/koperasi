<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\shu;
use App\Models\User;
use App\Models\profil;
use App\Models\journal;
use App\Models\rincian_journal;
use App\Models\catatan_keuangan;
use App\Models\pembagian_shu;
use App\Models\pinjaman;
use App\Models\angsuran;

class shu_controller extends Controller
{
    
    public function index(){

      
        // $nominal_shu = [];
        // $total_shu = angsuran::where('bagi_shu', 'Belum Dibagi')->where('status','Sudah Bayar')->get();
        // // dd( shu::all()->count());

        // if( shu::all()->count() == 0 or shu::all()->count()==1){
        //     $sisa_modal_terakhir = 0;
        // }
        // else{
        //     $id = shu::count() - 1;
        //     $sisa_modal_terakhir = shu::find($id)->sisa_shu;
        // }
        // foreach($total_shu as $shu){
        //     $bunga_terbayar = $shu->tagihan_angsuran - $shu->pinjaman->angsuran_pokok;
        //     array_push($nominal_shu, $bunga_terbayar);
        // }

        if(shu::count()==0){
            $sisa_shu = 0;
        }
        else{
            $sisa_shu = shu::latest()->first()->sisa_shu;
        
        }
        $shu = angsuran::where('bagi_shu','Belum DIbagi')->where('status', 'Sudah Bayar')->sum('bunga_angsuran');
       
        return view('shu.index',[
           'total_shu_kotor'=>$shu,
           'profil'=>profil::find(1),
           'shu'=>shu::orderBy('id','ASC')->get(),
           'sisa_shu' => $sisa_shu
        ]);
    }
    public function store(Request $request)
    {
        
        $shu_bersih = (intval($request->nominal) - intval($request->operasional) + $request->sisa_shu_sebelumnya ) ;
        $sisa_shu =((100 - intval($request->presentase)) /100 ) * $shu_bersih   ;
   
     
        shu::create([
            'besar_shu_kotor'=>intval($request->nominal) + $request->sisa_shu_sebelumnya  ,
            'besar_shu_bersih'=>$shu_bersih,
            'biaya_operasional'=>intval($request->operasional),
            'presentase_pembagian'=>intval($request->presentase),
            'sisa_shu'=>$sisa_shu,
            'besar_shu_dibagi'=>$shu_bersih * intval($request->presentase)/100,
            'created_at'=>$request->tanggal
        
        ]);

        //tambah ke journal

        $cek = journal::where('akun_id',1)->where('created_at',$request->tanggal)->where('keterangan','like','%'.'Kas Pembagian SHU'.'%');
        if($cek->count() == 0){
      
            //create jurnal kas
            journal ::create([
                'keterangan'=>'Kas Pembagian SHU',
                'akun_id'=>1,
                'saldo_debit'=>$shu_bersih * intval($request->presentase)/100,
                'created_at'=>$request->tanggal
                
            ]);
          }

            //data journal 
            $data = $cek->first()->id;

            //masukan jurnal shu
            rincian_journal ::create([
            'journal_id'=> $data,
            'keterangan'=>'Kas Pembagian SHU',
            'akun_id'=>$data,
            // 'saldo_debit'=>$request->debit,
            'saldo_kredit'=>$shu_bersih * intval($request->presentase)/100,
            'created_at'=>$request->tanggal
            ]);

            //update debit kas
            $debit_kas = rincian_journal ::where('journal_id',$data)
            ->where('created_at', $request->tanggal)
            ->where('keterangan','like','%'.'Kas Pembagian SHU'.'%')
            ->orWhere('keterangan','like','%'.'Kas Biaya Operasional SHU'.'%')
            ->sum('saldo_kredit');




            // return $debit_kas;+
            journal::find($data)->update([
            'saldo_debit'=>$debit_kas,
            ]);

             //masukan jurnal biaya operasional
             rincian_journal ::create([
                'journal_id'=> $data,
                'keterangan'=>'Kas Biaya Operasional SHU',
                'akun_id'=>$data,
                // 'saldo_debit'=>$request->debit,
                'saldo_kredit'=>intval($request->operasional),
                'created_at'=>$request->tanggal
                ]);
    
                //update debit kas
                $debit_kas = rincian_journal ::where('journal_id',$data)
                ->where('created_at', $request->tanggal)
                ->where('keterangan','like','%'.'Kas Pembagian SHU'.'%')
                ->orWhere('keterangan','like','%'.'Kas Biaya Operasional SHU'.'%')
                ->sum('saldo_kredit');
    
                // return $debit_kas;+
                journal::find($data)->update([
                'saldo_debit'=>$debit_kas,
                ]);

                angsuran ::where('bagi_shu','Belum Dibagi')->update([
                    'bagi_shu'=>'Sudah Dibagi'
                ]);










            $saldo =  catatan_keuangan::latest()->first()->saldo;

            //shu dibagi mengurngi kas
            catatan_keuangan::create([
                'keterangan'=>'SHU Harus Dibagi',
                'saldo_kredit'=>$shu_bersih * intval($request->presentase)/100,
                'saldo_debit'=>'',
                'nominal'=>$shu_bersih * intval($request->presentase)/100,
                'akun_id'=>1,
                'saldo'=>$saldo - $shu_bersih * intval($request->presentase)/100,
                'jenis_transaksi'=>'KELUAR'
    
            ]);

             //biaya operasional dibagi mengurangi kas
             $saldo =  catatan_keuangan::latest()->first()->saldo;

             //shu dibagi mengurngi kas
             catatan_keuangan::create([
                 'keterangan'=>'Biaya Operasional',
                 'saldo_kredit'=>intval($request->operasional),
                 'saldo_debit'=>'',
                 'nominal'=>intval($request->operasional),
                 'akun_id'=>1,
                 'saldo'=>$saldo - intval($request->operasional),
                 'jenis_transaksi'=>'KELUAR'
     
             ]);


        return back()->with('pesan', 'Periode Selesai Silahkan Bagi SHU');
    }
    public function update(Request $request)
    {
        shu::Find($request->idshu)->update([
            'besar_shu'=>$request->besarshu
        ]);
        return back()->with('pesan', 'Berhasil Edit SHU');
    }

    public function destroy($id)
    {
        shu::find($id)->delete();
        return back()->with('pesan', 'Berhasil Hapus SHU');
    }

    public function penerima($idshu)
    {
        return view('shu.penerima',[
            'penerima'=>pembagian_shu::where('shu_id',$idshu)->get(),
            'profil'=>profil::find(1),
            'shu'=>shu::find($idshu),
            'besar_bagi_shu'=>shu::find($idshu)->besar_shu - shu::find($idshu)->sisa_shu ,
        ]);
    }
    public function printPenerimaShu($idshu)
    {
        return view('shu.printPenerima',[
            'penerima'=>pembagian_shu::where('shu_id',$idshu)->get(),
            'profil'=>profil::find(1),
            'shu'=>shu::find($idshu),
            'besar_bagi_shu'=>shu::find($idshu)->besar_shu - shu::find($idshu)->sisa_shu ,
        ]);
    }


    public function bagi( $shu_id, Request $request)
    {
       //get data shu
       $shu = shu::find($shu_id);

       //cek sudah di bagi atau belum
       if(pembagian_shu::where('shu_id',$shu->id)->count() >= 1){
        return back()->with('pesan', 'SHU Sudah Dibagi');
       }


    //    if(shu::count()>=2){
    //     $id = shu::count();
    //     $shusebelumnya = shu::find($id -1);
    //     $sisa_shu_sebelumnya = $shusebelumnya->sisa_shu;
    //    }
    //    else{
    //     $sisa_shu_sebelumnya = 0;
    //    }

       $nominal = shu::latest()->first()->besar__shu_dibagi ;
   
        $total_modal_semua_anggota = [];

        $modal = User::where('hak_akses','!=', 'Keluar')->get();
        foreach($modal as $modal){
            $total_user = $modal->simpanan_wajib + $modal->simpanan_pokok + $modal->simpanan_sukarela + $modal->angsuranTerbayarDanBelumBagi->sum('bunga_angsuran');
            array_push($total_modal_semua_anggota, $total_user);
        }

     
          //get user
        $user = User::where('hak_akses','!=', 'Keluar')->get();
        // dd($user);

        foreach($user as $user){
            $terima = $nominal * ($user->simpanan_wajib + $user->simpanan_sukarela + $user->angsuranTerbayarDanBelumBagi->sum('bunga_angsuran')) / array_sum($total_modal_semua_anggota) * 100 / 100  ;

            pembagian_shu::create([
                'user_id'=>$user->id,
                'shu_id'=>$shu->id,
                'nama'=>$user->name,
                'nominal'=>$terima,
                'presentase'=>($user->simpanan_wajib + $user->simpanan_sukarela + $user->angsuranTerbayarDanBelumBagi->sum('bunga_angsuran')) / array_sum($total_modal_semua_anggota),
            ]);

        }
        angsuran::where('status','Sudah Bayar')->update([
            'bagi_shu'=>'Sudah Dibagi'
        ]);

       return back()->with('pesan', 'SHU Berhasil Dibagi');
    }


    public function pengaturan()
    {
            return view('shu.pengaturan',[
                'shu'=>shu::all(),
                'profil'=>profil::find(1)
            ]);   
    }

    public function logicPengaturan(Request $request)
    {
        dd($request);
    }

    public function pembagian()
    {
      
        return view('shu.pembagian',[
            'shu'=>shu::latest()->get(),
            'profil'=>profil::find(1),
        ]);
    }
 
}
