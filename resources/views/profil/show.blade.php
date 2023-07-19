@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">Profil Masjid</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('profil.create') }}" class="btn btn-primary">Tambah Profile</a>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <td width="15%">Judul </td>
                            <td>: {{ $profil->judul }}</td>
                        </tr>
                        <tr>
                            <td>Konten </td>
                            <td>: {!! $profil->konten !!}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Posting </td>
                            <td>: {{ $profil->created_at->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Dibuat Oleh  </td>
                            <td>: {{ $profil->createdBy->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
