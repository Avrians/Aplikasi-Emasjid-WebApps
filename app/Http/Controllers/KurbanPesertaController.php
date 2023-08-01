<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Models\Peserta;
use App\Models\KurbanHewan;
use App\Models\KurbanPeserta;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\UpdateKurbanPesertaRequest;

class KurbanPesertaController extends Controller
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
        // kita lakukan validasi terlebih dahulu agar user tidak dapat merubah ID pada URL -> jadi apabila user mengganti ID pada URL yang bukan milik UserId itu sendiri akan muncul halaman "NotFound"
        // caranya dengan kita lakukan Query berdasarkan UserMasjid
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        // tampilkan hewan kurbannya -> ada relasi pada kurban ke hewankurban
        $data['listKurbanHewan'] = $kurban->kurbanHewan->pluck('nama_full', 'id');
        $data['model'] = new KurbanPeserta();
        $data['route'] = 'kurbanpeserta.store';
        $data['method'] = 'POST';
        $data['title'] = 'Tambah Informasi Peserta Kurban';
        $data['kurban'] = $kurban;
        return view('kurbanpeserta.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanPesertaRequest $request)
    {
        $requestData = $request->validated();
        $requestDataPeserta = $requestData;
        unset($requestDataPeserta['status_bayar']);
        unset($requestDataPeserta['kurban_hewan_id']);
        unset($requestDataPeserta['status_bayar']);
        unset($requestDataPeserta['total_bayar']);
        unset($requestDataPeserta['tanggal_bayar']);
        unset($requestDataPeserta['kurban_id']);
        DB::beginTransaction();
        $peserta = Peserta::create($requestDataPeserta);
        if ($request->filled('status_bayar')) {
            $kurbanHewan = KurbanHewan::userMasjid()->where('id', $request->kurban_hewan_id)->firstOrFail();
            $dataKurbanPeserta = [
                'kurban_id' => $kurbanHewan->kurban_id,
                'kurban_hewan_id' => $kurbanHewan->id,
                'peserta_id' => $peserta->id,
                'total_bayar' => $requestData['total_bayar'],
                'tanggal_bayar' => $requestData['tanggal_bayar'],
                'status_bayar' => 'Lunas',
                'metode_bayar' => 'Tunai',
                'bukti_bayar' => 'OK',
            ];
            KurbanPeserta::create($dataKurbanPeserta);
        };

        DB::commit();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanPesertaRequest $request, KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanPeserta $kurbanPeserta)
    {
        //
    }
}
