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
                        {!! Form::label('nama', 'Nama Kategori (Misalnya:Agenda,Informasi Pengajian dan kategori lainnya)') !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Kategori']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Keterangan Kategori']) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
