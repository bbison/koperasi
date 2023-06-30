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
        Schema::create('catatan_keuangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('nominal')->nullable();
            $table->text('saldo_debit')->nullable();
            $table->text('saldo_kredit')->nullable();
            $table->text('saldo')->nullable();
            $table->text('jenis_transaksi')->nullable();
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
        Schema::dropIfExists('catatan_keuangans');
    }
};
