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
}
