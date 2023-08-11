<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Kas;
use App\Models\Infaq;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfaqRequest;
use App\Http\Requests\UpdateInfaqRequest;
use PhpParser\Node\Stmt\TryCatch;

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
        $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah';

        try {
            DB::beginTransaction(); // jika data ada yang eror maka data ke2 nya tidak akan disimpan jika tidak memakasi ini jika ada yang gagal data masih disimpan disalah satu
            $infaq = Infaq::create($requestData);
            DB::commit(); // jika data sudah benar semua mka baru di simpan
        } catch (\Throwable $th) {
            DB::rollback();
            flash('Data infaq gagal disimpan, eror : ' . $th->getMessage())->error();
            return back();
        }

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
        try {
            DB::beginTransaction();
            $infaq->update($requestData);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            flash('Data infaq gagal diubah, eror : ' . $th->getMessage())->error();
            return back();
        }
        flash('Data infaq berhasil diubah')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {
        try {
            DB::beginTransaction();
            $infaq->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            flash('Data infaq gagal dihapus, eror : ' . $th->getMessage())->error();
            return back();
        }
        flash('Data infaq berhasil dihapus')->success();
        return back();
    }
}
