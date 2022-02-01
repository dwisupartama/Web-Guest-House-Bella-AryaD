<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbGambar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_gambar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konten');
            $table->string('nama_gambar');
            $table->string('link_gambar')->nullable();
            $table->text('keterangan');

            $table->foreign('id_konten')->references('id')->on('tb_konten');
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
        Schema::dropIfExists('tb_gambar');
    }
}
