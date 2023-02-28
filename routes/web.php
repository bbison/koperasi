<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main_controller;
use App\Http\Controllers\pinjaman_controller;
use App\Http\Controllers\simpanan_Controller;
use App\Http\Controllers\anggota_Controller;
use App\Http\Controllers\shu_controller;
use App\Http\Controllers\pencairan_controller;
use App\Http\Controllers\laporan_controller;
use App\Http\Controllers\profile_controller;

Route::get('/',[main_controller::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[main_controller::class, 'login'])->name('logiclogin')->middleware('guest');
Route::get('/dashboard',[main_controller::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout',[main_controller::class, 'logout'])->name('logout')->Middleware('auth');


Route::name('shu.')->group(function () {
    Route::get('/shu',[shu_controller::class, 'index'])->name('index')->Middleware('auth');
    Route::get('/shu-pembagian',[shu_controller::class, 'pembagian'])->name('pembagian')->Middleware('auth');
    Route::post('/shu',[shu_controller::class, 'store'])->name('tambah')->Middleware('auth');
    Route::post('/edit-shu',[shu_controller::class, 'update'])->name('edit')->Middleware('auth');
    Route::post('/shu/{id}',[shu_controller::class, 'destroy'])->name('hapus')->Middleware('auth');
    Route::get('/shu-penerima/{id}',[shu_controller::class, 'penerima'])->name('penerima')->Middleware('auth');
    Route::post('/shu-bagi/{shu_id}',[shu_controller::class, 'bagi'])->name('bagi')->Middleware('auth');
    Route::get('/pengaturan-shu-bagi',[shu_controller::class, 'pengaturan'])->name('pengaturan')->Middleware('auth');
    Route::post('/pengaturan-shu-bagi',[shu_controller::class, 'logicPengaturan'])->name('pengaturan')->Middleware('auth');
});

Route::name('pinjaman.')->group(function () {
    Route::get('/pinjaman',[pinjaman_controller::class, 'index'])->name('index')->Middleware('auth');
    Route::get('/pinjaman/print/{id_pinjaman}/{id_angsuran}',[pinjaman_controller::class, 'printKwitansi'])->name('print')->Middleware('auth');
    Route::get('/pinjaman/detail/{id_pinjaman}',[pinjaman_controller::class, 'detail'])->name('detail')->Middleware('auth');
    Route::get('/pinjaman/detail/{pinjaman_id}/{angsuran_id}',[pinjaman_controller::class, 'kwitansi'])->name('detail')->Middleware('auth');
    Route::get('/bunga-pinjaman',[pinjaman_controller::class, 'bunga'])->name('bunga')->Middleware('auth');
    Route::post('/bunga-pinjaman/edit/{bunga_id}',[pinjaman_controller::class, 'editBunga'])->name('bunga')->Middleware('auth');
    Route::post('/bunga-pinjaman',[pinjaman_controller::class, 'createBunga'])->name('bunga')->Middleware('auth');
    Route::get('/ajuakan-pinjaman',[pinjaman_controller::class, 'pengajuan'])->name('pengajuan')->Middleware('auth');
    Route::post('/ajuakan-pinjaman',[pinjaman_controller::class, 'logicPengajuan'])->name('pengajuan.logic')->Middleware('auth');
    Route::get('/validasi-pinjaman',[pinjaman_controller::class, 'validasi'])->name('validasi')->Middleware('auth');
    Route::post('/validasi-pinjaman/{id}',[pinjaman_controller::class, 'logicvalidasi'])->name('logic.validasi')->Middleware('auth');
    Route::get('/bayar-pinjaman',[pinjaman_controller::class, 'bayar'])->name('bayar')->Middleware('auth');
    Route::post('/bayar-pinjaman',[pinjaman_controller::class, 'logicbayar'])->name('logic.bayar')->Middleware('auth');
    Route::get('/lama-pinjaman',[pinjaman_controller::class, 'lamaPinjaman'])->name('lama')->Middleware('auth');
    Route::post('/lama-pinjaman',[pinjaman_controller::class, 'logicLamaPinjaman'])->name('logic.lama')->Middleware('auth');
    Route::post('/validasi-pinjaman/tolak/{id}',[pinjaman_controller::class, 'tolak'])->name('logic.tolak')->Middleware('auth');
    Route::post('/validasi-pinjaman/selesai/{id}',[pinjaman_controller::class, 'selesai'])->name('logic.selesai')->Middleware('auth');
    //pencairan
    Route::get('/pencairan-pinjaman',[pencairan_controller::class, 'index'])->name('pencairan')->Middleware('auth');

});


Route::name('simpanan.')->group(function () {
    Route::get('/simpanan',[simpanan_controller::class, 'index'])->name('index')->Middleware('auth');
    //simpanan pokok
    Route::get('/simpanan-pokok',[simpanan_controller::class, 'pokokIndex'])->name('pokok.index')->Middleware('auth');
    Route::post('/simpanan-pokok',[simpanan_controller::class, 'pokokStore'])->name('pokok.store')->Middleware('auth');
    //simpanan wajib
    Route::get('/simpanan-wajib',[simpanan_controller::class, 'wajibIndex'])->name('wajib.index')->Middleware('auth');
    Route::post('/simpanan-wajib',[simpanan_controller::class, 'wajibStore'])->name('wajib.store')->Middleware('auth');
    Route::get('/simpanan-wajib/detail/{user_id}',[simpanan_controller::class, 'pokokDetail'])->name('pokok.detail')->Middleware('auth');
    //simpanan sukarela
    Route::get('/simpanan-sukarela',[simpanan_controller::class, 'sukarelaIndex'])->name('sukarela.index')->Middleware('auth');
    Route::post('/simpanan-sukarela',[simpanan_controller::class, 'sukarelaStore'])->name('sukarela.store')->Middleware('auth');
});
Route::name('anggota.')->group(function () {
    Route::get('/anggota',[anggota_controller::class, 'daftar'])->name('daftar')->Middleware('auth');
    Route::get('/anggota/password-change',[anggota_controller::class, 'updatepassword'])->name('gantipassword')->Middleware('auth');
    Route::post('/anggota/password-change',[anggota_controller::class, 'logicupdatepassword'])->name('logicgantipassword')->Middleware('auth');
    Route::post('/anggota',[anggota_controller::class, 'create'])->name('tambah')->Middleware('auth');
    Route::get('/anggota/{id}',[anggota_controller::class, 'show'])->name('show')->Middleware('auth');
    Route::post('/anggota/update',[anggota_controller::class, 'update'])->name('update')->Middleware('auth');
    Route::post('/keluar',[anggota_controller::class, 'keluar'])->name('keluar')->Middleware('auth');
});
Route::name('ajax.')->group(function () {
    Route::get('/ajax/simpanan-wajib/{parameter}',[anggota_controller::class, 'ajaxSimpananWajib'])->name('simpanan.wajib')->Middleware('auth');
    Route::get('/ajax/simpanan-sukarela/{parameter}',[anggota_controller::class, 'ajaxSimpananSukarela'])->name('simpanan.wajib')->Middleware('auth');
    Route::get('/ajax/anggota/{filter}',[anggota_controller::class, 'ajaxAnggota'])->name('anggota')->Middleware('auth');
    Route::get('/ajax/anggota-kosong',[anggota_controller::class, 'ajaxAnggotaKosong'])->name('anggota.kosong')->Middleware('auth');
    Route::get('/ajax/pengajuan/{nominal}/{bulan}/{peminjam}/{tanggal}/{bunga}',[pinjaman_controller::class, 'ajax'])->Middleware('auth');
    Route::get('/ajax/angsuran/{id_angsuran}',[pinjaman_controller::class, 'pembayaran'])->name('pembayaran')->Middleware('auth');
    Route::get('/ajax/validasi/{str}',[pinjaman_controller::class, 'ajaxValidasi'])->name('validasi')->Middleware('auth');
    Route::get('/ajax/simpanan/{jenis_simpanan}/{user_id}',[simpanan_controller::class, 'ajaxSimpanan'])->name('simpanan')->Middleware('auth');
});

//data
Route::get('/print/{pinjaman_id}',[pinjaman_controller::class, 'print'])->name('print')->Middleware('auth');
Route::post('/download/simpanan',[laporan_controller::class, 'downloadSimpanan'])->name('downloadSimpanan')->Middleware('auth');
Route::post('/download/angsuran',[laporan_controller::class, 'downloadAngsuran'])->name('downloadAngsuran')->Middleware('auth');
Route::post('/download/anggota',[laporan_controller::class, 'downloadAnggota'])->name('downloadAnggota')->Middleware('auth');
Route::get('/print-simpanan',[laporan_controller::class, 'printSimpanan'])->name('downloadAnggota')->Middleware('auth');
Route::get('/print-angsuran',[laporan_controller::class, 'printAngsuran'])->name('downloadAnggota')->Middleware('auth');
Route::get('/print-anggota',[laporan_controller::class, 'printAnggota'])->name('downloadAnggota')->Middleware('auth');
Route::get('/print-penerima-shu/{id}',[shu_controller::class, 'printPenerimaShu'])->name('downloadAnggota')->Middleware('auth');



Route::name('laporan.')->group(function () {
    Route::get('/laporan/simpanan-pokok',[laporan_controller::class, 'simpananPokok'])->name('simpanan')->Middleware('auth');
    Route::get('/laporan/simpanan-wajib',[laporan_controller::class, 'simpananWajib'])->name('simpananWajib')->Middleware('auth');
    Route::get('/laporan/simpanan-sukarela',[laporan_controller::class, 'simpananSukarela'])->name('simpananSukarela')->Middleware('auth');
    Route::get('/laporan/angsuran',[laporan_controller::class, 'angsuran'])->name('angsuran')->Middleware('auth');
    Route::get('/laporan/anggota',[laporan_controller::class, 'anggota'])->name('anggota')->Middleware('auth');
});

Route::name('profile.')->group(function () {
    Route::resource('/profile', profile_controller::class);
});





