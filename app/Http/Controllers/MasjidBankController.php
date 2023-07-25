<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\MasjidBank;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;

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
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        $data['title'] = 'Tambah Bank Masjid';
        return view('masjidbank.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrfail($validateData['bank_id']);
        unset($validateData['bank_id']);
        $validateData['kode_bank'] =  $bank->sandi_bank;
        $validateData['nama_bank'] =  $bank->nama_bank;

        MasjidBank::create($validateData);
        flash('Data sudah disimpan');
        return back();
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
    public function edit(MasjidBank $masjidbank)
    {
        $data['model'] = $masjidbank;
        $data['route'] = ['masjidbank.update', $masjidbank->id];
        $data['method'] = 'PUT';
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        $data['title'] = 'Edit Bank Masjid';
        return view('masjidbank.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasjidBank $masjidbank)
    {
        $validateData = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
        ]);
        $bank = Bank::findOrfail($validateData['bank_id']);
        unset($validateData['bank_id']);
        $validateData['kode_bank'] =  $bank->sandi_bank;
        $validateData['nama_bank'] =  $bank->nama_bank;
        $masjidbank->update($validateData);
        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjidbank)
    {
        $masjidbank->delete();
        flash('Data sudah di hapus');
        return back();
    }
}
