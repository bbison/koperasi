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
        Schema::create('shus', function (Blueprint $table) {
            $table->id();
            $table->text('besar_shu_kotor')->nullable();
            $table->text('besar_shu_dibagi')->nullable();
            $table->text('besar_shu_bersih')->nullable();
            $table->text('biaya_operasional')->nullable();
            $table->text('presentase_pembagian')->nullable();
            $table->text('sisa_shu')->nullable();
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
        Schema::dropIfExists('shus');
    }
};
