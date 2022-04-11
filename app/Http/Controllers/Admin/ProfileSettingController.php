<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Admin;

class ProfileSettingController extends Controller
{
    public function index(){
        return view('admin.auth.profile-setting');
    }

    public function update(Request $request){
        $validate = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'username' => [
                'required',
                'max:255',
                Rule::unique('tb_admin', 'username')->where(function ($query) {
                    return $query->where('id', '<>', auth()->guard('admin')->user()->id);
                }),
            ],
            'alamat_admin' => 'required',
            'no_telp' => [
                'required',
                'numeric',
                'digits_between:11,15', 
                Rule::unique('tb_admin', 'no_telp')->where(function ($query) {
                    return $query->where('id', '<>', auth()->guard('admin')->user()->id);
                }),
            ],
        ]);

        if($validate){
            $data_admin = Admin::find(auth()->guard('admin')->user()->id);

            $data_admin->nama_admin = $request->nama_admin;
            $data_admin->username = $request->username;
            $data_admin->alamat_admin = $request->alamat_admin;
            $data_admin->no_telp = $request->no_telp;

            $data_admin->save();

            return redirect()->back()->with('success', 'Profil telah diperbaharui.');
        }
    }

    public function resetPassword(Request $request){
        $validate = $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $currentPassword = auth()->guard('admin')->user()->password;
        $old_password = $request->old_password;

        if($validate){
            if(Hash::check($old_password, $currentPassword)){
                auth()->guard('admin')->user()->update([
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->back()->with('success', "Password telah diperbaharui");
            }else{
                return redirect()->back()->with('error', 'Silahkan periksa password lama anda');
            }
        }
    }
}
