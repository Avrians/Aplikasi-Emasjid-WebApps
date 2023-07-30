<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Models\KurbanPeserta;
use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\UpdateKurbanPesertaRequest;

class KurbanPesertaController extends Controller
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
        $data['model'] = new KurbanPeserta();
        $data['route'] = 'kurbanpeserta.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Peserta Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanpeserta.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanPesertaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanPesertaRequest $request, KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanPeserta $kurbanPeserta)
    {
        //
    }
}
