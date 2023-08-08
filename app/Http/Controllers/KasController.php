<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use Carbon\Carbon;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kas::UserMasjid();
        if ($request->filled('q')) {
            $query = $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
        }
        if ($request->filled('tanggal_mulai')) {
            $query = $query->where('tanggal', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query = $query->where('tanggal', '<=', $request->tanggal_selesai);
        }
        
        $kases = $query->latest()->paginate(50);
        $title = "Kas Masjid";
        $totalPemasukan = $kases->where('jenis', 'masuk')->sum('jumlah');
        $totalPengeluaran = $kases->where('jenis', 'keluar')->sum('jumlah');
        $saldoAkhir = Kas::SaldoAkhir();
        if($request->page == 'laporan') {
            return view('kas.laporan', compact('kases', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'title'));
        }

        return view('kas.index', compact('kases', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'title'));
    }

    public function create()
    {
 
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
        if ($tahunBulanTransaksi != $tahunBulanSekarang) {
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
        $kas->save();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

        flash('Data kas berhasil ditambahkan.')->success();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function edit(Kas $ka)
    {
        $kas = $ka;
        $saldoAkhir = Kas::SaldoAkhir();
        $disable = ['disabled' => 'disabled'];
        return view('kas.form', compact('kas', 'saldoAkhir', 'disable'));
    }

    public function update(Request $request, Kas $ka)
    {
        $validatedData = $request->validate([
            'kategori' => 'nullable',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);
        $jumlah = str_replace('.', '', $validatedData['jumlah']);
        $saldoAkhir = Kas::SaldoAkhir();
        $kas =  $ka;
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


    public function destroy(Kas $ka)
    {
        $kas =  $ka;

        if ($kas->infaq_id != null) {
            flash('Data kas gagal dihapus. Data kas ini terhubung dengan data infaq, silahkan hapus data melalui menu Data infaq')->error();
            return back();
        }

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
