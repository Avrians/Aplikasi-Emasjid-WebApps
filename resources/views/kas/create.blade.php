@extends('layouts.main_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">{{ isset($kas) ? 'Edit Kas' : 'Tambah Kas' }}</h3>

                <div class="card-body">
                    @if (isset($kas))
                        {!! Form::model($kas, ['route' => ['kas.update', $kas->id], 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['route' => 'kas.store', 'method' => 'POST']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis</label><br>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('jenis', 'masuk', null, ['class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('jenis', 'Masuk', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('jenis', 'Keluar', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('jumlah', 'Jumlah') !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('saldo_akhir', 'Saldo Akhir') !!}
                        {!! Form::number('saldo_akhir', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_by', 'Dibuat Oleh') !!}
                        {!! Form::text('created_by', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
