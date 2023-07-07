@extends('layouts.main_admin')

@section('content')
    <h1 class="h3 mb-3">Data Kas Masjid</h1>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Kas</a>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Saldo Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kases as $key => $kas)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $kas->tanggal }}</td>
                                    <td>{{ $kas->kategori }}</td>
                                    <td>{{ $kas->keterangan }}</td>
                                    <td>{{ $kas->jenis }}</td>
                                    <td>{{ $kas->jumlah }}</td>
                                    <td>{{ $kas->saldo_akhir }}</td>
                                    <td>
                                        <a href="{{ route('kas.show', $kas->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('kas.edit', $kas->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('kas.destroy', $kas->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kases->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
