<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main" style="z-index: 1050">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <h1 class="navbar-brand text-primary m-0"
               style="font-size:28px">{{ config('app.name') }}</h1>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ !Route::is('home') ?: 'active' }}" href="{{ route('home') }}">
                            <i class="fas fa-h-square text-primary"></i>
                            <span class="nav-link-text">Trang Chủ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ !Route::is('song.new-songs') ?: 'active' }}" href="{{ route('song.new-songs') }}">
                            <i class="ni ni-notification-70 text-orange"></i>
                            <span class="nav-link-text">Mới Phát Hành</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ !Route::is('song.top-songs') ?: 'active' }}" href="#navbar-song-charts" data-toggle="collapse" role="button" aria-expanded="{{ Route::is('song.top-songs') ? 'true' : 'false' }}" aria-controls="navbar-song-charts">
                            <i class="fas fa-star text-yellow"></i>
                            <span class="nav-link-text">Bảng Xếp Hạng</span>
                        </a>
                        <div class="collapse {{ !Route::is('song.top-songs') ?: 'show' }}" id="navbar-song-charts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('song.top-songs') }}" class="nav-link">
                                        <span class="sidenav-mini-icon">L</span>
                                        <span class="sidenav-normal">Lượt nghe nhiều nhất</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('song.top-songs', ['country' => 'Việt Nam']) }}" class="nav-link">
                                        <span class="sidenav-mini-icon">V</span>
                                        <span class="sidenav-normal">Bài hát Việt Nam</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('song.top-songs', ['country' => 'US-UK']) }}" class="nav-link">
                                        <span class="sidenav-mini-icon">U</span>
                                        <span class="sidenav-normal">Bài hát US-UK</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('song.top-songs', ['country' => 'Hàn Quốc']) }}" class="nav-link">
                                        <span class="sidenav-mini-icon">Hàn Quốc</span>
                                        <span class="sidenav-normal">Bài hát Hàn Quốc</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ !Route::is('category.index') ?: 'active' }}" href="{{ route('category.index') }}">
                            <i class="ni ni-tag text-success"></i>
                            <span class="nav-link-text">Thể Loại</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ !Route::is('artist.index') ?: 'active' }}" href="{{ route('artist.index') }}">
                            <i class="fab fa-artstation text-info"></i>
                            <span class="nav-link-text">Nghệ Sĩ</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Thông Tin</span>
                    <span class="docs-mini"> T </span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item nav-link">
                        <i class="ni ni-folder-17"></i>
                        <span class="nav-link-text">Đồ án cơ sở</span>
                    </li>
                    <li class="nav-item nav-link">
                        <i class="ni ni-spaceship"></i>
                        <span class="nav-link-text">
                            Liên hệ:
                            <a href="https://fb.com/chuphong1999" class="font-weight-bold" target="_blank">Chu Phong</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
