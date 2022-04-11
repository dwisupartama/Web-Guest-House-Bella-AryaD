<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'tb_kamar';

    protected $fillable = [
        'gambar_kamar',
        'no_kamar',
        'id_tipe_kamar',
        'harga_kamar',
        'gambar_kamar',
        'deskripsi_singkat',
        'deskripsi_kamar',
    ];

    public function tipeKamar(){
        return $this->belongsTo(TipeKamar::class, 'id_tipe_kamar', 'id');
    }
}
