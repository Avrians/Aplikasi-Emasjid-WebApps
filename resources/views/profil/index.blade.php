@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('profil.create') }}" class="btn btn-primary">Tambah Profile</a>
                    </div>
                    <table class="{{ config('app.table_style') }}">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul </th>
                                <th>Konten</th>
                                <th>Diinput Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $key => $profil)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $profil->judul }}</td>
                                    <td>{{ strip_tags($profil->konten) }}</td>
                                    <td>{{ $profil->createdBy->name }}</td>
                                    <td>
                                        <a href="{{ route('profil.show', $profil->id) }}"
                                            class="btn btn-info btn-sm mb-1 mx-1">Detail</a>
                                        <a href="{{ route('profil.edit', $profil->id) }}"
                                            class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['profil.destroy', $profil->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1 mx-1"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
