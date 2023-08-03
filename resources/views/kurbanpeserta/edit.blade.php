@extends('layouts.main_admin')


@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Status Pembayaran : {{ $model->getStatusText() }}</h4>
                    <div class="alert alert-secondary" role="alert">
                        Tanda * wajib diisi
                    </div>
                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}

                    {!! Form::hidden('kurban_id', $kurban->id, []) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban') !!}
                        {!! Form::select('kurban_hewan_id', $listKurbanHewan, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kurban_hewan_id') }}</span>
                    </div>

                    <div class="pembayaran">
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
