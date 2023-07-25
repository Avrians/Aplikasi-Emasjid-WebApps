<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;
use App\Models\MasjidBank;

class MasjidBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = MasjidBank::UserMasjid()->latest()->paginate(50);
        $title = 'Informasi Bank Masjid';
        return view('masjidbank.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['model'] = new MasjidBank();
        $data['route'] = 'masjidbank.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Bank Masjid';
        return view('masjidbank.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasjidBankRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasjidBankRequest $request, MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjidBank)
    {
        //
    }
}
