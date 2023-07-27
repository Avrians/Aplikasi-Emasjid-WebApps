<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;
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
        $data['model'] = new KurbanHewan();
        $data['route'] = 'kurbanhewan.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Hewan Kurban';
        $data['kurban_id'] = request('kurban_id');
        return view('kurbanhewan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanHewanRequest $request)
    {
        //
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
    public function edit(KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanHewanRequest $request, KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanHewan)
    {
        //
    }
}
