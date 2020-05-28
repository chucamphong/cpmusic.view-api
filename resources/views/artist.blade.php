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
        <div class="col-12">
            @foreach ($songs as $song)
                <div class="card bg-gradient-default text-white">
                    <a href="{{ route('song.listen', $song->id) }}">
                        <div class="card-body d-flex flex-row align-items-center">
                            <img class="img-fluid rounded mr-3" style="max-width: 80px"
                                 src="{{ Storage::url($song->thumbnail) }}"
                                 alt="{{ $song->name }}">
                            <div class="d-flex flex-column" style="min-width: 0">
                                <h3 class="text-white song-name text-capitalize font-weight-bold">
                                    {{ $song->name }}
                                </h3>
                                <h4 class="block song-artists text-truncate font-weight-normal text-white-50">
                                    {!! $song->artists->pluck('name', 'id')->map(function ($artist, $id) {
                                        return sprintf(
                                            '<a class="text-white-50" href="%s">%s</a>',
                                            route('artist.show', $id),
                                            $artist
                                        );
                                    })->join(', ') !!}
                                </h4>
                                <h4 class="text-white-50 font-weight-normal">{{ $song->views_formatted }} lượt nghe</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="col-12 d-flex justify-content-center">
            {{ $songs->links() }}
        </div>
    </div>
@endsection
