<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailReservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_reservasi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_reservasi');
            $table->unsignedBigInteger('id_kamar');

            $table->integer('jumlah_dewasa');
            $table->integer('jumlah_anak');
            $table->dateTime('datetime_check_in')->nullable();

            $table->unsignedBigInteger('admin_check_in')->nullable();

            $table->dateTime('datetime_check_out')->nullable();

            $table->unsignedBigInteger('admin_check_out')->nullable();
            
            $table->bigInteger('harga_kamar');
            $table->bigInteger('total_harga_kamar');
            $table->enum('status_reservasi_kamar', ['Belum Siap di Check-in','Siap di Check-in', 'Sudah Check-in', 'Sudah Check-out', 'Dibatalkan']);

            $table->foreign('id_reservasi')->references('id')->on('tb_reservasi');
            $table->foreign('id_kamar')->references('id')->on('tb_kamar');
            $table->foreign('admin_check_in')->references('id')->on('tb_admin');
            $table->foreign('admin_check_out')->references('id')->on('tb_admin');
            
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
        Schema::dropIfExists('tb_detail_reservasi');
    }
}
