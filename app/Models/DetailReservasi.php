<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservasi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_reservasi';

    protected $fillable = [
        'id_reservasi',
        'id_kamar',
        'jumlah_dewasa',
        'jumlah_anak',
        'datetime_check_in',
        'admin_check_in',
        'datetime_check_out',
        'admin_check_out',
        'harga_kamar',
        'total_harga_kamar',
        'status_reservasi_kamar',
    ];

    public function reservasi(){
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id');
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id');
    }

    public function adminCheckIn(){
        return $this->belongsTo(Admin::class, 'admin_check_in', 'id');
    }

    public function adminCheckOut(){
        return $this->belongsTo(Admin::class, 'admin_check_out', 'id');
    }
}
