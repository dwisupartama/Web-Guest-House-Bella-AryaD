<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konten;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_konten = Konten::latest()->get();
        return view('admin.data-konten.index', ['data_konten' => $data_konten]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data-konten.tambah');
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
            'judul_konten' => 'required|max:50',
            'deskripsi_konten' => 'required',
        ]);

        if($validated){
            $tambah_konten = Konten::create([
                'judul_konten' => $request->judul_konten,
                'deskripsi_konten' => $request->deskripsi_konten
            ]);

            if($tambah_konten){
                return redirect()->route('admin.data-konten.index')->with('success', 'Data konten berhasil ditambahkan.');
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
        $data_konten = Konten::find($id);
        return view('admin.data-konten.edit', ['data_konten' => $data_konten]);
        
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
            'judul_konten' => 'required|max:50',
            'deskripsi_konten' => 'required',
        ]);

        if($validated){
            $data_konten = Konten::find($id);
    
            $data_konten->judul_konten = $request->judul_konten;
            $data_konten->deskripsi_konten = $request->deskripsi_konten;

            $data_konten->save();
            
            return redirect()->route('admin.data-konten.index')->with('success', 'Data konten berhasil diperbaharui.');
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
        $delete_data_konten = Konten::find($id)->delete();

        if($delete_data_konten){
            return redirect()->route('admin.data-konten.index')->with('success', 'Data berhasil dihapus.');
        }
    }
}
