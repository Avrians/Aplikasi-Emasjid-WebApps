@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('informasi.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <td width="15%">Judul </td>
                                <td>: {{ $informasi->judul }}</td>
                            </tr>
                            <tr>
                                <td>Konten </td>
                                <td>: {!! $informasi->konten !!}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Posting </td> 
                                <td>: {{ $informasi->created_at->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Dibuat Oleh </td>
                                <td>: {{ $informasi->createdBy->name }}</td>
                            </tr>
                        </table>
                        <div class="form-group mb-3">
                            <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
