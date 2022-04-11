<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'tb_cart';

    protected $fillable = [
        'id_user',
        'id_kamar',
        'jumlah_dewasa',
        'jumlah_anak',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id');
    }
}
