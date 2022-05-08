<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reservasi;
use App\Models\DetailReservasi;

class ExpiredTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired = Carbon::now()->subDay();
        $date = $expired->toDateTimeString();

        $reservasi_expired = Reservasi::where('tgl_pemesanan', '<', $date)->where('status_reservasi', 'Menunggu Pembayaran')->get();
        if($reservasi_expired->count() > 0){
            foreach($reservasi_expired as $reservasi){  
                $detail_reservasi_expired = DetailReservasi::where('id_reservasi', $reservasi->id)->get();
                foreach($detail_reservasi_expired as $detail_reservasi){
                    $detail_reservasi->status_reservasi_kamar = 'Dibatalkan';
                    $detail_reservasi->save();
                }
                $reservasi->status_reservasi = 'Dibatalkan';
                $reservasi->save();
            }
        }
    }
}
