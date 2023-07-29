<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;
use App\Models\Kurban;
use App\Models\KurbanHewan;

class KurbanHewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['model'] = new KurbanHewan();
        $data['route'] = 'kurbanhewan.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanHewanRequest $request)
    {
        KurbanHewan::create($request->validated());
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanHewan $kurbanhewan)
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $data['model'] = $kurbanhewan;
        $data['route'] = ['kurbanhewan.update', $kurbanhewan->id];
        $data['method'] = 'PUT';
        $data['title'] = 'Ubah Informasi Hewan Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanhewan.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanHewanRequest $request, KurbanHewan $kurbanhewan)
    {
        $kurbanhewan->update($request->validated());
        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanhewan)
    {
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $kurbanhewan->delete();
        flash('Data sudah di hapus');
        return back();
    }
}
