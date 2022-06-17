<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\TipeKamar;
use App\Models\DetailReservasi;
use App\Models\Kamar;
use App\Models\Cart;
use App\Models\Reservasi;

class BookingController extends Controller
{
    public function index(){
        $data_tipe_kamar = TipeKamar::latest()->get();
        return view('landing.booking.index', ['data_tipe_kamar' => $data_tipe_kamar]);
    }

    public function detailKamarBooking($id){
        $kamar = Kamar::find($id);
        $data_tipe_kamar = TipeKamar::latest()->get();
        return view('landing.booking.room', ['kamar' => $kamar, 'data_tipe_kamar' => $data_tipe_kamar]);
    }

    public function cekCartBooking(){
        $id_user = auth()->guard('web')->user()->id;
        $count_cart = Cart::where('id_user', $id_user)->count();
        return $count_cart;
    }

    public function deleteAllCart(){
        $delete_cart_user = Cart::where('id_user', auth()->guard('web')->user()->id)->delete();
        if($delete_cart_user){
            return "Success";
        } else {
            return "Error";
        }
    }

    public function searchRoom(Request $request){
        $data_kamar_dipesan = DetailReservasi::select('tb_kamar.id')
            ->join('tb_reservasi','tb_detail_reservasi.id_reservasi','=','tb_reservasi.id')
            ->join('tb_kamar','tb_detail_reservasi.id_kamar','=','tb_kamar.id')
            ->join('tb_tipe_kamar','tb_kamar.id_tipe_kamar','=','tb_tipe_kamar.id')
            ->where(function ($query) use ($request){
                $query->where([['tb_reservasi.tgl_book_check_in', '>=', $request->check_in_date],['tb_reservasi.tgl_book_check_in', '<=', $request->check_out_date]])
                ->orWhere([['tb_reservasi.tgl_book_check_out', '>=', $request->check_in_date],['tb_reservasi.tgl_book_check_out', '<=', $request->check_out_date]])
                ->orWhereRaw('? >= tb_reservasi.tgl_book_check_in AND ? <= tb_reservasi.tgl_book_check_out', [$request->check_in_date, $request->check_in_date])
                ->orWhereRaw('? >= tb_reservasi.tgl_book_check_in AND ? <= tb_reservasi.tgl_book_check_out', [$request->check_out_date, $request->check_out_date]);
            })
            ->groupBy('tb_kamar.id')
            ->get();

        $data_kamar = Kamar::latest()->get();
        $index = 0;

        foreach($data_kamar as $kamar){
            foreach($data_kamar_dipesan as $kamar_dipesan){
                if($kamar->id == $kamar_dipesan->id){
                    unset($data_kamar[$index]);
                }
            }
            $index++;
        }

        return view('landing.booking.search', ['data_kamar' => $data_kamar]);
    }
}
