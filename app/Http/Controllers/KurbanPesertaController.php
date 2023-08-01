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
        // kita lakukan validasi terlebih dahulu agar user tidak dapat merubah ID pada URL -> jadi apabila user mengganti ID pada URL yang bukan milik UserId itu sendiri akan muncul halaman "NotFound"
        // caranya dengan kita lakukan Query berdasarkan UserMasjid
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        // tampilkan hewan kurbannya -> ada relasi pada kurban ke hewankurban
        $data['listKurbanHewan'] = $kurban->kurbanHewan->pluck('hewan', 'id');
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
        $requestDataPeserta = $request->validated();
        unset($requestDataPeserta['status_bayar']);
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
