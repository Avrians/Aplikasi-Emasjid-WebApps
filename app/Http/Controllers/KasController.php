<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;

class KasController extends Controller
{
    public function index()
    {
        $kases = Kas::UserMasjid()->latest()->paginate(50);

        return view('kas.index', compact('kases'));
    }

    public function create()
    {
        $kas = new Kas();
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = [];
        return view('kas.form', compact('kas', 'saldoAkhir', 'disable'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required',
        ]);
        $validatedData['jumlah'] = str_replace('.', '', $validatedData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();

        // saldo akhir ditambah dengan jumlah transaksi masuk/ keluar
        if ($validatedData['jenis'] == 'masuk') {
            $saldoAkhir += $validatedData['jumlah'];
        } else {
            $saldoAkhir -= $validatedData['jumlah'];
        };

        if ($saldoAkhir < 0) {
            flash('Data kas gagal di tambhakan, saldo akhir di kurang transaksi tidak boleh dari 0')->error();
            return back();
        }
        $kas = new Kas();
        $kas->fill($validatedData);
        // $kas['saldo_akhir'] = $saldoAkhir;
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        $kas->save();

        flash('Data kas berhasil ditambahkan.')->success();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kas =  Kas::findOrFail($id);
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = ['disabled' => 'disabled'];
        return view('kas.form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'required',
        ]);

        $kas =  Kas::findOrFail($id);
        $kas->fill($validatedData);
        $kas->save();

        flash('Data kas berhasil diperbaharui.')->success();
        return redirect()->route('kas.index');
    }


    public function destroy($id)
    {
        $kas =  Kas::findOrFail($id);
        $kas->keterangan =  'Dihapus oleh' . auth()->user()->name;
        $kas->save();
        $saldoAkhir = Kas::SaldoAkhir();
        $kasBaru = $kas->replicate();
        $kasBaru->keterangan = 'Perbaikan data id ke'.$kas->id;
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }
        // $kasBaru->saldo_akhir = $saldoAkhir;
        $kasBaru->save();
        flash('Data sudah disimpan');
        return redirect()->route('kas.index');
    }
}
