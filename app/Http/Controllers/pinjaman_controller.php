<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use App\Models\angsuran;
use App\Models\bunga_pinjaman;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profil;
use App\Models\lama_pinjam;
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
            'profil'=>profil::find(1)
        ]);
    }

    public function logicValidasi($id)
    {
        $data =pinjaman::find($id);
        //jumlah angsuran
        // $angsuran = intval($data->total_angsuran) / intval($data->lama_pinjaman);
        $bunga_angsuran = $data->angsuran_bunga;

        $tagihan = intval(intval($data->total_angsuran) / intval($data->lama_pinjaman));
        for($x = 1 ; $x <= intval($data->lama_pinjaman); $x++){
            angsuran::create([
                'pinjaman_id'=>$id,
                'user_id'=>$data->user->id,
                'bunga_angsuran'=> $bunga_angsuran,
                'bulan_angsuran'=>$x,
                'tagihan_angsuran'=> $tagihan,
                'jatuh_tempo'=>date('Y-m-d', strtotime( '+'.$x.' month', strtotime( date('now') )))
            ]);
        }


        pinjaman::find($id)->update([
            'status_pinjaman'=>'Aktif'
        ]);
        return redirect()->route('pinjaman.pencairan')->with('redirect', $id);
    }

    public function ajax($nominal, $bulan, $peminjam, $tanggal,$bunga)
    { 
        $bnga = intval($bunga);

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
            "pinjaman"=>pinjaman::find($id_angsuran),
            'profil'=>profil::find(1)

        ]);
    }

    public function logicPengajuan(Request $request)
    {
        // dd($request->lama_pinjam);
        $bnga = intval($request->bunga);

        $bunga_pinjaman_id = bunga_pinjaman::firstWhere('bunga', $bnga);

         //angsuran pokok 
         $angsuran_pokok = intval($request->nominal_pinjaman ) / intval($request->lama_pinjaman) ;
       
         //bunga angsuran = 
         $angsuran_bunga = $request->nominal_pinjaman * $bnga/100 /intval($request->lama_pinjaman);
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
         
        pinjaman::create([
            'user_id'=>$request->peminjam,
            'bunga_pinjaman_id' =>$bunga_pinjaman_id->id,
            'angsuran_pokok'=>$angsuran_pokok,
            'angsuran_bunga'=>$angsuran_bunga,
            'lama_pinjaman'=>$request->lama_pinjaman,
            'total_angsuran'=>$total_angsuran,
            'angsuran_belum_terbayar' => $total_angsuran
        
        ]);

        return redirect()->route('pinjaman.index')->with('pesan', 'Berhasil Melakukan Pengajuan');
    }

    public function logicbayar(Request $request)
    {
       
        if(!$request->bulanke) {
            return back()->with('pesan', 'Pastikan ID dan pilihan pembayaran sudah diinput');
        }
        foreach($request->bulanke as $bulan){
            // ->firstWhere('bulan_angsuran','6')
            
            $cek = angsuran::Where('pinjaman_id', $request->id)->where('bulan_angsuran',$bulan)->get();
            // dd($cek);
            foreach($cek as $cek){
                if($cek->status=="Belum Bayar"){
                    $cek->update([
                        'status'=> "Sudah Bayar"
                    ]);
                }
            }
        
        };


        pinjaman::find($request->id)->update([
        'angsuran_terbayar'=>angsuran::where('pinjaman_id', $request->id)->where('status', 'Sudah Bayar')->sum('tagihan_angsuran'),
        'angsuran_belum_terbayar'=>angsuran::where('pinjaman_id', $request->id)->where('status', 'Belum Bayar')->sum('tagihan_angsuran')
     ]);

        return redirect('/pinjaman/detail/'.$request->id)->with('pesan', 'Berhasil Melakukan Pembayaran'); 
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
}
