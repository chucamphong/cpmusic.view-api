@extends('layouts.master')

@php
    /** @var \App\Models\Category $category */
@endphp

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="display-3 mb-0 ls-1">{{ $category->name }}</h1>
            <span class="h5 text-uppercase ls-1 text-muted">Hiện có</span>
            <span class="h4 text-muted">{{ $category->songs_count }}</span>
            <span class="h5 text-uppercase ls-1 text-muted">bài hát</span>
        </div>

        <div class="col-12">
            @foreach ($songs as $song)
                <!--suppress JSUnresolvedVariable -->
                <x-song-row :song="$song"></x-song-row>
            @endforeach
        </div>

        <div class="col-12 d-flex justify-content-center">
            {{ $songs->links() }}
        </div>
    </div>
@endsection
