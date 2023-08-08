@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ isset($query) ? 'Form Edit Infaq' : 'Form Input Infaq' }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                {{-- <h3 class="card-header">{{ isset($kases) ? 'Edit Kas' : 'Tambah Kas' }}</h3> --}}

                <div class="card-body">
                    {!! Form::model($query, [
                        'route' => isset($query->id) ? ['infaq.update', $query->id] : 'infaq.store',
                        'method' => isset($query->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('sumber', 'Sumber Infaq') !!}
                        {!! Form::select('sumber', $listSumberDana, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('sumber') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jenis', 'Sumber Infaq') !!}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="uang" value="uang"
                                checked>
                            <label class="form-check-label" for="uang">Uang Tunai</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="barang" value="barang">
                            <label class="form-check-label" for="barang">Barang</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('jenis') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('atas_nama', 'Keterangan - boleh dikosongkan') !!}
                        {!! Form::textarea('atas_nama', null, ['class' => 'form-control', 'rows' => 2]) !!}
                        <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jumlah', 'Jumlah Infaq') !!}
                        {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'required']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('satuan', 'Satuan Infaq - Misalnya: kg, rupiah, sak, pcs') !!}
                        {!! Form::text('satuan', $query->satuan ?? 'rupiah', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('satuan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('infaq.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
