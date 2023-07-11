<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;

class KasController extends Controller
{
    public function index()
    {
        $kases = Kas::latest()->paginate(50);

        return view('kas.index', compact('kases'));
    }

    public function create()
    {
        $kas = new Kas();
        $saldoAkhir = Kas::SaldoAkhir();
        return view('kas.create', compact('kas', 'saldoAkhir'));
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


        //  $saldoAkhir = $this->calculateSaldoAkhir($validatedData['jenis'], $validatedData['jumlah']);

        $kas = new Kas();
        $kas->fill($validatedData);
        $kas['saldo_akhir'] = $saldoAkhir;
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        $kas->save();
        // Kas::create($kas);

        flash('Data kas berhasil ditambahkan.')->success();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required',
        ]);

        $saldo_akhir = $this->calculateSaldoAkhir($validatedData['jenis'], $validatedData['jumlah']);

        $validatedData['saldo_akhir'] = $saldo_akhir;

        Kas::whereId($id)->update($validatedData);

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil diperbarui.');
    }

    private function calculateSaldoAkhir($jenis, $jumlah)
    {
        // Ambil saldo terakhir
        $lastKas = Kas::orderBy('id', 'desc')->first();
        $saldo_akhir = $lastKas ? $lastKas->saldo_akhir : 0;

        // Hitung saldo akhir berdasarkan jenis transaksi
        if ($jenis == 'masuk') {
            $saldo_akhir += $jumlah;
        } elseif ($jenis == 'keluar') {
            $saldo_akhir -= $jumlah;
        }

        return $saldo_akhir;
    }

    // ...
}
