<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\pinjaman;
use App\Models\profil;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use App\Imports\UsersImport;
use App\Models\catatan_keuangan;
use App\Imports\simpanan_wajibImport;
use App\Imports\simpananImport;
use App\Imports\pinjamanImport;
use Maatwebsite\Excel\Facades\Excel;


class main_controller extends Controller
{
    public function index()
    {
        return view('login',[
            'profil'=>profil::find(1)
        ]);
    }
    public function login(Request $request)
    {
        $auth = auth::attempt([
            'id'=>$request->input('id'),
            'password'=>$request->input('password')
        ]);


        if($auth){
            return redirect()->intended('/profile');
        }
        else{
            return back()->with('pesan', 'GAGAL Silahkan Cek Id Dan Password Anda')->withInput();
        }
       
       
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
        
    }
    public function dashboard()
    {
        return view('verifed.index',[
            'pinjaman_tunggu'=>pinjaman::where('status_pinjaman', 'Menunggu Verifikasi')->where('user_id',auth()->user()->id)->get(),
            'pinjaman_aktif' =>pinjaman::where('status_pinjaman', 'Aktif')->where('user_id',auth()->user()->id)->get(),
            'profil'=>profil::find(1)
        ]);
    }

    public function downloadBuktiPembayaran()
    {
        // $pdf = Pdf::loadView('pdf.invoice');
        //
    //  return $pdf->download('invoice.pdf');
    }
    public function prosesImportAnggota(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file_import_anggota'));
        Excel::import(new simpanan_wajibImport, $request->file('file_import_anggota'));
        Excel::import(new simpananImport, $request->file('file_import_anggota'));
        
        return back()->with('pesan', 'Berhasil Import Data');
    }
    public function prosesImportPinjaman(Request $request)
    {
        // dd($request);
        Excel::import(new pinjamanImport, $request->file('file_import_pinjaman'));

        
        return back()->with('pesan', 'Berhasil Import Data');
    }
    public function masukansaldoawal(Request $request)
    {
        $cek =catatan_keuangan::where( 'keterangan','PENYESUAIAN SALDO AWAL')->count();
        if($cek >0){
            return back()->with('gagal', 'Saldo Awal Sudah Disesuaikan');
        }
        else{
            catatan_keuangan::create([
                'keterangan'=> 'PENYESUAIAN SALDO AWAL',
                'nominal'=> $request->nominal,
                'jenis_transaksi'=>'MASUK'
            ]);
            return back()->with('berhasil', 'Berhasil Mengatur Saldo Awal');
        }
      
    }
    public function importPinjaman()
    {
        return view('pinjaman.import',[
            'profil'=>profil::find(1)
        ]);
    }
}
