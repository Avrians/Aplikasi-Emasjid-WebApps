@extends('layouts.main_admin')

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
                        {!! Form::label('hewan', 'Jenis Hewan*') !!}
                        {!! Form::select('hewan', [
                            'sapi' => 'Sapi',
                            'kambing' => 'Kambing',
                            'domba' => 'Domba',
                            'kerbau' => 'Kerbau',
                            'onta' => 'Onta',
                        ], null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('hewan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('kriteria', 'Kriteria Hewan (Misalnya: Kambing Super)') !!}
                        {!! Form::text('kriteria', $model->kriteria ?? 'Standard', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kriteria') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('iuran_perorang', 'Iuran Perorang*') !!}
                        {!! Form::text('iuran_perorang', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('iuran_perorang') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('harga', 'Harga Hewan') !!}
                        {!! Form::text('harga', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('harga') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('biaya_operasional', 'Biaya Operasional') !!}
                        {!! Form::text('biaya_operasional', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('biaya_operasional') }}</span>
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
