<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Reservasi;
use App\Models\DetailReservasi;

class ReservasiController extends Controller
{
    public function index(){
        $data_reservasi = Reservasi::latest()->get();
        return view('admin.data-reservasi.index', ['data_reservasi' =>  $data_reservasi]); 
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
