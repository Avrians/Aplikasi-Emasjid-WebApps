<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;

class KurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kurban::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Kurban';
        return view('kurban.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new Kurban();
        $data['route'] = 'kurban.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Kurban';
        return view('kurban.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        Kurban::create($validateData);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurban $kurban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurban $kurban)
    {
        $data['model'] = $kurban;
        $data['route'] = ['kurban.update', $kurban->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Edit Informasi Kurban ';
        return view('kurban.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurban $kurban)
    {
        $validateData = $request->validate([
            'tahun_hijriah' => 'required',
            'tahun_masehi' => 'required',
            'tanggal_akhir_pendaftaran' => 'required',
            'konten' => 'required',
        ]);

        $kurban->update($validateData);
        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        $kurban->delete();
        flash('Data sudah di hapus');
        return back();
    }
}
