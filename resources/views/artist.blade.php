@extends('layouts.master')

@php
    /** @var \App\Models\Artist $artist */
@endphp

@section('title', "Nghệ sĩ $artist->name")

@section('content')
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <img src="{{ Storage::url($artist->avatar) }}" alt="{{ $artist->name }}" class="rounded-circle"
                 style="max-width: 64px"/>
            <div class="d-flex flex-column ml-3">
                <h1 class="mb-0 ls-1">{{ $artist->name }}</h1>
                <span class="h5 text-uppercase ls-1 text-muted">Hiện có {{ $artist->songs_count }} bài hát</span>
            </div>
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
