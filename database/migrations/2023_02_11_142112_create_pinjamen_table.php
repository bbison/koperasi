<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullabe();
            $table->foreignId('catatan_keuangan_id')->default('0')->nullabe();
            $table->foreignId('jenis_pinjaman_id')->nullabe();
            $table->foreignId('bunga_pinjaman_id')->nullabe();
            $table->string('total_angsuran')->nullabe();
            $table->string('kode')->nullabe();
            $table->string('lama_pinjaman')->default('0');
            $table->string('angsuran_pokok')->default('0');
            $table->string('angsuran_bunga')->default('0');
            $table->string('angsuran_terbayar')->default('0');
            $table->string('angsuran_belum_terbayar')->nullabe();
            $table->string('status_pinjaman')->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjamen');
    }
};
