<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kamar', function (Blueprint $table) {
            $table->id();
            
            $table->string('gambar_kamar')->nullable();
            $table->string('no_kamar',10);
            $table->unsignedBigInteger('id_tipe_kamar');
            $table->bigInteger('harga_kamar');
            $table->string('deskripsi_singkat', 100);
            $table->text('deskripsi_kamar');

            $table->foreign('id_tipe_kamar')->references('id')->on('tb_tipe_kamar');

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
        Schema::dropIfExists('tb_kamar');
    }
}
