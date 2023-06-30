<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use App\Models\catatan_keuangan;
use App\Models\angsuran;
use App\Models\bunga_pinjaman;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profil;
use App\Models\journal;
use App\Models\rincian_journal;
use App\Models\lama_pinjam;
use App\Models\jenis_pinjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class pinjaman_controller extends Controller
{
    public function pengajuan()
    {
        return view('pinjaman.pengajuan',[
            'lama_pinjam'=>lama_pinjam::orderBy('lama','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function index()
    {
        return view('pinjaman.index',[
            'pinjaman_tunggu'=>pinjaman::where('status_pinjaman', 'Menunggu Verifikasi')->where('user_id',auth()->user()->id)->get(),
            'pinjaman_aktif' =>pinjaman::where('status_pinjaman', 'Aktif')->where('user_id',auth()->user()->id)->get(),
            'id_pinjaman'=>pinjaman::all()->count(),
            'jenis_pinjaman'=>jenis_pinjaman::all(),
            'user'=>User::orderBy('name', 'ASC')->get(),
            'lama_pinjam'=>lama_pinjam::orderBy('lama','ASC')->get(),
            'bunga'=>bunga_pinjaman::orderBy('bunga','ASC')->get(),
            'profil'=>profil::find(1)

        ]);
    }
    public function Validasi()
    {
        return view('pinjaman.validasi',[
            'pinjaman'=>pinjaman::All(),
            'profil'=>profil::find(1)
        ]);
    }
    public function bayar()
    {
        return view('pinjaman.bayar',[
            'profil'=>profil::find(1),
            'users'=>User::all()
        ]);
    }

    public function logicValidasi($id)
    {
        $data =pinjaman::find($id);
         

       
        $masuk = catatan_keuangan::where('jenis_transaksi','MASUK')->sum('nominal'); 
        $keluar = catatan_keuangan::where('jenis_transaksi','KELUAR')->sum('nominal'); 

        $saldo = $masuk - $keluar;
        $totalpinjam  = $data->angsuran_pokok  * $data->lama_pinjaman; 
// return $saldo;


        if ( intval($totalpinjam) > $saldo){
           
            return back()->with('pesan','kas tidak cukup');
        }

        
              //cek journal
              $cek = journal::where('akun_id',1)->where('created_at',$data->created_at)->where('keterangan','like','%'.'Kas Pinjaman'.'%');
  

                if($cek->count() == 0){
      
                  //create jurnal kas
                  journal ::create([
                      'keterangan'=>'Kas Pinjaman',
                      'akun_id'=>1,
                      'saldo_kredit'=>$totalpinjam,
                      'created_at'=>$data->created_at
                      
                  ]);
                }

             
      
                  //data journal 
                  $data_journal = $cek->first()->id;
      
                  //masukan jurnal simpanan
                  rincian_journal ::create([
                  'journal_id'=> $data_journal,
                  'keterangan'=>'Pinjaman '.$data->user->name,
                  'akun_id'=>$data_journal,
                  // 'saldo_debit'=>$request->debit,
                  'saldo_debit'=>$totalpinjam,
                  'created_at'=>$data->created_at
                  ]);
      
                  //update debit kas
                  $debit_kas = rincian_journal ::where('journal_id',$data_journal)->where('created_at', $data->created_at)->where('keterangan','like','%'.'Pinjaman'.'%')->sum('saldo_debit');
      
                  // return $debit_kas;+
                  journal::find($data_journal)->update([
                  'saldo_debit'=>$debit_kas,
                  ]);








        catatan_keuangan::create([
            'keterangan'=>'peminjaman '.$data->user->name,
            'nominal'=> $totalpinjam,
            'jenis_transaksi'=>'KELUAR',
            'saldo_kredit'=>$totalpinjam,
            'saldo'=> $saldo - $totalpinjam
        ]);


        // $bunga_angsuran = $data->angsuran_bunga;

        // $tagihan = intval(intval($data->total_angsuran) / intval($data->lama_pinjaman));
        // for($x = 1 ; $x <= intval($data->lama_pinjaman); $x++){
        //     angsuran::create([
        //         'pinjaman_id'=>$id,
        //         'user_id'=>$data->user->id,
        //         'bunga_angsuran'=> $bunga_angsuran,
        //         'bulan_angsuran'=>$x,
        //         'tagihan_angsuran'=> $tagihan,
        //         'jatuh_tempo'=>date('Y-m-d', strtotime( '+'.$x.' month', strtotime( date('now') )))
        //     ]);
        // }


        pinjaman::find($id)->update([
            'status_pinjaman'=>'AKTIF'
        ]);

       


     
        return redirect()->route('pinjaman.pencairan')->with('redirect', $id);
    }

    public function ajax($nominal, $bulan, $peminjam, $tanggal,$bunga)
    { 
        $bnga = bunga_pinjaman::find($bunga)->bunga;

        //angsuran pokok 
        $angsuran_pokok = intval($nominal)/ intval($bulan);
        //bunga angsuran = 
        $angsuran_bunga = $nominal * ($bnga/100) /intval($bulan);
        //total angsuran 
        $total_angsuran = $angsuran_pokok + $angsuran_bunga;

        // $total_angsuran = 
       return view('ajax.pengajuan',[
        'lama_pinjam'=>$bulan,
        'angsuran_pokok'=>$angsuran_pokok,
        'angsuran_bunga'=>$angsuran_bunga,
        'peminjam'=>user::find(intval($peminjam)),
        'tanggal'=>$tanggal,
        'bunga'=>$bnga,
        'total_angsuran'=>$total_angsuran,
        'nominal_pinjam'=>$nominal,
        'profil'=>profil::find(1)
       ]);
    }

    public function ajaxpenyesuaian($nominal, $bulan, $peminjam, $tanggal,$bunga,$sudahbayar)
    {
        $bnga = floatval($bunga);
      

        $bayar = intval($sudahbayar);

        //angsuran pokok 
        $angsuran_pokok = intval($nominal)/ intval($bulan);
        //bunga angsuran = 
        $angsuran_bunga = $nominal * ($bnga/100) /intval($bulan);
        //total angsuran 
        $total_angsuran = $angsuran_pokok + $angsuran_bunga;

        // $total_angsuran = 
       return view('ajax.penyesuaian',[
        'lama_pinjam'=>$bulan,
        'angsuran_pokok'=>$angsuran_pokok,
        'angsuran_bunga'=>$angsuran_bunga,
        'peminjam'=>user::find(intval($peminjam)),
        'tanggal'=>$tanggal,
        'bunga'=>$bnga,
        'total_angsuran'=>$total_angsuran,
        'nominal_pinjam'=>$nominal,
        'profil'=>profil::find(1),
        'sudahbayar'=>$bayar
       ]);
    }
    public function pembayaran($id_angsuran)
    {
        $cek = pinjaman::find($id_angsuran);
        if(!$cek){
            return 'Masukan Data Dengan Benar';
        }

        else if($cek->status_pinjaman =='Ditolak'){
            return 'Angsuran dengan ID Ini Ditolak';
        }


        return view('ajax.pembayaran',[
            "pinjaman"=>pinjaman::where('status_pinjaman','AKTIF')->where('user_id', $id_angsuran)->first(),
            'profil'=>profil::find(1)

        ]);
    }

    public function logicPengajuan(Request $request)
    {
        // return dd($request);
        // dd($request->lama_pinjam);
        $bnga = bunga_pinjaman::find($request->bunga_id);

       
        // dd($bnga);
         //angsuran pokok 
         $angsuran_pokok = intval($request->nominal_pinjaman ) / intval($request->lama_pinjaman) ;
       
         //bunga angsuran = 
         $angsuran_bunga = $request->nominal_pinjaman * $bnga->bunga/100 /intval($request->lama_pinjaman);
        

         
         //total angsuran 
         $total_angsuran = ($angsuran_pokok + $angsuran_bunga) * intval($request->lama_pinjaman) ;

         //cek
         $data = pinjaman::where('user_id', $request->peminjam)->where('status_pinjaman', 'Aktif')->get();
         $data_2 = pinjaman::where('user_id', $request->peminjam)->where('status_pinjaman', 'Menunggu Verifikasi')->get();
         if($data->count() != 0 ){
            return back()->with('pesan', 'Peminjam Masih Memiliki Pinjaman Aktif');
         }
         elseif($data_2->count()!= 0 ){
            return back()->with('pesan', 'Peminjam Masih Memiliki Pinjaman Yang Menunggu Verifikasi');
         }
         $kode = jenis_pinjaman::find($request->jenis_pinjaman_id)->kode;
      
         $urutan = pinjaman::where('kode','like','%'. $kode.'%')->count();
        

        pinjaman::create([
            'user_id'=>$request->peminjam,
            'bunga_pinjaman_id' =>$request->bunga_id,
            'angsuran_pokok'=>$angsuran_pokok,
            'angsuran_bunga'=>$angsuran_bunga,
            'lama_pinjaman'=>$request->lama_pinjaman,
            'total_angsuran'=>$total_angsuran,
            'kode'=>$kode.'.'.number_format((float)$urutan + 1, 3,),
            'angsuran_belum_terbayar' => $total_angsuran,
            'jenis_pinjaman_id'=>$request->jenis_pinjaman_id,
            'created_at'=>$request->tanggal_pinjam
        
        ]);

        return redirect()->route('pinjaman.index')->with('pesan', 'Berhasil Melakukan Pengajuan');
    }

    public function logicbayar(Request $request)
    {

        // return dd($request);
       
        if(!$request->bulanke) {
            return back()->with('pesan', 'Pastikan ID dan pilihan pembayaran sudah diinput');
        }
        foreach($request->bulanke as $bulan){
            // ->firstWhere('bulan_angsuran','6')
            
            $cek = angsuran::Where('pinjaman_id', $request->id_pinjaman)->where('bulan_angsuran',$bulan)->get();
            // dd($cek);
            foreach($cek as $cek){
                if($cek->status=="Belum Bayar"){
                    $cek->update([
                        'status'=> "Sudah Bayar"
                    ]);
                }
            }
        
        };


        pinjaman::find($request->id_pinjaman)->update([
        'angsuran_terbayar'=>angsuran::where('pinjaman_id', $request->id_pinjaman)->where('status', 'Sudah Bayar')->sum('tagihan_angsuran'),
        'angsuran_belum_terbayar'=>angsuran::where('pinjaman_id', $request->id_pinjaman)->where('status', 'Belum Bayar')->sum('tagihan_angsuran')
     ]);

        return redirect('/pinjaman/detail/'.$request->id_pinjaman)->with('pesan', 'Berhasil Melakukan Pembayaran'); 
    }

    public function ajaxValidasi($str)
    {
        // dd($str);
        if($str=="PaRaMeTeR"){
            return view('ajax.validasi',[
                'pinjaman'=>pinjaman::all()
            ]);
        }
        else{
            return view('ajax.validasi',[
                'pinjaman'=>pinjaman::where('status_pinjaman',$str)
                ->orwhere('id', $str)
                ->get()
            ]);

        }
     
    }
    public function lamaPinjaman()
    {
        return view('pinjaman.lamapinjam',[
            'lama_pinjam'=>lama_pinjam::orderBy('lama','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function logicLamaPinjaman(Request $request)
    {
        $cek = lama_pinjam::firstWhere('lama', $request->lama_pinjam);
     

       if($cek){
        return back()->with('pesan', 'Periode Sudah Ada');
       }
       lama_pinjam::create([
        'lama'=>$request->lama_pinjam
       ]);

       return back()->with('pesan', 'Berhasil Benambah Bunga');
    }
    public function bunga()
    {
        return view('pinjaman.bunga',[
            'bunga'=>bunga_pinjaman::orderBy('bunga','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
    public function createBunga(Request $request)
    {
    
        // if(!$bunga){
        //     return back()->with('pesan', 'Msukan Angka Dengan Benar');
        // }
        
        if(bunga_pinjaman::where('bunga',$request->bunga)->count() >= 1){
             return back()->with('pesan', 'Bunga Sudah Ada ');
        }
        bunga_pinjaman::create([
            'bunga'=>$request->bunga
        ]);
        return back()->with('pesan', 'Berhasil Menambah Bunga');
    }
    public function tolak($id)
    {
        pinjaman::find($id)->update([
            'status_pinjaman'=>'Ditolak'
        ]);
        return back()->with('pesan', 'Berhasil Menolak Pinjaman');
    }
    public function selesai($id)
    {
        $pinjaman =  pinjaman::find($id) ;
        if(angsuran::where('status', 'Belum Bayar')->where('pinjaman_id', $id)->count() !=0){
            return back()->with('pesan', 'Angsuran Belum Selesai');
        }
        pinjaman::find($id)->update([
            'status_pinjaman'=>'Selesai'
        ]);
        return back()->with('pesan', 'Angsuran Selesai');
    }

    public function detail($pinjaman_id)
    {
        return view('pinjaman.detail',[
            'pinjaman'=>pinjaman::find($pinjaman_id),
            'profil'=>profil::find(1)
        ]);

    }

    public function print($pinjaman_id)
    {
        return view('pinjaman.print',[
            'pinjaman'=>pinjaman::find($pinjaman_id),
            'profil'=>profil::find(1)
        ]);
    }
    public function kwitansi($pinjaman_id,$angsuran_id)
    {
        // $anggota = User::orderBy('name','ASC')->get();
        $nama = pinjaman::find($pinjaman_id)->user->name;
        $angsuran = angsuran::find($angsuran_id);
        $pdf = PDF::loadView('pinjaman.kwitansi',[
            'nama'=>$nama,
            'alamat'=>pinjaman::find($pinjaman_id)->user->alamat,
            'angsuran'=>$angsuran,
            'profil'=>profil::find(1)
        ]);
        return $pdf->download('kwitansi_'.$nama.'_angsuran_Ke-'.$angsuran->bulan_angsuran.'_'.date('Y'));
    }

    public function editBunga($bunga_id, Request $request)
    {
        bunga_pinjaman::find($bunga_id)->update([
            'bunga'=>$request->bunga,
        ]);
        return back()->with('pesan', 'Berhasil Update Bunga');
    }

    public function printKwitansi($pinjaman_id, $angsuran_id)
    {
        return view('pinjaman.kwitansi',[
            'profil'=>profil::find(1),
            'angsuran'=>angsuran::find($angsuran_id),
            'id_pinjaman'=>pinjaman::find($pinjaman_id),
            'sisa_angsuran'=>angsuran::where('pinjaman_id', $pinjaman_id)->where('status','Belum Bayar')->sum('tagihan_angsuran'),
        ]);
    }

    public function penyesuaian()
    {
        return view('pinjaman.penyesuaian',[
            'profil'=>profil::find(1),
            'id_pinjaman'=>pinjaman::all()->count(),
            'user'=>User::orderBy('name', 'ASC')->get(),
            'lama_pinjam'=>lama_pinjam::orderBy('lama','ASC')->get(),
            'bunga'=>bunga_pinjaman::orderBy('bunga','ASC')->get(),
        ]);
    }

    public function logicPengajuanPenyesuaian(Request $request)
    {
        // dd($request);
        $bnga = floatval($request->bunga);
        $bunga_pinjaman_id = bunga_pinjaman::firstWhere('bunga', $bnga);
         //angsuran pokok 
         $angsuran_pokok = intval($request->nominal_pinjaman ) / intval($request->lama_pinjaman) ;
         //bunga angsuran = 
         $angsuran_bunga = $request->nominal_pinjaman * $bnga/100 /intval($request->lama_pinjaman);
         //total angsuran 
         $total_angsuran = ($angsuran_pokok + $angsuran_bunga) * intval($request->lama_pinjaman) ;
         //angsudan blm bayar
         $sudah_bayar= ($angsuran_pokok + $angsuran_bunga)*$request->sudahbayar;
         $belum_bayar= $total_angsuran - $sudah_bayar;



        //tambah ke table pinjaman
        pinjaman::create([
            'user_id'=>$request->peminjam,
            'bunga_pinjaman_id' =>$bunga_pinjaman_id->id,
            'angsuran_pokok'=>$angsuran_pokok,
            'angsuran_bunga'=>$angsuran_bunga,
            'lama_pinjaman'=>$request->lama_pinjaman,
            'total_angsuran'=>$total_angsuran,
            'angsuran_terbayar'=>$sudah_bayar,
            'angsuran_belum_terbayar' => $belum_bayar
        
        ]);

        //penyesuaian angsuran
        $id = pinjaman::orderBy('created_at', 'desc')->first()->id;
        $data =pinjaman::find($id);

        //jumlah angsuran
        // $angsuran = intval($data->total_angsuran) / intval($data->lama_pinjaman);
        $bunga_angsuran = $data->angsuran_bunga;

        $tagihan = intval(intval($data->total_angsuran) / intval($data->lama_pinjaman));

        $sudahbayar = intval($request->sudahbayar);
        for($x = 1 ; $x <= intval($data->lama_pinjaman); $x++){
            if($x <= $sudahbayar){
                $status = "Sudah Bayar";
            }
            else{
                $status = "Belum Bayar";
            }
            angsuran::create([
                'pinjaman_id'=>$id,
                'user_id'=>$data->user->id,
                'bunga_angsuran'=> $bunga_angsuran,
                'bulan_angsuran'=>$x,
                'status'=>$status,
                'tagihan_angsuran'=> $tagihan,
                'jatuh_tempo'=>date('Y-m-d', strtotime( '+'.$x.' month', strtotime( date('now') )))
            ]);
        }


        pinjaman::find($id)->update([
            'status_pinjaman'=>'Aktif'
        ]);

        return back()->with('pesan', 'Berhasil Silahkan Bisa Di Cek Di Data Pinjaman');


    }
    
    public function jenispinjaman()
    {
        return view('pinjaman.jenispinjaman',[
            'jenis_pinjaman'=>jenis_pinjaman::all(),
            'profil'=>profil::find(1),
        ]);

    }

    public function tambahjenispinjaman(Request $request)
    {
        jenis_pinjaman::create([
            'jenis_pinjaman'=>$request->jenis_pinjaman,
            'kode'=>$request->kode_pinjaman,
        ]);

        return back()->with('pesan','Berhasl Menambah Data');
    }
    public function editjenispinjaman(Request $request)
    {
        jenis_pinjaman::find($request->id)->update([
            'jenis_pinjaman'=>$request->jenis_pinjaman
        ]);

        return back()->with('pesan','Berhasl Menambah Data');
    }

    public function bayarpinjaman()
    {
        return view('pinjaman.bayarpinjaman',[
            'profil'=>profil::find(1),
            'peminjam'=>pinjaman::where('status_pinjaman','AKTIF')->get(),
        ]);
    }

    public function ajaxbayar($id)
    {
        return view('ajax.bayar',[
            'peminjam'=>pinjaman::find($id)
        ]);
    }
    public function prosesbayarpinjaman(Request $request)
    {
       

        // return dd(journal::where('akun_id',1)->where('created_at',$request->tanggal)->where('keterangan','like','%'.'Kas Bayar Angsuran'.'%')->get());
        //tambah ke detail angsuran
        $bulanke = angsuran::where('pinjaman_id',$request->pinjaman_id)->count();
        angsuran::create([
            'pinjaman_id'=>$request->pinjaman_id,
            'user_id'=>$request->user_id,
            'bunga_angsuran'=>$request->nominal_angsuran_bunga,
            'tagihan_angsuran'=>$request->nominal_angsuran_pokok,
            'bulan_angsuran'=>$bulanke +1,
            'status'=>'Sudah Bayar',
            'bagi_shu'=>'Belum Dibagi',
            'jatuh_tempo'=>$request->tanggal,
            'pembulatan'=>$request->pembulatan
        ]);


        //masukan ke catatan keuangan
        catatan_keuangan::create([
            'keterangan'=>'Pembayaran Angsuran '.User::find($request->user_id)->name.' Pembayaran ke '.$bulanke+1,
            'nominal'=>$request->nominal_angsuran_pokok + $request->nominal_angsuran_bunga + $request->pembulatan,
            'jenis_transaksi'=>'MASUK',
            'saldo_debit'=>$request->nominal_angsuran_pokok + $request->nominal_angsuran_bunga + $request->pembulatan,
            'saldo'=>catatan_keuangan::latest()->first()->saldo + $request->nominal_angsuran_pokok + $request->nominal_angsuran_bunga
        ]);

        //mengurangi angsuran 
        pinjaman::find($request->pinjaman_id)->update([
            'angsuran_belum_terbayar'=> pinjaman::find($request->pinjaman_id)->angsuran_belum_terbayar -($request->nominal_angsuran_bunga + $request->nominal_angsuran_pokok) 
        ]);

        //total bayar user
        $totalbayar = $request->nominal_angsuran_pokok + $request->nominal_angsuran_bunga + $request->pembulatan;
      
 
           //cek journal
           $cek = journal::where('akun_id',1)->where('created_at',$request->tanggal)->where('keterangan','like','%'.'Kas Bayar Angsuran'.'%');
  

           if($cek->count() == 0){
 
             //create jurnal kas
             journal ::create([
                 'keterangan'=>'Kas Bayar Angsuran',
                 'akun_id'=>1,
                 'saldo_debit'=>$totalbayar,
                 'created_at'=>$request->tanggal
                 
             ]);
           }

             //data journal 
             $data_journal = $cek->first()->id;
      
             //masukan jurnal pokok 
             rincian_journal ::create([
             'journal_id'=> $data_journal,
             'keterangan'=>'Bayar Angsuran '.User::find($request->user_id)->name,
             'akun_id'=>$data_journal,
             // 'saldo_debit'=>$request->debit,
             'saldo_kredit'=>$request->nominal_angsuran_pokok,
             'created_at'=>$request->tanggal
             ]);


             //masukan jurnal bunga 
             rincian_journal ::create([
             'journal_id'=> $data_journal,
             'keterangan'=>'Bunga Angsuran '.User::find($request->user_id)->name,
             'akun_id'=>$data_journal,
             // 'saldo_debit'=>$request->debit,
             'saldo_kredit'=>$request->nominal_angsuran_bunga,
             'created_at'=>$request->tanggal
             ]);

             if($request->pembulatan != 0 ){
                rincian_journal ::create([
                    'journal_id'=> $data_journal,
                    'keterangan'=>'Pembulatan Angsuran '.User::find($request->user_id)->name,
                    'akun_id'=>$data_journal,
                    // 'saldo_debit'=>$request->debit,
                    'saldo_kredit'=>$request->pembulatan,
                    'created_at'=>$request->tanggal
                    ]);
             }




             //update debit kas
             $debit_kas = rincian_journal ::where('journal_id',$data_journal)
             ->where('created_at', $request->tanggal)
             ->orWhere('keterangan','like','%'.'Bayar Angsuran'.'%')
             ->orWhere('keterangan','like','%'.'Bunga Angsuran'.'%')
             ->orWhere('keterangan','like','%'.'Pembulatan Angsuran'.'%')
             ->sum('saldo_kredit');
 
             // return $debit_kas;+
             journal::find($data_journal)->update([
             'saldo_debit'=>$debit_kas,
             ]);


        //redirect
        return back()->with('pesan', 'berhasil Membayar Angsuran');
    }
}
