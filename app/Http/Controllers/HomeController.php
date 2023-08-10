<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use App\Models\Kas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['saldoAkhir'] = Kas::saldoAkhir();
        $data['totalInfaq'] = Infaq::whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah');
        $data['title'] ='Beranda';
        return view('home',$data);
    }
}
