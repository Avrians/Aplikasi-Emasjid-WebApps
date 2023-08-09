<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Kas;
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
        if ($request->filled('q')) {
            $query = $query->where('atas_nama', 'LIKE', '%' . $request->q . '%')
            ->orWhere('sumber', 'LIKE', '%' . $request->q . '%');
        }
        if ($request->filled('tanggal_mulai')) {
            $query = $query->where('created_at', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query = $query->where('created_at', '<=', $request->tanggal_selesai);
        }

        $query = $query->latest()->paginate(50);
        $title = "Infaq Masjid";
        if ($request->page == 'laporan') {
            // return view('kas.laporan', compact('kases', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran', 'title'));
        }

        return view('infaq.index', compact('query', 'title'));
    }
    public function listSumberDana()
    {
        return [
            'kotak-amal-jumat' => 'Kotak amal jumat',
            'instansi' => 'Instansi',
            'perorang' => 'Perorangan / Pribadi',
            'lainnya' => 'Lainnya',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['query'] = new Infaq();
        $data['listSumberDana'] = $this->listSumberDana();
        return view('infaq.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfaqRequest $request)
    {
        $requestData = $request->validated();
        DB::beginTransaction();
        $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah';
        $infaq = Infaq::create($requestData);

        // jika kas berjenis uang maka akan disimpan ke dalam kas masjid
        if ($infaq->jenis == 'uang') {
            $kas = new Kas();
            $kas->infaq_id = $infaq->id;
            $kas->masjid_id = $infaq->masjid_id;
            $kas->tanggal = $infaq->created_at;
            $kas->kategori = 'infaq-' . $infaq->sumber;
            $kas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
            $kas->jenis = 'masuk';
            $kas->jumlah = $infaq->jumlah;
            $kas->save();
        }


        DB::commit();

        flash('Data infaq berhasil ditambahkan dan tersimpan di kas masjid.')->success();
        return back();
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
        $data['query'] = Infaq::UserMasjid()->findOrFail($infaq->id);
        $data['listSumberDana'] = $this->listSumberDana();
        return view('infaq.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfaqRequest $request, Infaq $infaq)
    {
        $requestData = $request->validated();
        DB::beginTransaction();
        $infaq->update($requestData);
        $kas = $infaq->kas;
        $kas->jumlah = $infaq->jumlah;
        $kas->save();
        DB::commit();
        flash('Data infaq berhasil diubah')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {
        if ($infaq->kas != null) {
            $infaq->kas->delete();
        }
        $infaq->delete();
        flash('Data infaq berhasil dihapus')->success();
        return back();
    }
}
