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
use App\Http\Controllers\print_controller;
use App\Http\Controllers\download_controller;

Route::get('/',[main_controller::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[main_controller::class, 'login'])->name('logiclogin')->middleware('guest');
Route::get('/dashboard',[main_controller::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout',[main_controller::class, 'logout'])->name('logout')->Middleware('auth');
Route::post('/import-anggota',[main_controller::class, 'prosesImportAnggota'])->name('proses,import.anggota')->Middleware('auth');
Route::post('/import-pinjaman',[main_controller::class, 'prosesImportPinjaman'])->name('proses.import.pinjaman')->Middleware('auth');

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
    Route::get('/penyesuaian-pinjaman',[pinjaman_controller::class, 'penyesuaian'])->name('penyesuaian')->Middleware('auth');
    Route::get('/pinjaman/print/{id_pinjaman}/{id_angsuran}',[pinjaman_controller::class, 'printKwitansi'])->name('print')->Middleware('auth');
    Route::get('/pinjaman/detail/{id_pinjaman}',[pinjaman_controller::class, 'detail'])->name('detail')->Middleware('auth');
    Route::get('/pinjaman/detail/{pinjaman_id}/{angsuran_id}',[pinjaman_controller::class, 'kwitansi'])->name('detail')->Middleware('auth');
    Route::get('/bunga-pinjaman',[pinjaman_controller::class, 'bunga'])->name('bunga')->Middleware('auth');
    Route::post('/bunga-pinjaman/edit/{bunga_id}',[pinjaman_controller::class, 'editBunga'])->name('bunga')->Middleware('auth');
    Route::post('/bunga-pinjaman',[pinjaman_controller::class, 'createBunga'])->name('bunga')->Middleware('auth');
    Route::get('/ajuakan-pinjaman',[pinjaman_controller::class, 'pengajuan'])->name('pengajuan')->Middleware('auth');
    Route::post('/ajuakan-pinjaman',[pinjaman_controller::class, 'logicPengajuan'])->name('pengajuan.logic')->Middleware('auth');
    Route::post('/ajuakan-pinjaman-penyesuaian',[pinjaman_controller::class, 'logicPengajuanPenyesuaian'])->name('pengajuanpenyesuaian.logic')->Middleware('auth');
    Route::get('/validasi-pinjaman',[pinjaman_controller::class, 'validasi'])->name('validasi')->Middleware('auth');
    Route::post('/validasi-pinjaman/{id}',[pinjaman_controller::class, 'logicvalidasi'])->name('logic.validasi')->Middleware('auth');
    Route::get('/bayar-pinjaman-baru',[pinjaman_controller::class, 'bayar'])->name('bayarbaru')->Middleware('auth');
    Route::post('/bayar-pinjaman-baru',[pinjaman_controller::class, 'logicbayar'])->name('logic.bayar')->Middleware('auth');
    Route::get('/lama-pinjaman',[pinjaman_controller::class, 'lamaPinjaman'])->name('lama')->Middleware('auth');
    Route::post('/lama-pinjaman',[pinjaman_controller::class, 'logicLamaPinjaman'])->name('logic.lama')->Middleware('auth');
    Route::post('/validasi-pinjaman/tolak/{id}',[pinjaman_controller::class, 'tolak'])->name('logic.tolak')->Middleware('auth');
    Route::post('/validasi-pinjaman/selesai/{id}',[pinjaman_controller::class, 'selesai'])->name('logic.selesai')->Middleware('auth');
    //pencairan
    Route::get('/pencairan-pinjaman',[pencairan_controller::class, 'index'])->name('pencairan')->Middleware('auth');
    Route::get('/jenis-pinjaman',[pinjaman_controller::class, 'jenispinjaman'])->name('jenispinjaman')->Middleware('auth');
    Route::post('/jenis-pinjaman',[pinjaman_controller::class, 'tambahjenispinjaman'])->name('jenispinjaman')->Middleware('auth');
    Route::post('/edit-jenis-pinjaman',[pinjaman_controller::class, 'editjenispinjaman'])->name('editjenispinjaman')->Middleware('auth');
  

    //pinjaman ke 2
    Route::get('/bayar-pinjaman',[pinjaman_controller::class, 'bayarpinjaman'])->name('bayarpinjaman')->Middleware('auth');
    Route::post('/bayar-pinjaman',[pinjaman_controller::class, 'prosesbayarpinjaman'])->name('bayar')->Middleware('auth');
});


Route::name('simpanan.')->group(function () {
    Route::get('/simpanan',[simpanan_controller::class, 'index'])->name('index')->Middleware('auth');
    Route::get('/simpananWajibStaff',[simpanan_controller::class, 'simpananWajibStaff'])->name('WajibStaff')->Middleware('auth');
    Route::get('/simpananWajibProduksi',[simpanan_controller::class, 'simpananWajibProduksi'])->name('WajibProduksi')->Middleware('auth');
    Route::get('/simpananSukarelaStaff',[simpanan_controller::class, 'simpananSukarelaStaff'])->name('SukarelaStaff')->Middleware('auth');
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
    Route::get('/ajax/pengajuan-penyesuaian/{nominal}/{bulan}/{peminjam}/{tanggal}/{bunga}/{sudahbayar}',[pinjaman_controller::class, 'ajaxpenyesuaian'])->Middleware('auth');
    Route::get('/ajax/angsuran/{id_angsuran}',[pinjaman_controller::class, 'pembayaran'])->name('pembayaran')->Middleware('auth');
    Route::get('/ajax/validasi/{str}',[pinjaman_controller::class, 'ajaxValidasi'])->name('validasi')->Middleware('auth');
    Route::get('/ajax/simpanan/{jenis_simpanan}/{user_id}',[simpanan_controller::class, 'ajaxSimpanan'])->name('simpanan')->Middleware('auth');
    Route::get('/ajax-bayar/{id}',[pinjaman_controller::class, 'ajaxbayar'])->Middleware('auth');
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
Route::post('/saldo-awal',[main_controller::class, 'masukansaldoawal'])->name('masukansaldoawal')->Middleware('auth');
Route::get('/importPinjaman',[main_controller::class, 'importPinjaman'])->name('importPinjaman')->Middleware('auth');



Route::name('laporan.')->group(function () {
    Route::get('/laporan/simpanan-pokok',[laporan_controller::class, 'simpananPokok'])->name('simpanan')->Middleware('auth');
    Route::get('/laporan/simpanan-wajib',[laporan_controller::class, 'simpananWajib'])->name('simpananWajib')->Middleware('auth');
    Route::get('/laporan/simpanan-sukarela',[laporan_controller::class, 'simpananSukarela'])->name('simpananSukarela')->Middleware('auth');
    Route::get('/laporan/angsuran',[laporan_controller::class, 'angsuran'])->name('angsuran')->Middleware('auth');
    Route::get('/laporan/anggota',[laporan_controller::class, 'anggota'])->name('anggota')->Middleware('auth');
    Route::get('/laporan/neraca',[laporan_controller::class, 'neracaAwalTahun'])->name('neracaAwalTahun')->Middleware('auth');
   

      //laporan pinjaman
    Route::get('/pinjamanProduksi',[laporan_controller::class, 'pinjamanProduksi'])->name('pinjamanProduksi')->Middleware('auth');
    Route::get('/pinjamanStaff',[laporan_controller::class, 'pinjamanStaff'])->name('pinjamanStaff')->Middleware('auth');
    Route::get('/pinjamanLainya',[laporan_controller::class, 'pinjamanLainya'])->name('pinjamanLainya')->Middleware('auth');
    Route::get('/hutangLainya',[laporan_controller::class, 'hutangLainya'])->name('hutangLainya')->Middleware('auth');


    // keuangan
    Route::get('/buku-besar',[laporan_controller::class, 'keuangan'])->name('journal')->Middleware('auth');
    Route::get('/journal',[laporan_controller::class, 'jurnal'])->name('jurnal')->Middleware('auth');
    Route::post('/journal',[laporan_controller::class, 'tambahjurnal'])->name('tambahjurnal')->Middleware('auth');
});

Route::name('profile.')->group(function () {
    Route::resource('/profile', profile_controller::class);
    Route::get('/saldo-awal',[laporan_controller::class, 'saldoAwal'])->name('saldoAwal')->Middleware('auth');
    Route::get('/import-anggota',[laporan_controller::class, 'ImportAnggota'])->name('ImportAnggota')->Middleware('auth');
    Route::get('/import-pinjaman',[laporan_controller::class, 'ImportPinjaman'])->name('ImportPinjaman')->Middleware('auth');
    Route::get('/journal-penyesuaian',[laporan_controller::class, 'JournalPenyesuaian'])->name('journalPenyesuaian')->Middleware('auth');
    Route::post('/journal-penyesuaian',[laporan_controller::class, 'tambahJournalPenyesuaian'])->name('journalPenyesuaian')->Middleware('auth');
    Route::get('/akun',[laporan_controller::class, 'akun'])->name('akun')->Middleware('auth');
    Route::get('/laba-ditahan',[laporan_controller::class, 'labaditahan'])->name('labaditahan')->Middleware('auth');
    Route::get('/penyesuaian-shu-yang-harus-dibagi',[laporan_controller::class, 'penyesuaianshu'])->name('penyesuaianshu')->Middleware('auth');
    Route::post('/penyesuaian-shu-yang-harus-dibagi',[laporan_controller::class, 'penyesuaianshuyangdibagi'])->name('penyesuaianshu')->Middleware('auth');
    Route::post('/laba-ditahan',[laporan_controller::class, 'penyesuaianlabaditahan'])->name('penyesuaianlabaditahan')->Middleware('auth');
    Route::post('/akun',[laporan_controller::class, 'tambahakun'])->name('akun')->Middleware('auth');
});
Route::name('pengaturan.')->group(function () {
    Route::get('/aturkode',[main_controller::class, 'kode'])->name('kode')->Middleware('auth');
    Route::post('/aturkode',[main_controller::class, 'tambahkode'])->name('tambahkode')->Middleware('auth');
});

Route::name('print.')->group(function () {
    Route::get('/pinjaman-staff-print',[print_controller::class,'pinjamanstaff'])->name('pinjamanstaff')->Middleware('auth');
 
});

Route::name('download.')->group(function () {
    Route::get('/pinjaman-staff-download',[download_controller::class,'pinjamanstaff'])->name('pinjamanstaff')->Middleware('auth');
    Route::get('/pinjaman-produksi-download',[download_controller::class,'pinjamanproduksi'])->name('pinjamanproduksi')->Middleware('auth');
    Route::get('/pinjaman-lainya-download',[download_controller::class,'pinjamanlainya'])->name('pinjamanlainya')->Middleware('auth');
    Route::get('/simpananWajibStaff-download',[download_controller::class,'simpananwajibstaff'])->name('pinjamanlainya')->Middleware('auth');
    Route::get('/simpananWajibProduksi-download',[download_controller::class,'simpananwajibproduksi'])->name('pinjamanlainya')->Middleware('auth');
    Route::get('/simpananSukarelaStaff-download',[download_controller::class,'simpanansukarelastaff'])->name('pinjamanlainya')->Middleware('auth');
    Route::get('/journal-download',[download_controller::class,'journal'])->name('jurnal')->Middleware('auth');
    Route::get('/laporan/neraca-download',[download_controller::class,'neraca'])->name('neraca')->Middleware('auth');
 
});






