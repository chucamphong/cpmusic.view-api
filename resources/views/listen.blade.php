@extends('layouts.master')

@php
    /** @var \App\Models\Song $song */

    $name = Str::title($song->name);
    $thumbnail = Storage::url($song->thumbnail);
    $artists = $song->artists->pluck('name')->join(', ');
@endphp

@section('title', "$name - $artists")

@section('content')
    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="mb-0">Đang phát bài hát: {{ $name }} - {{ $artists }}</h3>
            <span>Lượt nghe: {{ $song->views_formatted }}</span>
        </div>

        <div class="col-12 mb-3">
            <div id="player"></div>
        </div>

        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">Gợi ý</h2>
        </div>

        @foreach($relatedSongs as $relatedSong)
            <!--suppress JSUnresolvedVariable -->
                <x-song :song="$relatedSong"></x-song>
        @endforeach
    </div>
@endsection

@section('LinkStyleSheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css">
@endsection

@section('LinkScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.js"></script>
@endsection

@push('styles')
    <!--suppress CssUnusedSymbol -->
    <style>
        .aplayer-title {
            font-size: 1rem !important;
        }

        .aplayer-author {
            font-size: .8rem !important;
        }

        .aplayer .aplayer-pic {
            height: 100px;
            width: 100px;
        }

        .aplayer .aplayer-info {
            margin-left: 100px;
            padding: 30px 7px 0 10px;
            height: 100px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (() => {
            new APlayer({
                container: document.getElementById('player'),
                theme: '#5e72e4',
                audio: [{
                    name: '{{ $name }}',
                    artist: '{{ $artists }}',
                    url: '{{ Storage::url($song->url) }}',
                    cover: '{{ $thumbnail }}',
                    theme: '#5e72e4'
                }]
            });
        })();
    </script>
@endpush
