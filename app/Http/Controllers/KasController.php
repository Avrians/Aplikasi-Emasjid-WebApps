<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use Carbon\Carbon;

class KasController extends Controller
{
    public function index()
    {
        $kases = Kas::UserMasjid()->latest()->paginate(50);
        $saldoAkhir = Kas::SaldoAkhir();
        return view('kas.index', compact('kases', 'saldoAkhir'));
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
        $tanggalTransaksi = Carbon::parse($validatedData['tanggal']);
        $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
        $tahunBulanSekarang = Carbon::now()->format('Ym');
        if($tahunBulanTransaksi != $tahunBulanSekarang) {
            flash('Data kas gagal ditambahkan. Transaksi hanya bisa dilakukan untuk bulan ini')->error();
            return back();
        }

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
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

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
            'jumlah' => 'required',
        ]);
        $jumlah = str_replace('.', '', $validatedData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();
        $kas =  Kas::findOrFail($id);
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }
        $saldoAkhir = $saldoAkhir + $jumlah;
        $validatedData['jumlah'] = $jumlah;
        $kas->fill($validatedData);
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);


        flash('Data kas berhasil diperbaharui.')->success();
        return redirect()->route('kas.index');
    }


    public function destroy($id)
    {
        $kas =  Kas::findOrFail($id);
        $saldoAkhir = Kas::SaldoAkhir();
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }
        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }
        $kas->delete();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);
        flash('Data sudah disimpan');
        return redirect()->route('kas.index');
    }
}
