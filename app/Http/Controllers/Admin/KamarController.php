<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Kamar;
use App\Models\TipeKamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_kamar = Kamar::latest()->get();
        return view('admin.data-kamar.index', ['data_kamar' => $data_kamar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_tipe_kamar = TipeKamar::latest()->get();
        return view('admin.data-kamar.tambah', ['data_tipe_kamar' => $data_tipe_kamar]);
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
            'no_kamar' => [
                'required',
                'max:10',
                Rule::unique('tb_kamar')->where(function ($query) use ($request) {
                    return $query->where('id_tipe_kamar', $request->tipe_kamar);
                })
            ],
            'tipe_kamar' => 'required',
            'gambar_kamar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'harga_kamar' => 'required|numeric',
            'deskripsi_kamar' => 'required',
        ]);
        
        if($validated){
            $tambah_kamar = Kamar::create([
                'no_kamar' => $request->no_kamar,
                'id_tipe_kamar' => $request->tipe_kamar,
                'harga_kamar' => $request->harga_kamar,
                'deskripsi_kamar' => $request->deskripsi_kamar
            ]);

            if($tambah_kamar){
                $id = $tambah_kamar->id;
    
                $image_name = $id."-".$request->no_kamar.".".$request->gambar_kamar->extension();
                $request->gambar_kamar->storeAs('/public/img/img-kamar', $image_name);

                $save_image = Kamar::find($id);
                $save_image->gambar_kamar = $image_name;

                $save_image->save();

                return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil ditambahkan.');
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
        $data_kamar = Kamar::find($id);
        return view('admin.data-kamar.detail', ['data_kamar' => $data_kamar]);
        // return dd($data_kamar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_tipe_kamar = TipeKamar::latest()->get();
        $data_kamar = Kamar::find($id);
        return view('admin.data-kamar.edit', ['data_kamar' => $data_kamar, 'data_tipe_kamar' => $data_tipe_kamar]);
        // return $data_kamar;
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
            'no_kamar' => [
                'required',
                'max:10',
                Rule::unique('tb_kamar')->where(function ($query) use ($request, $id) {
                    return $query->where('id_tipe_kamar', $request->tipe_kamar)->where('id', '<>', $id);
                })
            ],
            'tipe_kamar' => 'required',
            'gambar_kamar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'harga_kamar' => 'required|numeric',
            'deskripsi_kamar' => 'required',
        ]);

        if($validated){
            if($request->gambar_kamar){
                $image_name = $id."-".$request->no_kamar.".".$request->gambar_kamar->extension();
                $request->gambar_kamar->storeAs('/public/img/img-kamar', $image_name);

                $data_kamar = Kamar::find($id);
    
                $data_kamar->no_kamar = $request->no_kamar;
                $data_kamar->id_tipe_kamar = $request->tipe_kamar;
                $data_kamar->gambar_kamar = $image_name;
                $data_kamar->harga_kamar = $request->harga_kamar;
                $data_kamar->deskripsi_kamar = $request->deskripsi_kamar;

                $data_kamar->save();
                
                return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil diperbaharui.');
            }else{
                $data_kamar = Kamar::find($id);
    
                $data_kamar->no_kamar = $request->no_kamar;
                $data_kamar->id_tipe_kamar = $request->tipe_kamar;
                $data_kamar->harga_kamar = $request->harga_kamar;
                $data_kamar->deskripsi_kamar = $request->deskripsi_kamar;

                $data_kamar->save();
                
                return redirect()->route('admin.data-kamar.index')->with('success', 'Data kamar berhasil diperbaharui.');
            }
        }

        // return dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data_kamar = Kamar::find($id)->delete();

        if($delete_data_kamar){
            return redirect()->route('admin.data-kamar.index')->with('success', 'Data berhasil dihapus.');
        }
    }
}
