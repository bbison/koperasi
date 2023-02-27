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
            $table->foreignId('user_id');
            $table->foreignId('bunga_pinjaman_id');
            $table->string('total_angsuran');
            $table->string('lama_pinjaman');
            $table->string('angsuran_pokok');
            $table->string('angsuran_bunga');
            $table->string('angsuran_terbayar')->default('0');
            $table->string('angsuran_belum_terbayar');
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
