<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin"
                         data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link pr-0" href="{{ route('register') }}">
                            Đăng ký
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pr-0" href="{{ route('login') }}">
                            Đăng nhập
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if (Auth::getUser()->avatar)
                                    <img src="{{ Auth::getUser()->avatar }}" alt="{{ Auth::getUser()->name }}" />
                                @else
                                    <i class="ni ni-single-02"></i>
                                @endif
                            </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm font-weight-bold">{{ Auth::getUser()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Xin chào!</h6>
                            </div>
                            <a id="logoutBtn" href="{{ route('logout') }}" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@auth
    <form id="logoutFrm" method="post" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>

    @push('scripts')
        <script>
            (() => {
                const logoutBtn = document.getElementById('logoutBtn');
                const logoutFrm = document.getElementById('logoutFrm');

                logoutBtn.onclick = (event) => {
                    event.preventDefault();

                    logoutFrm.submit();
                };
            })();
        </script>
    @endpush
@endauth
