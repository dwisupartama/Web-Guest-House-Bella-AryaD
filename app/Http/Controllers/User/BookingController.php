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

    public function indexWithData(Request $request){
        $data_tipe_kamar = TipeKamar::latest()->get();

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
            ->where('tb_tipe_kamar.id', $request->room_type)
            ->groupBy('tb_kamar.id')
            ->get();

        $data_kamar = Kamar::where('id_tipe_kamar', $request->room_type)->get();
        $index = 0;

        foreach($data_kamar as $kamar){
            foreach($data_kamar_dipesan as $kamar_dipesan){
                if($kamar->id == $kamar_dipesan->id){
                    unset($data_kamar[$index]);
                }
            }
            $index++;
        }

        return view('landing.booking.index', ['data_tipe_kamar' => $data_tipe_kamar, 'data_kamar' => $data_kamar, 'request' => $request]);
        // return $data_kamar;
    }

    public function detailKamarBooking($id){
        $kamar = Kamar::find($id);
        $data_tipe_kamar = TipeKamar::latest()->get();
        return view('landing.booking.room', ['kamar' => $kamar, 'data_tipe_kamar' => $data_tipe_kamar]);
    }
}
