@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">{{ $title }}</h2>
        </div>
        @foreach($songs as $song)
            <!--suppress JSUnresolvedVariable -->
            <x-song :song="$song"></x-song>
        @endforeach
    </div>
@endsection
