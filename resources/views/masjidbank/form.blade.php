@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <h3 class="card-header">{{ isset($kases) ? 'Edit Kas' : 'Tambah Kas' }}</h3> --}}

                <div class="card-body">
                    {!! Form::model($model, [
                        'route' => $route,
                        'method' => $method,
                    ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('nama_bank', 'Nama Bank') !!}
                        {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2', 'placeholder' => 'Pilih Bank']) !!}
                        <span class="text-danger">{{ $errors->first('nama_bank') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('nama_rekening', 'Nama Pemilik Rekening') !!}
                        {!! Form::text('nama_rekening', null, ['class' => 'form-control', 'placeholder' => 'Nama Pemilik Rekening']) !!}
                        <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('nomor_rekening', 'Nomor Rekening') !!}
                        {!! Form::text('nomor_rekening', null, ['class' => 'form-control', 'placeholder' => 'Nomor Rekening']) !!}
                        <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('masjidbank.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
