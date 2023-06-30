<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pinjaman;
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

class print_controller extends Controller
{
    public function pinjamanstaff()
    {
        return view('print.pinjamanstaff',[
            'profil'=>profil::find(1),
            'pinjamans'=>pinjaman::Where('jenis_pinjaman_id','1')
            ->where('status_pinjaman', 'AKTIF')->get()
        ]);
    }
}
