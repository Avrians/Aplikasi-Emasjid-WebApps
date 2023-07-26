@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('kurban.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table class="{{ config('app.table_style') }}">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Informasi</th>
                                <th>Diinput Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $key => $kurban)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $kurban->judul }}</div>
                                        {{ strip_tags($kurban->konten) }}
                                    </td>
                                    <td>{{ $kurban->createdBy->name }}</td>
                                    <td>
                                        <a href="{{ route('kurban.show', $kurban->id) }}"
                                            class="btn btn-info btn-sm mb-1 mx-1">Detail</a>
                                        <a href="{{ route('kurban.edit', $kurban->id) }}"
                                            class="btn btn-primary btn-sm mb-1 mx-1">Edit</a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['kurban.destroy', $kurban->id],
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
