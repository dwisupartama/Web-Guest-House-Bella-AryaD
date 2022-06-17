<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateHelpers;

use App\Models\Cart;
use App\Models\DetailReservasi;
use App\Models\Reservasi;

class DataBookingController extends Controller
{
    public function processBooking(Request $request){
        $data_cart = Cart::where('id_user', auth()->guard('web')->user()->id)->get();

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
                        'id_user' => auth()->guard('web')->user()->id,
                        'nama_user' => auth()->guard('web')->user()->nama,
                        'email_user' => auth()->guard('web')->user()->email,
                        'asal_negara_user' => auth()->guard('web')->user()->asal_negara,
                        'no_telp_user' => auth()->guard('web')->user()->no_telp,
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
                            'status_reservasi_kamar' => "Belum Siap di Check-in",
                        ]);
    
                        if($tambah_detail_reservasi){
                            $status_add_cart = true;
                        }else{
                            $status_add_cart = false;
                        }
                    }
    
                    if($tambah_reservasi && $status_add_cart){
                        $delete_cart_user = Cart::where('id_user', auth()->guard('web')->user()->id)->delete();
                        if($delete_cart_user){
                            $tgl_pembayaran_terakhir = DateHelpers::formatDateInggrisWithTime($date_now->addDay()->toDateTimeString());
                            $path = public_path().'/json/rekening.json';
                            $json_rekening = json_decode(file_get_contents($path), true);
                            $jenis_bank = $json_rekening['rekening'][0]['jenis_bank'];
                            $no_rekening = $json_rekening['rekening'][0]['no_rekening'];
                            $atas_nama = $json_rekening['rekening'][0]['atas_nama'];
                            return redirect()->route('landing.user.bookingList')->with('successbook', 'Room successfully booked, please make payment before <br><b>'.$tgl_pembayaran_terakhir.'</b><br> to <b>'.$no_rekening.'('.$jenis_bank.')</b> on behalf of <b>'.$atas_nama.'</b>');
                        }
                    }
                }
            }else{
                return redirect()->back()->with('error', $message);
            }
        }else{
            
            return redirect()->back()->with('error', "No rooms have been added to cart yet");
        }
    }

    public function bookingList(){
        $data_reservasi = Reservasi::where('id_user', auth()->guard('web')->user()->id)->orderBy('created_at', 'desc')->get();
        $data_detail_reservasi = DetailReservasi::select('tb_detail_reservasi.*')
            ->join('tb_reservasi', 'tb_detail_reservasi.id_reservasi', '=', 'tb_reservasi.id')
            ->where('tb_reservasi.id_user', auth()->guard('web')->user()->id)
            ->get();
        
        $jumlah_reservasi = $data_reservasi->count();
        $jumlah_complete = $data_reservasi->where('status_reservasi', 'Sudah Check-out')->count();
        $jumlah_siap_check_in = $data_reservasi->where('status_reservasi', 'Siap di Check-in')->count();
        $jumlah_sudah_check_in = $data_reservasi->where('status_reservasi', 'Sudah Check-in')->count();
        $jumlah_menunggu_konfirmasi = $data_reservasi->where('status_reservasi', 'Menunggu Konfirmasi')->count();
        $jumlah_pembayaran_ditolak = $data_reservasi->where('status_reservasi', 'Pembayaran di Tolak')->count();
        $jumlah_canceled = $data_reservasi->where('status_reservasi', 'Dibatalkan')->count();
        $jumlah_on_progress = $jumlah_siap_check_in + $jumlah_sudah_check_in + $jumlah_menunggu_konfirmasi + $jumlah_pembayaran_ditolak;
        $jumlah_waiting_payment = $data_reservasi->where('status_reservasi', 'Menunggu Pembayaran')->count();
        
        return view('landing.user.booking-list', [
            'data_reservasi' => $data_reservasi,
            'data_detail_reservasi' => $data_detail_reservasi,
            'jumlah_reservasi' => $jumlah_reservasi,
            'jumlah_complete' => $jumlah_complete,
            'jumlah_on_progress' => $jumlah_on_progress,
            'jumlah_waiting_payment' => $jumlah_waiting_payment,
            'jumlah_canceled' => $jumlah_canceled
        ]);
    }

    public function bookingDetail($id){
        $data_reservasi = Reservasi::find($id);
        $data_detail_reservasi = DetailReservasi::where('id_reservasi', $id)->latest()->get();
        $path = public_path().'/json/rekening.json';
        $json_rekening = json_decode(file_get_contents($path), true);
        $jenis_bank = $json_rekening['rekening'][0]['jenis_bank'];
        $no_rekening = $json_rekening['rekening'][0]['no_rekening'];
        $atas_nama = $json_rekening['rekening'][0]['atas_nama'];

        return view('landing.user.booking-detail', [
            'data_reservasi' => $data_reservasi,
            'data_detail_reservasi' => $data_detail_reservasi,
            'jenis_bank' => $jenis_bank,
            'no_rekening' => $no_rekening,
            'atas_nama' => $atas_nama,
        ]);
    }
    
    public function batalkanBooking($id){
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
                return redirect()->back()->with('success', 'Booking has been cancelled');
            }
        }
    }

    public function bookingPayment(Request $request, $id){
        $reservasi = Reservasi::find($id);

        $image_name = $reservasi->no_reservasi." - PAYMENT.".$request->bukti->extension();
        $request->bukti->storeAs('/public/payment', $image_name);

        $reservasi->bukti_pembayaran = $image_name;
        $now = Carbon::now();
        $reservasi->status_reservasi = 'Menunggu Konfirmasi';
        $reservasi->tgl_pembayaran = $now->toDateTimeString();

        $reservasi->save();

        return redirect()->back()->with('success', 'Proof of payment successfully uploaded.');
    }
}
