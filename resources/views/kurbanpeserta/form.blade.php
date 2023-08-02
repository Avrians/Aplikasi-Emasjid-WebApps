@extends('layouts.main_admin')

@section('js')
    <script>
        $(document).ready(function() {
            $('.pembayaran').hide();
            $("#my-input").change(function(e) {
                if ($(this).is(':checked')) {
                    $('.pembayaran').show();
                } else {
                    $('.pembayaran').hide();
                }
            });
        });
    </script>
@endsection

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <h3 class="card-header">{{ isset($kases) ? 'Edit Kas' : 'Tambah Kas' }}</h3> --}}

                <div class="card-body">
                    <div class="alert alert-secondary" role="alert">
                        Tanda * wajib diisi
                    </div>
                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}

                    {!! Form::hidden('kurban_id', $kurban->id, []) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('nama', 'Nama Lengkap Peserta') !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('nama_tampilan', 'Nama Alias (Yang ditampilkan di web)') !!}
                        {!! Form::text('nama_tampilan', $model->nama_tampilan ?? 'Hamba Allah', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama_tampilan') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('nohp', 'No HP*') !!}
                        {!! Form::text('nohp', null, ['class' => 'form-control ']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('alamat', 'Alamat') !!}
                        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban') !!}
                        {!! Form::select('kurban_hewan_id', $listKurbanHewan, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kurban_hewan_id') }}</span>
                    </div>
                    {{-- jika user sudah melakukan pembayaran, maka otomatis akan masuk ke table kurbanPeserta --}}
                    <div class="form-group mb-3">
                        <div class="form-check">
                            {!! Form::checkbox('status_bayar', 1, $model->status_bayar ?? false, [
                                'class' => 'form-check-input',
                                'id' => 'my-input',
                            ]) !!}
                            <label for="my-input" class="form-check-label">Sudah Melakukan Pembayaran</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('status_bayar') }}</span>
                    </div>

                    <div class="pembayaran">
                        <h3>Data Pembayaran</h3>
                        <div class="alert alert-secondary" role="alert">
                            Jika total bayar kosong, maka otomatis dari iuran perorang
                        </div>

                        {{-- kita tampilkan form Total Pembayarannya -> karena biasanya ada yang bayar lebih dari seharusnya --}}
                        <div class="form-group mb-3">
                            {!! Form::label('total_bayar', 'Total Pembayaran') !!}
                            {!! Form::text('total_bayar', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('total_bayar') }}</span>
                        </div>

                        {{-- kita tampilkan Tanggal Pembayaran --}}
                        <div class="form-group mb-3">
                            {!! Form::label('tanggal_bayar', 'Tanggal Pembayaran') !!}
                            {!! Form::text('tanggal_bayar', $model->tanggal_bayar ?? now(), ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kurban.show', $kurban->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
