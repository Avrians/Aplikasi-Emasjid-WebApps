@extends('layouts.laporan_admin')

@section('content')
    <h2 class="m-4 text-center">LAPORAN DATA KURBAN TAHUN Kurban {{ $kurban->tahun_hijriah }}H / {{ $kurban->tahun_masehi }}M
    </h2>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Tahun Kurban {{ $kurban->tahun_hijriah }}H / {{ $kurban->tahun_masehi }}</h3>

                    </div>
                    <h6> <i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran :
                        <b>{{ $kurban->tanggal_akhir_pendaftaran->format('d-m-Y') }}</b>
                    </h6>
                    <h6> <i class="align-middle" data-feather="user"></i> Create By : <b>{{ $kurban->createdBy->name }}</b>
                    </h6>
                    <p>{!! $kurban->konten !!}</p>
                    <hr>
                    <h3>Data Hewan Kurban</h3>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <td width="1%">No</td>
                                <td>Hewan</td>
                                <td>Iuran</td>
                                <td>Harga</td>
                                <td>Biaya Operasional</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurban->kurbanHewan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->hewan }}({{ $item->kriteria }})</td>
                                    <td>{{ formatRupiah($item->iuran_perorang) }}</td>
                                    <td>{{ formatRupiah($item->harga) }}</td>
                                    <td>{{ formatRupiah($item->biaya_operasional) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    {{-- Modul peserta kurban --}}
                    <hr>
                    <h3>Data Peserta Kurban</h3>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <td width="1%">No</td>
                                <td>Nama</td>
                                <td>Nomor HP</td>
                                <td>Alamat</td>
                                <td>Jenis Hewan</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurban->kurbanPeserta as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>{{ $item->peserta->nama }}</div>
                                        <div>({{ $item->peserta->nama_tampilan }})</div>
                                    </td>
                                    <td>{{ $item->peserta->nohp }}</td>
                                    <td>{{ $item->peserta->alamat }}</td>
                                    <td>
                                        {{ ucwords($item->kurbanHewan->hewan) }} -
                                        {{ $item->kurbanHewan->kriteria }} -
                                        {{ formatRupiah($item->kurbanHewan->iuran_perorang) }}
                                    </td>
                                    <td>
                                        @if ($item->status_bayar == 'lunas')
                                            <span class="badge bg-success me-1 my-1">{{ $item->getStatusText() }}</span>
                                        @else
                                            <span class="badge bg-secondary me-1 my-1">{{ $item->getStatusText() }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
