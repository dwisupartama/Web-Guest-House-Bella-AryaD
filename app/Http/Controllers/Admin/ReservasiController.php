<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Reservasi;
use App\Models\DetailReservasi;
use App\Models\CartAdmin;
use App\Models\TipeKamar;
use App\Models\Kamar;
use App\Models\User;

class ReservasiController extends Controller
{
    public function index(){
        $data_reservasi = Reservasi::latest()->get();
        return view('admin.data-reservasi.index', ['data_reservasi' =>  $data_reservasi]); 
    }

    public function create(){
        $data_cart_admin = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->latest()->get();
        $data_tipe_kamar = TipeKamar::latest()->get();
        return view('admin.data-reservasi.tambah', ['data_cart_admin' => $data_cart_admin, 'data_tipe_kamar' => $data_tipe_kamar]);
    }

    public function search(Request $request){
        $data_tipe_kamar = TipeKamar::latest()->get();
        $data_cart_admin = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->latest()->get();

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

        $data_kamar = Kamar::where('id_tipe_kamar', $request->room_type)->latest()->get();
        $index = 0;

        foreach($data_kamar as $kamar){
            foreach($data_kamar_dipesan as $kamar_dipesan){
                if($kamar->id == $kamar_dipesan->id){
                    unset($data_kamar[$index]);
                }
            }
            $index++;
        }

        return view('admin.data-reservasi.tambah', ['data_cart_admin' => $data_cart_admin, 'data_tipe_kamar' => $data_tipe_kamar, 'data_kamar' => $data_kamar, 'request' => $request]);
    }

    public function formAddCart($id){
        return view('admin.data-reservasi.form-add-cart', ['id' => $id]);
    }

    public function storeCart(Request $request){
        $add_cart = CartAdmin::create([
            'id_admin' => auth()->guard('admin')->user()->id,
            'id_kamar' => $request->id_kamar,
            'jumlah_dewasa' => $request->jumlah_dewasa,
            'jumlah_anak' => $request->jumlah_anak,
        ]);

        if($add_cart){
            return redirect()->back()->with('success', 'Kamar berhasil ditambahkan ke cart');
        }
    }

    public function cartAdminDelete($id){
        $delete_cart = CartAdmin::find($id)->delete();

        if($delete_cart){
            return redirect()->back()->with('success', 'Kamar berhasil dihapus dari cart.');
        }
    }

    public function pilihUser(){
        $data_cart = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->count();

        if($data_cart < 1){
            return redirect()->route('admin.data-reservasi.create')->with('error', 'Tidak bisa masuk ke halaman ini jika cart masih kosong');
        }else{
            $data_user = User::latest()->get();
            return view('admin.data-reservasi.pilih-user', ['data_user' => $data_user]);
        }
    }

    public function formReservasiAdmin($id){
        $data_user = User::find($id);
        $data_cart = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->latest()->get();

        return view('admin.data-reservasi.form-reservasi-admin', [
            'data_user' => $data_user,
            'data_cart' => $data_cart
        ]);
        // return $data_user;
    }

