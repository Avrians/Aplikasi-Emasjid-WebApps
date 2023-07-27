@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <h3>Tahun Kurban {{ $model->tahun_hijriah }}H / {{ $model->tahun_masehi }}</h3>
                    <h6> <i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran : <b>{{ $model->tanggal_akhir_pendaftaran->format('d-m-Y') }}</b></h6>
                    <h6> <i class="align-middle" data-feather="user"></i> Create By : <b>{{ $model->createdBy->name }}</b></h6>
                    <p>Informasi :{!! $model->konten !!}</p>

                    <div class="form-group mb-3">
                        <a href="{{ route('kurban.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
