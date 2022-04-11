<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Reservasi;

class GetCountBooking extends Component
{
    public $jumlah_booking;
    
    public function render()
    {
        $this->jumlah_booking = Reservasi::where('id_user', auth()->user()->id)
        ->where(function ($query){
             $query->where('status_reservasi', 'Menunggu Pembayaran')
                ->orWhere('status_reservasi', 'Siap di Check-in')
                ->orWhere('status_reservasi', 'Sudah Check-in');
        })->count();

        return <<<'blade'
            <div>
                {{ $jumlah_booking }}
            </div>
        blade;
    }
}
