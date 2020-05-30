@props(['category'])

@php
    /** @var \App\Models\Category $category */
@endphp

<div class="card">
    <a href="{{ route('category.show', $category->id) }}">
        <img class="card-img" src="{{ Storage::url($category->thumbnail) }}"
             alt="{{ $category->name }}">
        <div class="card-img-overlay d-flex align-items-center justify-content-center">
            <div
                class="card-title text-white mb-2 text-truncate font-weight-bolder text-size-xs text-size-sm text-size-md">
                {{ $category->name }}
            </div>
        </div>
    </a>
</div>
