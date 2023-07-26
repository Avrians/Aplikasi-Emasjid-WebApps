<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;
use App\Models\Kurban;

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
    public function store(StoreKurbanRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanRequest $request, Kurban $kurban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        //
    }
}
