<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Cart;

class GetCountCart extends Component
{
    public $jumlah_cart;
    
    public function render()
    {
        $this->jumlah_cart = Cart::where('id_user', auth()->user()->id)->count();
        
        return <<<'blade'
            <div>
                {{ $jumlah_cart }}
            </div>
        blade;
    }
}
