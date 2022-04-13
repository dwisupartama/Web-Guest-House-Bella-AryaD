<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

use App\Models\Reservasi;
use App\Models\DetailReservasi;

class LaporanReservasiController extends Controller
{
    public function index(){
        $data_reservasi = Reservasi::latest()->get();
        $data_detail_reservasi = DetailReservasi::latest()->get();

        return view('admin.laporan-reservasi.index', ['data_reservasi' => $data_reservasi, 'data_detail_reservasi' => $data_detail_reservasi]);
    }

    public function modalCetakLaporan(){
        $data_pesanan_old = Reservasi::orderBy('tgl_pemesanan', 'asc')->first();
        $date_old = $data_pesanan_old->tgl_pemesanan;

        return view('admin.laporan-reservasi.modal-cetak', ['date_old' => $date_old]);
    }

    public function cetakLaporan(Request $request){
        $month = Carbon::parse($request->bulan_cetak)->month;
        $monthName = Carbon::parse($request->bulan_cetak)->locale('id')->monthName;
        $year = Carbon::parse($request->bulan_cetak)->year;
        $data_laporan = DetailReservasi::join('tb_reservasi', 'tb_detail_reservasi.id_reservasi', '=', 'tb_reservasi.id')
            ->whereMonth('tb_reservasi.tgl_pemesanan', '=', $month)
            ->whereYear('tb_reservasi.tgl_pemesanan', '=', $year)
            ->get();

        $pdf = PDF::loadView('admin.laporan-reservasi.cetak', ['data_laporan' => $data_laporan, 'periode' => $request->bulan_cetak])->setPaper('legal', 'landscape');
        return $pdf->download('Laporan Bulanan Pererenan Nengah Guest House '.$monthName.' '.$year.'.pdf');
        // return view('admin.laporan-reservasi.cetak', ['data_laporan' => $data_laporan, 'periode' => $request->bulan_cetak]);
    }
}
