<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $table = 'tb_gambar';

    protected $fillable = [
        'id_konten',
        'nama_gambar',
        'link_gambar',
        'keterangan'
    ];
    
    public function konten(){
        return $this->belongsTo(Konten::class, 'id_konten', 'id');
    }
}
