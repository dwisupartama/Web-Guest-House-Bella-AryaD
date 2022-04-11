<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table = 'tb_reservasi';

    protected $fillable = [
        'id_user',
        'no_reservasi',
        'nama_user',
        'email_user',
        'asal_negara_user',
        'no_telp_user',
        'tgl_pemesanan',
        'tgl_book_check_in',
        'durasi_reservasi',
        'tgl_book_check_out',
        'total_pembayaran',
        'status_reservasi',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
