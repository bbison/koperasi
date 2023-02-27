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
        Schema::create('pembagian_shus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('shu_id');
            $table->text('nama');
            $table->text('presentase');
            $table->text('nominal');
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
        Schema::dropIfExists('pembagian_shus');
    }
};
