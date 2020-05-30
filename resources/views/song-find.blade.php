@extends('layouts.master')

@php
    /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $songs */
@endphp

@section('content')
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase text-truncate">Tìm kiếm: {{ Request::get('name') }}</h2>
        </div>

        @if ($songs->isEmpty())
            <div class="col-12">
                <p>Không tìm thấy bài hát trùng khớp</p>
            </div>
        @else
            @foreach($songs as $song)
                <!--suppress JSUnresolvedVariable -->
                <x-song :song="$song"></x-song>
            @endforeach
        @endif

        <div class="col-12 d-flex justify-content-center">
            {{ $songs->links() }}
        </div>
    </div>
@endsection
