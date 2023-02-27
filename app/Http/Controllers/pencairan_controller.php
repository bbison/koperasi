<?php

namespace App\Http\Controllers;

use App\Models\pinjaman;
use Illuminate\Http\Request;
use App\Models\profil;

class pencairan_controller extends Controller
{
    public function index()
    {
        return view('pencairan.index' ,[
            'pinjaman'=>pinjaman::orderBy('id','ASC')->get(),
            'profil'=>profil::find(1)
        ]);
    }
}
