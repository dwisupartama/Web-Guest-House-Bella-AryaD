<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCartAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cart_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_kamar');
            $table->integer('jumlah_dewasa');
            $table->integer('jumlah_anak');

            $table->foreign('id_admin')->references('id')->on('tb_admin');
            $table->foreign('id_kamar')->references('id')->on('tb_kamar');

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
        Schema::dropIfExists('tb_cart_admin');
    }
}
