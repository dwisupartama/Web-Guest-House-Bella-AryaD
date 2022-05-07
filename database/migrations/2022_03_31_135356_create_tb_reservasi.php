<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbReservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('no_reservasi', 255)->unique();

            $table->unsignedBigInteger('id_user');

            $table->string('nama_user', 50);
            $table->string('email_user', 255);
            $table->string('asal_negara_user',50);
            $table->string('no_telp_user', 15);
            $table->dateTime('tgl_pemesanan');
            $table->date('tgl_book_check_in');
            $table->integer('durasi_reservasi');
            $table->date('tgl_book_check_out');
            $table->bigInteger('total_pembayaran');
            $table->string('bukti_pembayaran', 255)->nullable();
            $table->dateTime('tgl_pembayaran')->nullable();
            $table->dateTime('tgl_pembayaran_dikonfirmasi')->nullable();
            $table->enum('status_reservasi', ['Menunggu Pembayaran', 'Menunggu Konfirmasi', 'Pembayaran di Tolak', 'Siap di Check-in', 'Sudah Check-in', 'Sudah Check-out', 'Dibatalkan']);

            $table->foreign('id_user')->references('id')->on('users');

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
        Schema::dropIfExists('tb_reservasi');
    }
}
