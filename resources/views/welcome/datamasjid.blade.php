@extends('layouts.welcome')

@section('content')
    <main class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
            <img class="me-3" src="/images/logobulan.png" alt="" width="48" height="38">
            <div class="lh-1">
                <h1 class="h6 mb-0 text-white lh-1">{{ strtoupper($masjid->nama) }}</h1>
                <small>{{ $masjid->alamat }}</small>
            </div>
        </div>

        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">Informasi Kas Masjid</h6>

            {{-- @foreach ($masjid as $item) --}}
                <div class="d-flex text-body-secondary pt-3">
                    <img class="me-3" src="/images/masjid.png" alt="" width="32" height="32">
                    <p class="pb-3 mb-0 small lh-sm border-bottom">
                        {{-- <a href="{{ route('data-masjid.show', $item->id) }}" class="link"> --}}
                            <strong class="d-block text-gray-dark">aaaa</strong>
                        {{-- </a>
                        {{ $item->alamat }} --}}
                    </p>
                </div>
            {{-- @endforeach --}}


            <small class="d-block text-end mt-3">
                <a href="{{ route('login') }}">Login Pengurus</a>
            </small>
        </div>

    </main>
@endsection
