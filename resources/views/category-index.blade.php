@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12 d-flex align-items-center justify-content-between mb-3">
        <h1 class="mb-0 ls-1 text-uppercase">Thể loại</h1>
    </div>
    @foreach($categories as $category)
        <div class="col-6 col-sm-4 col-xl-2 {{ $loop->index >= 4 ? 'd-none d-sm-block' : null }}">
            <!--suppress HtmlUnknownTag, JSUnresolvedVariable -->
            <x-category :category="$category"></x-category>
        </div>
    @endforeach
</div>
@endsection
