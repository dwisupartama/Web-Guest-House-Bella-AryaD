<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gambar;
use App\Models\Konten;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_gambar = Gambar::latest()->get();
        return view('admin.data-gambar.index', ['data_gambar' => $data_gambar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_konten = Konten::latest()->get();
        return view('admin.data-gambar.tambah', ['data_konten' => $data_konten]);
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
            'gambar_konten' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'nama_gambar' => 'required',
            'konten' => 'required',
            'keterangan' => 'required',
        ]);

        if($validated){
            $tambah_gambar = Gambar::create([
                'id_konten' => $request->konten,
                'nama_gambar' => $request->nama_gambar,
                'keterangan' => $request->keterangan
            ]);

            if($tambah_gambar){
                $id = $tambah_gambar->id;
    
                $image_name = $id."-".$request->nama_gambar.".".$request->gambar_konten->extension();
                $request->gambar_konten->storeAs('/public/img/img-konten', $image_name);

                $save_image = Gambar::find($id);
                $save_image->link_gambar = $image_name;

                $save_image->save();

                return redirect()->route('admin.data-gambar.index')->with('success', 'Data gambar berhasil ditambahkan.');
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
        $data_konten = Konten::latest()->get();
        $data_gambar = Gambar::find($id);
        return view('admin.data-gambar.edit', ['data_gambar' => $data_gambar, 'data_konten' => $data_konten]);
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
            'gambar_konten' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'nama_gambar' => 'required',
            'konten' => 'required',
            'keterangan' => 'required',
        ]);

        if($validated){
            if($request->gambar_konten){
                $image_name = $id."-".$request->nama_gambar.".".$request->gambar_konten->extension();
                $request->gambar_konten->storeAs('/public/img/img-konten', $image_name);

                $data_gambar = Gambar::find($id);
    
                $data_gambar->id_konten = $request->konten;
                $data_gambar->nama_gambar = $request->nama_gambar;
                $data_gambar->link_gambar = $image_name;
                $data_gambar->keterangan = $request->keterangan;

                $data_gambar->save();
                
                return redirect()->route('admin.data-gambar.index')->with('success', 'Data gambar berhasil diperbaharui.');
            }else{
                $data_gambar = Gambar::find($id);
    
                $data_gambar->id_konten = $request->konten;
                $data_gambar->nama_gambar = $request->nama_gambar;
                $data_gambar->keterangan = $request->keterangan;

                $data_gambar->save();
                
                return redirect()->route('admin.data-gambar.index')->with('success', 'Data gambar berhasil diperbaharui.');
            }
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
        $delete_data_gambar = Gambar::find($id)->delete();

        if($delete_data_gambar){
            return redirect()->route('admin.data-gambar.index')->with('success', 'Data berhasil dihapus.');
        }
    }
}
