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
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id');
            $table->foreignId('user_id');
            $table->text('bunga_angsuran');
            $table->text('pembulatan')->nullable();
            $table->integer('tagihan_angsuran')->nullable();
            $table->text('bulan_angsuran')->nullable();
            $table->text('status')->default('Belum Bayar');
            $table->text('bagi_shu')->default('Belum Dibagi');
            $table->date('jatuh_tempo')->nullable();
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
        Schema::dropIfExists('angsurans');
    }
};
