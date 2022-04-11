<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Reservasi;
use App\Models\Konten;
use App\Models\Gambar;

class HomeLandingController extends Controller
{
    public function homePage(){
        $data_konten = Konten::latest()->get();
        $data_gambar_konten = Gambar::all();
        return view('landing.index', [
           'data_konten'  => $data_konten,
           'data_gambar_konten' => $data_gambar_konten,
        ]);
    }

    public function contactusPage(){
        return view('landing.contactus');
    }

    public function jumlahCartUser($id){
        $jumlah_cart = Cart::where('id_user', $id)->count();
        return $jumlah_cart;
    }

    public function jumlahBookingUser($id){
        $jumlah_booking = Reservasi::where('id_user', $id)
         ->where(function ($query){
             $query->where('status_reservasi', 'Menunggu Pembayaran')
                ->orWhere('status_reservasi', 'Siap di Check-in')
                ->orWhere('status_reservasi', 'Sudah Check-in');
         })->count();
        return $jumlah_booking;
    }
}
