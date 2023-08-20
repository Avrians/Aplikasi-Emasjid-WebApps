<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class DataMasjidController extends Controller
{
    public function show($slug)
    {
        $data['masjid'] = Masjid::where('id', $slug)->firstOrFail();
        return view('welcome.datamasjid', $data);
    }

    public function profil($slugMasjid, $slugProfil)
    {
        $data['masjid'] = Masjid::where('id', $slugMasjid)->firstOrFail();
        $data['profil'] = $data['masjid']->profils()->where('slug', $slugProfil)->firstOrFail();
        return view('welcome.profil', $data);
    }

    public function informasi($slugMasjid, $slugInformasi)
    {
        $data['masjid'] = Masjid::where('id', $slugMasjid)->firstOrFail();
        $data['informasi'] = $data['masjid']->informasi()->where('slug', $slugInformasi)->firstOrFail();
        return view('welcome.informasi', $data);
    }
}
