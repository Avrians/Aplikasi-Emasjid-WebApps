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
        return view('kas.create', compact('kas'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'masjid_id' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'created_by' => 'required',
        ]);

        $saldo_akhir = $this->calculateSaldoAkhir($validatedData['jenis'], $validatedData['jumlah']);

        $validatedData['saldo_akhir'] = $saldo_akhir;

        dd($validatedData);
        Kas::create($validatedData);

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'masjid_id' => 'required',
            'tanggal' => 'required|date',
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'created_by' => 'required',
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
