@props(['song'])

@php
    /**
    * @var \App\Models\Song $song
    */

    $link = route('song.listen', $song->id);
    $name = Str::title($song->name);
    $thumbnail = Storage::url($song->thumbnail);
@endphp

<div class="col-6 col-sm-4 col-md-4 col-lg-2">
    <div class="card bg-transparent shadow-none">
        <a href="{{ $link }}" title="{{ $name }}">
            <img src="{{ $thumbnail }}" alt="{{ $name }}" class="card-img-top img-fluid">
        </a>
        <div class="card-body px-0 py-1">
            <a href="{{ $link }}" title="{{ $name }}">
                <h4 class="text-truncate text-capitalize m-0">{{ $name }}</h4>
                <h5 class="text-truncate text-capitalize m-0">{{ $song->other_name }}</h5>
            </a>
            <h5 class="text-muted text-truncate">{!! $song->artists->map(function ($artist) {
                $artistUrl = route('artist.show', $artist->id);
                return "<a href='$artistUrl'>$artist->name</a>";
            })->join(', ') !!}</h5>
        </div>
    </div>
</div>
