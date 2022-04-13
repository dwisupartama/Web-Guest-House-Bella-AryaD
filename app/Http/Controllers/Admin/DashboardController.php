<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Reservasi;
use App\Models\DetailReservasi;
use App\Models\Kamar;

class DashboardController extends Controller
{
    public function dashboardPage(){
        $month_now = Carbon::now()->month;
        $year_now = Carbon::now()->year;

        $data_reservasi_bertambah_hari_ini = Reservasi::whereDate('tgl_pemesanan', Carbon::now()->format('Y-m-d'))->get();
        $data_reservasi_check_in_hari_ini = Reservasi::where('tgl_book_check_in', Carbon::now()->format('Y-m-d'))->get();
        $data_reservasi_bulan_ini = Reservasi::whereMonth('tgl_pemesanan', $month_now)->whereYear('tgl_pemesanan', $year_now)->get();
        $data_penghasilan_bulan_ini = Reservasi::whereMonth('tgl_pemesanan', $month_now)->whereYear('tgl_pemesanan', $year_now)->sum('total_pembayaran');
        $data_rekap_reservasi = Reservasi::latest()->get();
        $data_penghasilan_per_bulan = Reservasi::selectRaw("MONTH(tgl_pemesanan) AS bulan, SUM(total_pembayaran) AS total")
        ->whereYear('tgl_pemesanan', $year_now)
        ->groupBy(\DB::raw('MONTH(tgl_pemesanan)'))
        ->get();
        $data_penghasilan_per_tahun = Reservasi::selectRaw("YEAR(tgl_pemesanan) AS tahun, SUM(total_pembayaran) AS total")->groupBy(\DB::raw('YEAR(tgl_pemesanan)'))->get();

        $data_pembelian_kamar = DetailReservasi::selectRaw("COUNT(id) AS jumlah, id_kamar")->groupBy('id_kamar')->orderBy('jumlah','DESC')->get();
        $data_kamar = Kamar::all();

        return view('admin.dashboard', [
            'data_reservasi_bertambah_hari_ini' => $data_reservasi_bertambah_hari_ini,
            'data_reservasi_check_in_hari_ini' => $data_reservasi_check_in_hari_ini,
            'data_reservasi_bulan_ini' => $data_reservasi_bulan_ini,
            'data_penghasilan_bulan_ini' => $data_penghasilan_bulan_ini,
            'data_rekap_reservasi' => $data_rekap_reservasi,
            'data_penghasilan_per_tahun' => $data_penghasilan_per_tahun,
            'data_penghasilan_per_bulan' => $data_penghasilan_per_bulan,
            'data_pembelian_kamar' => $data_pembelian_kamar,
            'data_kamar' => $data_kamar,
        ]);

        // return $data_pembelian_kamar;
    }
}
