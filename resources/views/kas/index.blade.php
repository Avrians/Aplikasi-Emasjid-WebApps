@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">Data Kas Masjid</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    {!! Form::open([
                         'url' => url()->current(),
                         'method' => 'GET',
                         'class' => 'row row-cols-lg-auto align-items-center'
                    ]) !!}
                        <div class="col-auto">
                            <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Kas</a>
                        </div>
                        <div class="col-auto ms-auto">
                          <label for="inlineFormInputGroupUsername">Tanggal Transaksi</label>
                          {!! Form::date('tanggal', request('tanggal'), ['class' => 'form-control']) !!}
                        </div>
                      
                        <div class="col-auto">
                          <label for="inlineFormSelectPref">Keterangan Transaksi</label>
                          {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 'Keterangan Transaksi']) !!}
                        </div>
                      
                        <div class="col-auto mt-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      {!! Form::close() !!}
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Diinput Oleh</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Pemasukan</th>
                                    <th class="text-end">Pengeluaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kases as $key => $kas)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $kas->tanggal->translatedFormat('d-m-Y') }}</td>
                                        <td>{{ $kas->createdBy->name }}</td>
                                        <td>{{ $kas->kategori ?? 'umum' }}</td>
                                        <td>{{ $kas->keterangan }}</td>
                                        <td class="text-end">
                                            {{ $kas->jenis == 'masuk' ? formatRupiah($kas->jumlah, true) : '-' }}
                                        </td>
                                        <td class="text-end">
                                            {{ $kas->jenis == 'keluar' ? formatRupiah($kas->jumlah, true) : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('kas.show', $kas->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('kas.edit', $kas->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kas.destroy', $kas->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center fw-bold">TOTAL</td>
                                    <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
                                    <td class="text-end"  >{{ formatRupiah($totalPengeluaran, true) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <h4>Saldo Akhir Rp. {{ formatRupiah($saldoAkhir) }}</h4>
                    {{ $kases->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
