@extends('layouts.master')

@php
    /**
     * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $artists
     * @var \App\Models\Artist $artist
     */
@endphp

@section('title', 'Nghệ sĩ')

@section('content')
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-3">
            <h1 class="mb-0 ls-1 text-uppercase">Nghệ sĩ</h1>
        </div>

        @foreach ($artists as $artist)
            <div class="col-6  col-sm-4 col-md-3 col-lg-2 mb-5">
                <a class="d-flex flex-column align-items-center" href="{{ route('artist.show', $artist->id) }}">
                    <img src="{{ Storage::url($artist->avatar) }}" alt="{{ $artist->name }}" class="rounded-circle mb-2"
                         style="max-width: 84px"/>
                    <h3 class="mb-0 ls-1 mw-100 font-weight-normal text-truncate">{{ $artist->name }}</h3>
                </a>
            </div>
        @endforeach

        <div class="col-12 d-flex justify-content-center">
            {{ $artists->links() }}
        </div>
    </div>
@endsection
