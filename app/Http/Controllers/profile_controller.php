<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profil;
use Illuminate\Support\Facades\File; 

class profile_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index',[
            'profil'=>profil::find(1)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('profile.edit',[
            'profil'=>profil::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $valid = $request->validate([
            'nama_koperasi'=>['required'],
            'logo'=>['image'],
            'alamat'=>['required'],
            'telepon'=>['required'],
            'ketua'=>['required'],
            'wakil_ketua'=>['required'],
            'sekertaris'=>['required'],
            'bendahara'=>['required'],
        ]);
        if(!$valid){
            return back()->with('pesan', 'Isi Semua Data Dengan Benar');
        }
        $cekdata = profil::find($id);
        $cekdata->update($valid);

        $cek_foto_lama = $cekdata->logo;

        if($request->file('logo') == null){
            // $cekdata->update([
            //     'logo'=> $request->file('logo')->store('/')
            // ]);
        }

        elseif($cek_foto_lama == 'koperasi-1.png'){
            $cekdata->update([
                'logo'=> $request->file('logo')->store('/')
            ]);
        }
        else{
            if(url('') == "http://127.0.0.1:8000")
                {
                    File :: delete('/logo/'.profil::find($id)->logo);

                }
            else{
                File :: delete('/public/logo/'.profil::find($id)->logo);
            }
          
                $cekdata->update([
                    'logo'=> $request->file('logo')->store('/')
                ]);
        }
       


        return back()->with('pesan', 'Berhasil Update Profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
