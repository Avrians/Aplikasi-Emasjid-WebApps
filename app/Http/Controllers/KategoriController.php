<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kategori::UserMasjid()->latest()->paginate(50);
        $title = 'Kategori Informasi';
        return view('kategori.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Kategori();
        $data['route'] = 'kategori.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Kategori Informasi';
        return view('kategori.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);
        Kategori::create($validateData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data['model'] = $kategori;
        $data['route'] = ['kategori.update', $kategori->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Kategori Informasi';  
        return view('kategori.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable',
        ]);

        $model = Kategori::findOrFail($kategori->id);
        $model->update($validateData);
        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
