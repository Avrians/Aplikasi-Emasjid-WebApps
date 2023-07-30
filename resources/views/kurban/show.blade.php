@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h3>Tahun Kurban {{ $kurban->tahun_hijriah }}H / {{ $kurban->tahun_masehi }}</h3>
                    <h6> <i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran :
                        <b>{{ $kurban->tanggal_akhir_pendaftaran->format('d-m-Y') }}</b>
                    </h6>
                    <h6> <i class="align-middle" data-feather="user"></i> Create By : <b>{{ $kurban->createdBy->name }}</b>
                    </h6>
                    <p>{!! $kurban->konten !!}</p>
                    <hr>
                    <h3>Data Hewan Kurban</h3>
                    @if ($kurban->kurbanHewan->count() >= 1)
                        <a href="{{ route('kurbanhewan.create', ['kurban_id' => $kurban->id]) }}"
                            class="btn btn-primary">Buat Baru</a>
                    @endif

                    @if ($kurban->kurbanHewan->count() == 0)
                        <div class="text-center">Belum ada data.
                            <a href="{{ route('kurbanhewan.create', ['kurban_id' => $kurban->id]) }}">Buat Baru</a>
                        </div>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="1%">No</td>
                                    <td>Hewan</td>
                                    <td>Iuran</td>
                                    <td>Harga</td>
                                    <td>Biaya Operasional</td>
                                    <td>Aksi</td>
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
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kurbanhewan.destroy', [$item->id, 'kurban_id' => $item->kurban_id]],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('kurbanhewan.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm mb-1 mx-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif


                    {{-- Modul peserta kurban --}}
                    <hr>
                    <h3>Data Peserta Kurban</h3>
                    @if ($kurban->kurbanPeserta->count() >= 1)
                        <a href="{{ route('kurbanpeserta.create', ['kurban_id' => $kurban->id]) }}"
                            class="btn btn-primary">Buat Baru</a>
                    @endif

                    @if ($kurban->kurbanPeserta->count() == 0)
                        <div class="text-center">Belum ada data.
                            <a href="{{ route('kurbanpeserta.create', ['kurban_id' => $kurban->id]) }}">Buat Baru</a>
                        </div>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td width="1%">No</td>
                                    <td>Hewan</td>
                                    <td>Iuran</td>
                                    <td>Harga</td>
                                    <td>Biaya Operasional</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kurban->kurbanPeserta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->hewan }}({{ $item->kriteria }})</td>
                                        <td>{{ formatRupiah($item->iuran_perorang) }}</td>
                                        <td>{{ formatRupiah($item->harga) }}</td>
                                        <td>{{ formatRupiah($item->biaya_operasional) }}</td>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kurbanpeserta.destroy', [$item->id, 'kurban_id' => $item->kurban_id]],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('kurbanpeserta.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm mb-1 mx-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="form-group mb-3">
                        <a href="{{ route('kurban.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
