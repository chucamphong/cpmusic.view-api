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

    <!-- TOP Lượt nghe -->
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 text-uppercase">TOP Lượt nghe</h2>
            <a href="{{ route('song.most-viewed') }}" class="h5 mb-0">Xem thêm</a>
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
            <a href="#xem-them" class="h5 mb-0">Xem thêm</a>
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
                <div class="card">
                    <a href="#test">
                        <img class="card-img" src="{{ Storage::url($category->thumbnail) }}"
                             alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <div class="card-title text-white mb-2 text-truncate font-weight-bolder text-size-xs text-size-sm text-size-md">
                                {{ $category->name }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