    public function buatReservasi(Request $request){
        $data_cart = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->get();

        if($data_cart->count() > 0){
            $message = "Room by Number : <br>(Not available on that date)<br>";
            $ready = true;
            $total_pembayaran = 0;
    
            foreach($data_cart as $cart){
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
                    ->where('tb_kamar.id', $cart->id_kamar)
                    ->get();
    
                if($data_kamar_dipesan->count() > 0){
                    $ready = false;
                    $message .= "- <b>".$cart->kamar->tipeKamar->tipe_kamar." Room No. ".$cart->kamar->no_kamar."</b><br>";
                }
    
                $total_harga = $cart->kamar->harga_kamar * $request->duration;
                $total_pembayaran += $total_harga;
            }
    
            if($ready){
                $validate = $request->validate([
                    'check_in_date' => ['required','date_format:Y-m-d','after:today'],
                    'duration' => ['required','numeric','gt:0','lte:30'],
                    'check_out_date' => ['required','date_format:Y-m-d','after:tomorrow'],
                    'nama_user' => ['required', 'string', 'max:255'],
                    'email_user' => ['required', 'string', 'email', 'max:255'],
                    'asal_negara_user' => ['required', 'string', 'min:2', 'max: 255'],
                    'no_telp_user' => ['required', 'string', 'max: 15'],
                ]);
    
                if($validate){
                    function add_digit_date($number){
                        if(strlen((string) $number) < 2){
                            $result = "0".$number;
                        }else{
                            $result = "".$number;
                        }

                        return $result;
                    }
                    $keyword_reservasi = "PNGH";

                    $date_now = Carbon::now();
                    $date_to_no_reservasi = $date_now->year.add_digit_date($date_now->month).add_digit_date($date_now->day);

                    $statement = DB::select("SHOW TABLE STATUS LIKE 'tb_reservasi'");
                    $id_data = $statement[0]->Auto_increment;

                    $length_id = strlen((string) $id_data);
                    $add_zero_count = 6 - $length_id;

                    $zero = "";
                    for($i = 0; $i < $add_zero_count; $i++){
                        $zero .= "0";
                    }

                    $tambah_reservasi = Reservasi::create([
                        'no_reservasi' => $keyword_reservasi.$date_to_no_reservasi.$zero.$id_data,
                        'id_user' => $request->id_user,
                        'nama_user' => $request->nama_user,
                        'email_user' => $request->email_user,
                        'asal_negara_user' => $request->asal_negara_user,
                        'no_telp_user' => $request->no_telp_user,
                        'tgl_pemesanan' => $date_now->toDateTimeString(),
                        'tgl_book_check_in' => $request->check_in_date,
                        'durasi_reservasi'=> $request->duration,
                        'tgl_book_check_out' => $request->check_out_date,
                        'total_pembayaran' => $total_pembayaran,
                        'status_reservasi' => "Menunggu Pembayaran",
                    ]);
    
                    $id_reservasi = $tambah_reservasi->id;
                    $status_add_cart = false;
    
                    foreach($data_cart as $cart){
                        $tambah_detail_reservasi = DetailReservasi::create([
                            'id_reservasi' => $id_reservasi,
                            'id_kamar' => $cart->id_kamar,
                            'jumlah_dewasa' => $cart->jumlah_dewasa,
                            'jumlah_anak' => $cart->jumlah_anak,
                            'harga_kamar' => $cart->kamar->harga_kamar,
                            'total_harga_kamar' => $cart->kamar->harga_kamar * $request->duration,
                            'status_reservasi_kamar' => "Menunggu Pembayaran",
                        ]);
    
                        if($tambah_detail_reservasi){
                            $status_add_cart = true;
                        }else{
                            $status_add_cart = false;
                        }
                    }
    
                    if($tambah_reservasi && $status_add_cart){
                        $delete_cart_user = CartAdmin::where('id_admin', auth()->guard('admin')->user()->id)->delete();
                        if($delete_cart_user){
                            return redirect()->route('admin.data-reservasi.index')->with('success', 'Reservasi berhasil dibuat');
                        }
                    }
                }
            }else{
                return redirect()->route('admin.data-reservasi.formReservasiAdmin', [$request->id_user])->with('error', $message);
            }
        }else{
            return redirect()->route('admin.data-reservasi.formReservasiAdmin', [$request->id_user])->with('error', "Belum ada kamar yang ditambahkan ke cart");
        }
    }

    public function proses($id){
        $data_reservasi = Reservasi::find($id);
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        return view('admin.data-reservasi.proses', [
            'data_reservasi' => $data_reservasi,
            'data_detail_reservasi' => $data_detail_reservasi
        ]);
    }

    public function batal($id){
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        $success_detail = true;

        foreach($data_detail_reservasi as $detail_reservasi){
            $update = DetailReservasi::find($detail_reservasi->id);
            $update->status_reservasi_kamar = "Dibatalkan";
            $update->save();

            if(!$update){
                $success_detail = false;
            }
        }

        if($success_detail == true){
            $data_reservasi = Reservasi::find($id);
            $data_reservasi->status_reservasi = "Dibatalkan";
            $data_reservasi->save();

            if($data_reservasi){
                return redirect()->back();
            }
        }
    }

