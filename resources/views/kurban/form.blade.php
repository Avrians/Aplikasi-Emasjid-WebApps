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
                        {!! Form::label('tahun_hijriah', 'Judul') !!}
                        {!! Form::text('judul', null, ['class' => 'form-control', 'placeholder' => 'Judul']) !!}
                        <span class="text-danger">{{ $errors->first('judul') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'Konten / Isi Profil') !!}
                        {!! Form::textarea('konten', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Isi Profil','id' => 'summernote','required']) !!}
                        <span class="text-danger">{{ $errors->first('konten') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kurban.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
