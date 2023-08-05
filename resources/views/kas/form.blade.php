@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ isset($kas) ? 'Form Transaksi Edit Kas' : 'Formulir Tambah Kas' }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                {{-- <h3 class="card-header">{{ isset($kases) ? 'Edit Kas' : 'Tambah Kas' }}</h3> --}}

                <div class="card-body">
                    <h4>Saldo Akhir Saat Ini : Rp. {{ formatRupiah($saldoAkhir) }}</h4>
                    {!! Form::model($kas, [
                        'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store',
                        'method' => isset($kas->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <div class="form-group mb-3">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control', 'required'] + $disable) !!}
                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                    </div>

                    {{-- <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div> --}}

                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis">Jenis Transaksi</label><br>
                        <div class="form-check form-check-inline mt-2">
                            {!! Form::radio('jenis', 'masuk', 1, ['class' => 'form-check-input', 'required'] + $disable) !!}
                            {!! Form::label('jenis', 'Pemasukan', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'required'] + $disable) !!}
                            {!! Form::label('jenis', 'Pengeluaran', ['class' => 'form-check-label']) !!}
                        </div>
                        <span class="text-danger">{{ $errors->first('jenis') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jumlah', 'Jumlah Transaksi') !!}
                        {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'required']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
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
