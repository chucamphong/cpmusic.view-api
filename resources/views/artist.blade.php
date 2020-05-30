@extends('layouts.master')

@php
    /** @var \App\Models\Artist $artist */
@endphp

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="display-3 mb-0 ls-1">{{ $artist->name }}</h1>
            <span class="h5 text-uppercase ls-1 text-muted">Hiện có</span>
            <span class="h4 text-muted">{{ $artist->songs_count }}</span>
            <span class="h5 text-uppercase ls-1 text-muted">bài hát</span>
        </div>

        @foreach ($songs as $song)
            <!--suppress JSUnresolvedVariable -->
            <x-song :song="$song"></x-song>
        @endforeach

        <div class="col-12 d-flex justify-content-center">
            {{ $songs->links() }}
        </div>
    </div>
@endsection
