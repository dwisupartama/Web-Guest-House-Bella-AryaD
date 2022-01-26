<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_admin = Admin::latest()->get();
        return view('admin.data-admin.index', ['data_admin' => $data_admin]);
        // return $data_admin;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data-admin.tambah');
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
            'nama_admin' => 'required|max:50',
            'username' => 'required|unique:tb_admin|max:255',
            'password' => 'required|confirmed',
            'alamat_admin' => 'required',
            'no_telp_admin' => 'required|numeric|digits_between:11,15|unique:tb_admin,no_telp',
        ]);

        if($validated){
            $tambah_admin = Admin::create([
                'nama_admin' => $request->nama_admin,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'alamat_admin' => $request->alamat_admin,
                'no_telp' => $request->no_telp_admin
            ]);

            if($tambah_admin){
                return redirect()->route('admin.data-admin.index')->with('success', 'Data admin berhasil ditambahkan.');
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
        $data_admin = Admin::find($id);
        return view('admin.data-admin.edit', ['data_admin' => $data_admin]);
        // return $data_admin;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
