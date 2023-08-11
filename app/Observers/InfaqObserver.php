<?php

namespace App\Observers;

use App\Models\Kas;
use App\Models\Infaq;
use Exception;

class InfaqObserver
{
    /**
     * Handle the Infaq "created" event.
     */
    public function created(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                $kas = new Kas();
                $kas->infaq_id = $infaq->id;
                $kas->tanggal = $infaq->created_at;
                $kas->kategori = 'infaq-' . $infaq->sumber;
                $kas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
                $kas->jenis = 'masuk';
                $kas->jumlah = $infaq->jumlah;
                $kas->save();
            } catch (\Throwable $th) {
                throw new Exception("Eror, data kas gagal disimpan");
            }
        }
    }

    /**
     * Handle the Infaq "updated" event.
     */
    public function updated(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                $kas = $infaq->kas;
                $kas->jumlah = $infaq->jumlah;
                $kas->save();
            } catch (\Throwable $th) {
                throw new Exception("Eror, data kas gagal diubah");
            }
        }
    }

    /**
     * Handle the Infaq "deleted" event.
     */
    public function deleted(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try { 
                $infaq->kas->delete();
            } catch (\Throwable $th) {
                throw new Exception("Eror, data kas gagal dihapus");
            }
        }
    }

    /**
     * Handle the Infaq "restored" event.
     */
    public function restored(Infaq $infaq): void
    {
        //
    }

    /**
     * Handle the Infaq "force deleted" event.
     */
    public function forceDeleted(Infaq $infaq): void
    {
        //
    }
}
