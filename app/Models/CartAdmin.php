<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartAdmin extends Model
{
    use HasFactory;
    protected $table = 'tb_cart_admin';

    protected $fillable = [
        'id_admin',
        'id_kamar',
        'jumlah_dewasa',
        'jumlah_anak',
    ];

    public function user(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id');
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id');
    }
}
