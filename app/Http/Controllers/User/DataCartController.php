<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Cart;

class DataCartController extends Controller
{
    public function cartList(){
        $data_cart = Cart::where('id_user', auth()->guard('web')->user()->id)->get();
        return view('landing.user.cart-list', ['data_cart' => $data_cart]);
    }

    public function cartDelete($id){
        $delete_cart = Cart::find($id)->delete();

        if($delete_cart){
            return redirect()->route('landing.user.cartList')->with('success', 'Room successfully removed from cart .');
        }
    }

    public function addToCart(Request $request){
        $validate = $request->validate([
            'id_kamar' => [
                'required',
                Rule::unique('tb_cart')->where(function ($query) use ($request) {
                    return $query->where('id_user', auth()->guard('web')->user()->id);
                })
            ],
            'adults' => 'required|integer|max:2',
            'children' => 'required|integer|max:2',
        ],
        [
            'id_kamar.unique' => "The room is already in the cart list",
        ]);

        if($validate){
            $tambah_cart = Cart::create([
                'id_user' => auth()->guard('web')->user()->id,
                'id_kamar' => $request->id_kamar,
                'jumlah_dewasa' => $request->adults,
                'jumlah_anak' => $request->children
            ]);
            
            if($tambah_cart){
                return redirect()->route('landing.booking.room', [$request->id_kamar])->with('success', 'Please check the cart page on profile');
            }
        }
    }
}
