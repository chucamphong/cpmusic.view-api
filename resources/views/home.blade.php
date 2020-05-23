@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
    <!-- Bảng xếp hạng -->
    <div class="row mb-3">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">Bảng xếp hạng</h2>
            <a href="#xem-them" class="h5 mb-0">Xem thêm</a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2">
            <a href="#xem-them">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-vn.png" alt="">
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2">
            <a href="#xem-them">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-us.png" alt="">
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-2 d-md-none d-xl-block">
            <a href="#xem-them">
                <img class="img-fluid" src="//static-zmp3.zadn.vn/dev/skins/zmp3-v5.2/images/chart-song-kpop.png"
                     alt="">
            </a>
        </div>
    </div>

    <!-- Mới phát hành -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">Mới phát hành</h2>
            <a href="#xem-them" class="h5 mb-0">Xem thêm</a>
        </div>
        @php
            /** @var \App\Models\Song $song */
            /** @var \App\Models\Artist $artist */
        @endphp
        @foreach($songs as $key => $song)
            <div class="col-6 col-sm-4 col-md-4 col-lg-2">
                <div class="card bg-transparent shadow-none">
                    <a href="{{ route('song.listen', $song->id) }}" title="{{ $song->name }}">
                        <img src="{{ Storage::url($song->thumbnail) }}" alt="{{ $song->name }}"
                             class="card-img-top img-fluid">
                    </a>
                    <div class="card-body px-0 py-1">
                        <a href="{{ route('song.listen', $song->id) }}" title="{{ $song->name }}">
                            <h4 class="text-truncate text-capitalize m-0">{{$song->name}}</h4>
                        </a>
                        <h5 class="text-muted text-truncate">{!! $song->artists->map(function ($artist) {
                            return "<a href='/ca-si/$artist->id'>$artist->name</a>";
                        })->join(', ') !!}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Thể loại -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="d-inline mb-0 text-uppercase">Thể loại</h2>
            <a href="#xem-them" class="h5 mb-0">Xem thêm</a>
        </div>
        @php /** @var \App\Models\Category $category */ @endphp
        @foreach($categories as $key => $category)
            <div class="col-6 col-sm-4 col-xl-2 {{ $key >= 4 ? 'd-none d-sm-block' : null }}">
                <div class="card">
                    <a href="#test">
                        <img class="card-img" src="{{ Storage::url($category->thumbnail) }}" alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <div
                                class="card-title text-white mb-2 text-truncate font-weight-bolder text-size-xs text-size-sm text-size-md">{{ $category->name }}</div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
