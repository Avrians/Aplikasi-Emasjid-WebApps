@extends('layouts.main_admin')
@section('js')
    <script>
        $(document).ready(function() {
            $("#cetak").click(function(e) {
                var tanggalMulai = $("#tanggal_mulai").val();
                var tanggalSelesai = $("#tanggal_selesai").val();
                var q = $("#q").val();
                params = "?page=laporan&tanggal_mulai=" + tanggalMulai + "&tanggal_selesai=" +
                    tanggalSelesai + "&q=" + q;
                window.open("{{ route('kas.index') }}" + params, '_blank');
            });
        });
    </script>
@endsection
@section('content')
    <h1 class="h3 mb-3">Data {{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title">{{ $title }}</div>
                </div>
                <div class="card-body mt-0 pt-0">
                    {!! Form::open([
                        'url' => url()->current(),
                        'method' => 'GET',
                    ]) !!}
                    <div class="d-flex bd-highlight mb-3 align-items-center">
                        <div class="me-auto bd-highlight">
                            <a href="{{ route('infaq.create') }}" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="bd-highlight mx-1">
                            {!! Form::label('tm', 'Tanggal Mulai', []) !!}
                            {!! Form::date('tanggal_mulai', request('tanggal_mulai'), [
                                'class' => 'form-control',
                                'placeholder' => 'Tanggal Mulai',
                                'id' => 'tanggal_mulai',
                            ]) !!}
                        </div>
                        <div class="bd-highlight mx-1">
                            {!! Form::label('ts', 'Tanggal Selesai', []) !!}
                            {!! Form::date('tanggal_selesai', request('tanggal_selesai'), [
                                'class' => 'form-control',
                                'placeholder' => 'Tanggal Selesai',
                                'id' => 'tanggal_selesai',
                            ]) !!}
                        </div>
                        <div class="bd-highlight me-1">
                            {!! Form::label('k', 'Keterangan', []) !!}
                            {!! Form::text('q', request('q'), [
                                'class' => 'form-control',
                                'placeholder' => 'Keterangan Transaksi',
                                'id' => 'q',
                            ]) !!}
                        </div>
                        <div lass="bd-highlight">
                            <button type="submit" class="btn btn-primary mt-3"
                                style="margin-top: 20px !important;">Cari</button>
                            <button type="button" target="blank" class="btn btn-primary mt-3"
                                style="margin-top: 20px !important;" id="cetak">Cetak Laporan</button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <div class="table-responsive mt-3">
                        <table class="{{ config('app.table_style') }}">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Diinput Oleh</th>
                                    <th>Sumber</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($query as $key => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->created_at->translatedFormat('d-m-Y') }}</td>
                                        <td>{{ $data->createdBy->name }}</td>
                                        <td>{{ $data->sumber }}</td>
                                        <td>{{ $data->jenis }}</td>
                                        <td>{{ $data->atas_nama }}</td>
                                        <td class="text-end">
                                            {{ formatRupiah($data->jumlah) }}
                                        </td>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['infaq.destroy', $data->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            @csrf
                                            <a href="{{ route('infaq.edit', $data->id) }}"
                                                class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                            <button type="submit" class="btn btn-danger btn-sm mb-1 mx-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $query->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
