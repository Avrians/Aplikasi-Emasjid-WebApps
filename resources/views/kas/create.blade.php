@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ isset($kas) ? 'Formulir Edit Kas' : 'Formulir Tambah Kas' }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                {{-- <h3 class="card-header">{{ isset($kases) ? 'Edit Kas' : 'Tambah Kas' }}</h3> --}}

                <div class="card-body">
                    {!! Form::model($kas, [
                        'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store', 
                        'method' => isset($kas->id) ? 'PUT' : 'POST',
                        ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control', 'required']) !!}
                        <span class="text-danger"{{ $errors->first('tanggal')</span> }}></span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis">Jenis Transaksi</label><br>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('jenis', 'masuk', 1, ['class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('jenis', 'Masuk', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('jenis', 'Keluar', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jumlah', 'Jumlah') !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
