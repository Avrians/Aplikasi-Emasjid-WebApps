@extends('layouts.main_admin')
@section('css')
    {{-- Menggunakan ApexChart - CSS--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.css"
        integrity="sha512-nnNXPeQKvNOEUd+TrFbofWwHT0ezcZiFU5E/Lv2+JlZCQwQ/ACM33FxPoQ6ZEFNnERrTho8lF0MCEH9DBZ/wWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    {{-- Menggunakan ApexChart --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.js"
        integrity="sha512-Gpg0M5UOTFSHGglemXUOUzL1LyO8MT0fxmEAjGN8jNlY6oSOsLerF1/vuXrqJXKyV5QIay12trwDDhmRJHZisA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Data Graphic nya --}}
    <script>
        var options = {
            series: [{
                name: "Total Infaq",
                data: @json($dataTotalInfaq)
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Data Total Infaq Perbulan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories:  @json($dataBulan),
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    {{-- Menggunakan Larapex --}}
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">
            <strong>Analytics</strong> Dashboard
        </h1>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">
                                                Saldo Akhir
                                            </h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        {{ formatRupiah($saldoAkhir, true) }}
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-danger">
                                            <i class="mdi mdi-arrow-bottom-right"></i>
                                            -3.65%
                                        </span>
                                        <span class="text-muted">Since last
                                            week</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">
                                                Total Infaq Hari ini
                                            </h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">
                                        {{ formatRupiah($totalInfaq, true) }}
                                    </h1>
                                    <div class="mb-0">
                                        <span class="text-success">
                                            <i class="mdi mdi-arrow-bottom-right"></i>
                                            5.25%
                                        </span>
                                        <span class="text-muted">Since last
                                            week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill w-100">
                    <div class="card-body py-3a">
                        {{-- Menggunakan ApexChart --}}
                        <div id="chart"></div>

                        {{-- Menggunakan Larapex  --}}
                        {{-- {!! $chart->container() !!} --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            Transaksi Kas Terbaru
                        </h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th class="d-none d-xl-table-cell">
                                    Tanggal Transaksi
                                </th>
                                <th>Jenis</th>
                                <th class="d-none d-md-table-cell">
                                    Jumlah
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $item->keterangan }}
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        {{ $item->tanggal->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ $item->jenis }}
                                        </span>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ formatRupiah($item->jumlah) }}

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ada</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            Monthly Sales
                        </h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
