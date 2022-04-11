<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Konten;
use App\Models\Gambar;

class ContentController extends Controller
{
    public function index(){
        $data_konten = Konten::all();
        $data_gambar = Gambar::latest()->get();
        return view('landing.content', ['data_konten' => $data_konten, 'data_gambar' => $data_gambar]);
        // return $data_gambar;
    }
}
