@extends('layouts.master')

@php
    /** @var \App\Models\Category $category */
@endphp

@section('title', 'Trang chủ')

@section('content')
    @includeWhen(auth()->guest(), 'layouts.partials.please-register')

    <!-- Bảng xếp hạng -->
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">Bảng xếp hạng</h2>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2">
            <a href="{{ route('song.top-songs', ['country' => 'Việt Nam']) }}">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-vn.png"
                     alt="Bảng xếp hạng bài hát Việt Nam">
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2">
            <a href="{{ route('song.top-songs', ['country' => 'US-UK']) }}">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-us.png"
                     alt="Bảng xếp hạng bài hát US-UK">
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2 d-md-none d-xl-block">
            <a href="{{ route('song.top-songs', ['country' => 'Hàn Quốc']) }}">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-kpop.png"
                     alt="Bảng xếp hạng bài hát Hàn Quốc">
            </a>
        </div>
    </div>

    <!-- TOP Lượt nghe -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">TOP Lượt nghe</h2>
            <a href="{{ route('song.top-songs') }}" class="h5 mb-0">Xem thêm</a>
        </div>
        @foreach($topSongs as $song)
            <!--suppress JSUnresolvedVariable -->
            <x-song :song="$song"></x-song>
        @endforeach
    </div>

    <!-- Mới phát hành -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">Mới phát hành</h2>
            <a href="{{ route('song.new-songs') }}" class="h5 mb-0">Xem thêm</a>
        </div>
        @foreach($songs as $song)
            <!--suppress JSUnresolvedVariable -->
            <x-song :song="$song"></x-song>
        @endforeach
    </div>

    <!-- Thể loại -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="d-inline mb-0 text-uppercase">Thể loại</h2>
            <a href="#xem-them" class="h5 mb-0">Xem thêm</a>
        </div>
        @foreach($categories as $category)
            <div class="col-6 col-sm-4 col-xl-2 {{ $loop->index >= 4 ? 'd-none d-sm-block' : null }}">
                <!--suppress HtmlUnknownTag, JSUnresolvedVariable -->
                <x-category :category="$category"></x-category>
            </div>
        @endforeach
    </div>
@endsection
