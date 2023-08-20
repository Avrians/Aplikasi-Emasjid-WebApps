@extends('layouts.welcome')

@section('content')
    <main class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
            <img class="me-3" src="/images/logobulan.png" alt="" width="48" height="38">
            <div class="lh-1">
                <h1 class="h6 mb-0 text-white lh-1">{{ strtoupper($masjid->nama) }}</h1>
                <small>{{ $masjid->alamat }}</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">Informasi Kas Masjid</h6>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th class="text-end">Jumlah</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($kas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tanggal->translatedFormat('d F Y') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->jenis == 'masuk')
                                    <span class="badge bg-success">Masuk</span>
                                @else
                                    <span class="badge bg-warning">Keluar</span>
                                @endif
                            </td>
                            <td class="text-end">{{ formatRupiah($item->jumlah, true) }}</td>

                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
            <h4>Saldo Akhir: {{ formatRupiah($masjid->saldo_akhir, true) }} </h4>
        </div>

    </main>
@endsection
