<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a href="{{ route('home') }}" class="navbar-brand text-primary"
               style="font-size:28px">{{ config('app.name') }}</a>
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
                        <a class="nav-link {{ Request::is(route('home')) ?: 'active' }}" href="{{ route('home') }}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Trang Chủ</span>
                        </a>
                    </li>
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">--}}
                    {{--                            <i class="ni ni-ungroup text-orange"></i>--}}
                    {{--                            <span class="nav-link-text">Examples</span>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="collapse" id="navbar-examples">--}}
                    {{--                            <ul class="nav nav-sm flex-column">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/pricing.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> P </span>--}}
                    {{--                                        <span class="sidenav-normal"> Pricing </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/login.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> L </span>--}}
                    {{--                                        <span class="sidenav-normal"> Login </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/register.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> R </span>--}}
                    {{--                                        <span class="sidenav-normal"> Register </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/lock.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> L </span>--}}
                    {{--                                        <span class="sidenav-normal"> Lock </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/timeline.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> T </span>--}}
                    {{--                                        <span class="sidenav-normal"> Timeline </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/profile.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> P </span>--}}
                    {{--                                        <span class="sidenav-normal"> Profile </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/examples/rtl-support.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> RP </span>--}}
                    {{--                                        <span class="sidenav-normal"> RTL Support </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">--}}
                    {{--                            <i class="ni ni-ui-04 text-info"></i>--}}
                    {{--                            <span class="nav-link-text">Components</span>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="collapse" id="navbar-components">--}}
                    {{--                            <ul class="nav nav-sm flex-column">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/buttons.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> B </span>--}}
                    {{--                                        <span class="sidenav-normal"> Buttons </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/cards.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> C </span>--}}
                    {{--                                        <span class="sidenav-normal"> Cards </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/grid.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> G </span>--}}
                    {{--                                        <span class="sidenav-normal"> Grid </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/notifications.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> N </span>--}}
                    {{--                                        <span class="sidenav-normal"> Notifications </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/icons.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> I </span>--}}
                    {{--                                        <span class="sidenav-normal"> Icons </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/components/typography.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> T </span>--}}
                    {{--                                        <span class="sidenav-normal"> Typography </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="#navbar-multilevel" class="nav-link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-multilevel">--}}
                    {{--                                        <span class="sidenav-mini-icon"> M </span>--}}
                    {{--                                        <span class="sidenav-normal"> Multi level </span>--}}
                    {{--                                    </a>--}}
                    {{--                                    <div class="collapse show" id="navbar-multilevel" style="">--}}
                    {{--                                        <ul class="nav nav-sm flex-column">--}}
                    {{--                                            <li class="nav-item">--}}
                    {{--                                                <a href="#!" class="nav-link ">Third level menu</a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="nav-item">--}}
                    {{--                                                <a href="#!" class="nav-link ">Just another link</a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="nav-item">--}}
                    {{--                                                <a href="#!" class="nav-link ">One last link</a>--}}
                    {{--                                            </li>--}}
                    {{--                                        </ul>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-forms">--}}
                    {{--                            <i class="ni ni-single-copy-04 text-pink"></i>--}}
                    {{--                            <span class="nav-link-text">Forms</span>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="collapse" id="navbar-forms">--}}
                    {{--                            <ul class="nav nav-sm flex-column">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/forms/elements.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> E </span>--}}
                    {{--                                        <span class="sidenav-normal"> Elements </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/forms/components.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> C </span>--}}
                    {{--                                        <span class="sidenav-normal"> Components </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/forms/validation.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> V </span>--}}
                    {{--                                        <span class="sidenav-normal"> Validation </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#navbar-tables" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-tables">--}}
                    {{--                            <i class="ni ni-align-left-2 text-default"></i>--}}
                    {{--                            <span class="nav-link-text">Tables</span>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="collapse" id="navbar-tables">--}}
                    {{--                            <ul class="nav nav-sm flex-column">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/tables/tables.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> T </span>--}}
                    {{--                                        <span class="sidenav-normal"> Tables </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/tables/sortable.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> S </span>--}}
                    {{--                                        <span class="sidenav-normal"> Sortable </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/tables/datatables.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> D </span>--}}
                    {{--                                        <span class="sidenav-normal"> Datatables </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#navbar-maps" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-maps">--}}
                    {{--                            <i class="ni ni-map-big text-primary"></i>--}}
                    {{--                            <span class="nav-link-text">Maps</span>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="collapse" id="navbar-maps">--}}
                    {{--                            <ul class="nav nav-sm flex-column">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/maps/google.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> G </span>--}}
                    {{--                                        <span class="sidenav-normal"> Google </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a href="../../pages/maps/vector.html" class="nav-link">--}}
                    {{--                                        <span class="sidenav-mini-icon"> V </span>--}}
                    {{--                                        <span class="sidenav-normal"> Vector </span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="../../pages/widgets.html">--}}
                    {{--                            <i class="ni ni-archive-2 text-green"></i>--}}
                    {{--                            <span class="nav-link-text">Widgets</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="../../pages/charts.html">--}}
                    {{--                            <i class="ni ni-chart-pie-35 text-info"></i>--}}
                    {{--                            <span class="nav-link-text">Charts</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="../../pages/calendar.html">--}}
                    {{--                            <i class="ni ni-calendar-grid-58 text-red"></i>--}}
                    {{--                            <span class="nav-link-text">Calendar</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
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
                        <i class="ni ni-palette"></i>
                        <span class="nav-link-text">
                            Giao diện:
                            <a href="https://www.creative-tim.com/product/argon-dashboard-pro" class="font-weight-bold"
                               target="_blank">Argon Premium</a>
                        </span>
                    </li>
                    <li class="nav-item nav-link">
                        <i class="ni ni-spaceship"></i>
                        <span class="nav-link-text">
                            Sở hữu:
                            <a href="https://fb.com/chuphong1999" class="font-weight-bold" target="_blank">Chu Phong</a>
                        </span>
                    </li>
                    <li class="nav-item nav-link">
                        <i class="ni ni-chart-pie-35"></i>
                        <span class="nav-link-text">Phiên bản: 0.0.1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
