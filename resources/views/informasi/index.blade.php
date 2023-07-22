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
                            @foreach ($models as $key => $informasi)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $informasi->judul }}</td>
                                    <td>{{ strip_tags($informasi->konten) }}</td>
                                    <td>{{ $informasi->createdBy->name }}</td>
                                    <td>
                                        <a href="{{ route('informasi.show', $informasi->id) }}"
                                            class="btn btn-info btn-sm mb-1 mx-1">Detail</a>
                                        <a href="{{ route('informasi.edit', $informasi->id) }}"
                                            class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['informasi.destroy', $informasi->id],
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
