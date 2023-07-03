<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasjidRequest;
use App\Http\Requests\UpdateMasjidRequest;
use App\Models\Masjid;

class MasjidController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masjid = new Masjid();
        return view('masjid_form', [
            'masjid' => $masjid,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasjidRequest $request)
    {
        //
    }
}
