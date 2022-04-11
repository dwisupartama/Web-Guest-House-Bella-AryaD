<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;

class DataProfileSettingController extends Controller
{
    public function profileSetting(){
        return view('landing.user.profile-setting');
    }

    public function updateProfile(Request $request){
        $validate = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('id', '<>', auth()->guard('web')->user()->id);
                }),
            ],
            'asal_negara' => ['required', 'string', 'min:2', 'max: 255'],
            'no_telp' => ['required', 'string', 'max: 15'],
        ]);

        if($validate){
            $data_user = User::find(auth()->guard('web')->user()->id);

            $data_user->nama = $request->nama;
            $data_user->email = $request->email;
            $data_user->asal_negara = $request->asal_negara;
            $data_user->no_telp = $request->no_telp;

            $data_user->save();

            return redirect()->back()->with('success', 'Profile has been updated.');
        }
    }

    public function resetPassword(Request $request){
        $validate = $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $currentPassword = auth()->guard('web')->user()->password;
        $old_password = $request->old_password;

        if($validate){
            if(Hash::check($old_password, $currentPassword)){
                auth()->guard('web')->user()->update([
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->back()->with('success', "You are changed your password");
            }else{
                return redirect()->back()->with('error', 'Make sure you fill your old password');
            }
        }
    }
}