    public function telahDibayarkan($id){
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        $success_detail = true;

        foreach($data_detail_reservasi as $detail_reservasi){
            $update = DetailReservasi::find($detail_reservasi->id);
            $update->status_reservasi_kamar = "Siap di Check-in";
            $update->save();

            if(!$update){
                $success_detail = false;
            }
        }

        if($success_detail == true){
            $data_reservasi = Reservasi::find($id);
            $data_reservasi->status_reservasi = "Siap di Check-in";
            $data_reservasi->save();

            if($data_reservasi){
                return redirect()->back();
            }
        }
    }

    public function tolakPembayaran($id){
        $data_reservasi = Reservasi::find($id);
        $data_reservasi->status_reservasi = "Pembayaran di Tolak";
        $data_reservasi->save();

        if($data_reservasi){
            return redirect()->back();
        }
    }

    public function batalPembayaran($id){
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        $success_detail = true;

        foreach($data_detail_reservasi as $detail_reservasi){
            $update = DetailReservasi::find($detail_reservasi->id);
            $update->status_reservasi_kamar = "Menunggu Pembayaran";
            $update->save();

            if(!$update){
                $success_detail = false;
            }
        }

        if($success_detail == true){
            $data_reservasi = Reservasi::find($id);
            $data_reservasi->status_reservasi = "Menunggu Pembayaran";
            $data_reservasi->save();

            if($data_reservasi){
                return redirect()->back();
            }
        }
    }

    public function checkInAll($id){
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        $success_detail = true;

        foreach($data_detail_reservasi as $detail_reservasi){
            $update = DetailReservasi::find($detail_reservasi->id);
            $update->status_reservasi_kamar = "Sudah Check-in";
            $update->datetime_check_in = Carbon::now();
            $update->admin_check_in = auth()->guard('admin')->user()->id;
            $update->save();

            if(!$update){
                $success_detail = false;
            }
        }

        if($success_detail == true){
            $data_reservasi = Reservasi::find($id);
            $data_reservasi->status_reservasi = "Sudah Check-in";

            $data_reservasi->save();

            if($data_reservasi){
                return redirect()->back();
            }
        }
    }

    public function checkOutAll($id){
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->get();

        $success_detail = true;

        foreach($data_detail_reservasi as $detail_reservasi){
            $update = DetailReservasi::find($detail_reservasi->id);
            $update->status_reservasi_kamar = "Sudah Check-out";
            $update->datetime_check_out = Carbon::now();
            $update->admin_check_out = auth()->guard('admin')->user()->id;
            $update->save();

            if(!$update){
                $success_detail = false;
            }
        }

        if($success_detail == true){
            $data_reservasi = Reservasi::find($id);
            $data_reservasi->status_reservasi = "Sudah Check-out";

            $data_reservasi->save();

            if($data_reservasi){
                return redirect()->back();
            }
        }
    }

    public function checkInRoom($id_reservasi, $id_kamar){
        $update = DetailReservasi::find($id_kamar);
        $update->status_reservasi_kamar = "Sudah Check-in";
        $update->datetime_check_in = Carbon::now();
        $update->admin_check_in = auth()->guard('admin')->user()->id;
        $update->save();

        if($update){
            $all_detail = DetailReservasi::where('id_reservasi', $id_reservasi)->get();

            $update_reservasi = true;

            foreach($all_detail as $detail){
                if($detail->datetime_check_in == null){
                    $update_reservasi = false;
                }
            }

            if($update_reservasi){
                $data_reservasi = Reservasi::find($id_reservasi);
                $data_reservasi->status_reservasi = "Sudah Check-in";
    
                $data_reservasi->save();
            }

            return redirect()->back();
        }
    }

    public function checkOutRoom($id_reservasi, $id_kamar){
        $update = DetailReservasi::find($id_kamar);
        $update->status_reservasi_kamar = "Sudah Check-out";
        $update->datetime_check_out = Carbon::now();
        $update->admin_check_out = auth()->guard('admin')->user()->id;
        $update->save();

        if($update){
            $all_detail = DetailReservasi::where('id_reservasi', $id_reservasi)->get();

            $update_reservasi = true;

            foreach($all_detail as $detail){
                if($detail->datetime_check_out == null){
                    $update_reservasi = false;
                }
            }

            if($update_reservasi){
                $data_reservasi = Reservasi::find($id_reservasi);
                $data_reservasi->status_reservasi = "Sudah Check-out";
    
                $data_reservasi->save();
            }

            return redirect()->back();
        }
    }
}
