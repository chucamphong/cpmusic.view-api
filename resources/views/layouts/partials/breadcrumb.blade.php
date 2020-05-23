<div class="row align-items-center py-4">
    <div class="col-lg-6 col-7">
        <nav aria-label="breadcrumb" class="d-inline-block">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
    </div>
</div>
