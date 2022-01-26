<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage(){
        return view('admin.auth.login');
    }

    public function loginProses(){
        if(Auth::guard("admin")->attempt(['username' => request()->username, 'password' => request()->password])){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error','Username atau Password Salah');
        }
        // return dd(request()->all());
    }

    public function logout()
    {
        auth()->guard("admin")->logout();
        return redirect()->route('admin.login');
    }
}
