@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">{{ $title }}</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NAma </th>
                                <th>Keterangan</th>
                                <th>Diinput Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $key => $kategori)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td>{{ strip_tags($kategori->keterangan) }}</td>
                                    <td>{{ $kategori->createdBy->name }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['kategori.destroy', $kategori->id],
                                            'style' => 'display:inline',
                                        ]) !!}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
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
