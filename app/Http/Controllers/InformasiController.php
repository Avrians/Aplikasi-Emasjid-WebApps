<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Informasi::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Masjid';
        return view('informasi.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Informasi();
        $data['route'] = 'informasi.store';
        $data['method'] = 'POST';
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = 'Tambah Informasi Baru';
        return view('informasi.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori_id' => 'nullable',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Informasi::create($validateData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $data['informasi'] = $informasi;
        $data['title'] = 'Detail Masjid';
        return view('informasi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $data['model'] = $informasi;
        $data['route'] = ['informasi.update', $informasi->id];
        $data['method'] = 'PUT';
        $data['listKategori'] = Kategori::pluck('nama', 'id');
        $data['title'] = 'Edit Informasi ';
        return view('informasi.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $validateData = $request->validate([
            'kategori_id' => 'nullable',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $model = Informasi::findOrFail($informasi->id);
        $model->update($validateData);
        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        flash('Data sudah di hapus');
        return back();
    }
}
