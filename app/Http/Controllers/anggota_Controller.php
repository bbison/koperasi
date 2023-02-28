<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\simpanan;
use App\Models\simpanan_Wajib;
use App\Models\profil;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class anggota_Controller extends Controller
{
    public function daftar()
    {
        return view('anggota.daftar',[
            'anggotas'=>User::all(),//samain dengan ajax
            'profil'=>profil::find(1)
        ]);
    }
    public function create(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name'=>['required'],
            'simpanan_wajib'=>['required'],
            'simpanan_pokok'=>[''],
            'simpanan_sukarela'=>['required'],
            'alamat'=> [],
            'bagian'=> [],
        ]);
        //simpan simpanan sukarela
        simpanan::create([
            'simpanan_suka_rela'=>$request->simpanan_sukarela,
            'user_id'=>user::all()->count() + 1,
            'no_simpanan'=>user::all()->count() + 1
        ]);

        //simpan simpananwajib 
        simpanan_Wajib::create([
            'simpanan_wajib'=>$request->simpanan_wajib,
            'user_id'=>user::all()->count() + 1,
            'no_simpanan'=>user::all()->count() + 1,
        ]);

        User::create($validated);

        return back()->with('pesan', 'Anggota Berhasil Ditambah');
    }
    public function show(Request $request,$id)
    {
      
        $id = Crypt::decryptString($id);
        return view('anggota.show',[
            'anggota'=>User::find($id),
            'profil'=>profil::find(1)
        ]);
    }
    public function update(Request $request)
    {
        User::find($request->id)->update([
            'name'=>$request->name,
            'hak_akses'=>$request->hak_akses,
            'created_at'=>$request->created_at
        ]);

        return back()->with('pesan', 'Berhasil Update Data Anggota');
    }

    public function updatepassword()
    {
        return view('verifed.updatepassword',[
            'profil'=>profil::find(1)
        ]);
    }
    public function logicupdatepassword(Request $request)
    {
        if(Hash::check($request->password_lama, auth()->user()->password)){
            if($request->password_baru == ""){
                return back()->with('pesan', 'Masukan Password Baru');
            }
            User::find(auth()->user()->id)->update([
                'password'=> bcrypt($request->password_baru)
            ]);
            return back()->with('pesan', 'Password Berhasil Di Update');
        }
        else
        {
            return back()->with('pesan', 'Password Lama Salah');
        }

        
        
    }






    //ajax
    public function ajaxSimpananWajib($parameter)
    {  
        $id = Crypt::decryptString($parameter);
        return view('ajax.simpanan_wajib',[
            'anggota'=>User::find($id),
            'profil'=>profil::find(1)
        ]);
    }
    public function ajaxSimpananSukarela($parameter)
    {
      
        $id = Crypt::decryptString($parameter);
        return view('ajax.simpanan_sukarela',[
            'anggota'=>User::find($id),
            'profil'=>profil::find(1)
        ]);
    }
    public function ajaxAnggota($filter)
    {
        return view('ajax.anggota',[
            'anggotas'=>User::where('id','like','%'.$filter.'%')
            ->orWhere('name','like','%'.$filter.'%')->get()
        ]);
    }
    public function ajaxAnggotaKosong()
    {
        return view('ajax.anggota',[
            'anggotas'=>User::all()
        ]);
    }
    public function keluar(Request $request)
    {
        if( user::find($request->user_id)->hak_akses =='ADMINISTRATOR'){
            return back()->with('pesan','Administrator Tidak Bisa Dikeluarkan');
        }
        user::find($request->user_id)->update([
            'simpanan_wajib'=> 0,
            'simpanan_sukarela'=> 0,
            'hak_akses'=>'Keluar'
        ]);
        simpanan::where('user_id', $request->user_id)->update([
            'simpanan_suka_rela'=> 0,
        ]);
        simpanan_Wajib::where('user_id', $request->user_id)->update([
            'simpanan_wajib'=> 0,
        ]);
        return back()->with('pesan','Anggota Berhasil Dikeluarkan');
    }
}
