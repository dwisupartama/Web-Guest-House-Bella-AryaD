<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = User::latest()->get();
        return view('admin.data-user.index', ['data_user' => $data_user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data-user.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed',
            'asal_negara' => 'required',
            'no_telp' => 'required|numeric|digits_between:11,15|unique:users',
        ]);

        if($validated){
            $tambah_user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'asal_negara' => $request->asal_negara,
                'no_telp' => $request->no_telp
            ]);

            if($tambah_user){
                return redirect()->route('admin.data-user.index')->with('success', 'Data user berhasil ditambahkan.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_user = User::find($id);
        return view('admin.data-user.edit', ['data_user' => $data_user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$id.'|max:255',
            'asal_negara' => 'required',
            'no_telp' => 'required|numeric|digits_between:11,15|unique:users,no_telp,'.$id,
        ]);

        if($validated){
            $data_user = User::find($id);
    
            $data_user->nama = $request->nama;
            $data_user->email = $request->email;
            $data_user->asal_negara = $request->asal_negara;
            $data_user->no_telp = $request->no_telp;

            $data_user->save();
            
            return redirect()->route('admin.data-user.index')->with('success', 'Data user berhasil diperbaharui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data_user = User::find($id)->delete();

        if($delete_data_user){
            return redirect()->route('admin.data-user.index')->with('success', 'Data berhasil dihapus.');
        }
    }
}
