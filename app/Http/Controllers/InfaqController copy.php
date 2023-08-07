<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfaqRequest;
use App\Http\Requests\UpdateInfaqRequest;

class InfaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Infaq::UserMasjid();
        if ($request->filled('atas_nama')) {
            $query = $query->where('atas_nama', 'LIKE', '%' . $request->atas_nama . '%');
        }
        if ($request->filled('created_at')) {
            $query = $query->where('created_at', '>=', $request->created_at);
        }
        if ($request->filled('tanggal_selesai')) {
            $query = $query->where('tanggal', '<=', $request->tanggal_selesai);
        }

        $query = $query->latest()->paginate(50);
        $title = "Infaq Masjid";
        if ($request->page == 'laporan') {
            // return view('kas.laporan', compact('kases', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'title'));
        }

        return view('infaq.index', compact('query', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $query = new Infaq();
        return view('infaq.form', compact('query'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfaqRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Infaq $infaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infaq $infaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfaqRequest $request, Infaq $infaq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {
        //
    }
}
