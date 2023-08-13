<?php

namespace App\Http\Controllers;

use App\Charts\InfaqBulananChart;
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
    public function index(InfaqBulananChart $chart)
    { 
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalInfaq = Infaq::userMasjid()->whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('jumlah');
            $dataBulan[] = ubahAngkaToBulan($i);
            // $dataBulan[] = Carbon::create()->month($i)->format('F'); // atau bisa menggunakan seperti ini 
            $dataTotalInfaq[] = $totalInfaq;
        }

        $data['dataBulan'] = $dataBulan;
        $data['dataTotalInfaq'] = $dataTotalInfaq;
        $data['chart'] = $chart->build();
        $data['saldoAkhir'] = Kas::saldoAkhir();
        $data['totalInfaq'] = Infaq::userMasjid()->whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah');
        $data['kas'] = Kas::userMasjid()->latest()->take(7)->get();
        $data['title'] ='Beranda';
        return view('home',$data);
    }
}
