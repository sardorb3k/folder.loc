<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <base href="{{ url('/') }}">
    <meta charset="utf-8">
    <meta name="author" content="Sardor Sattorov">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Luna Unversity. SRM panel">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>@yield('title') - {{ config('app.name', 'Luna Unversity') }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ url('/assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ url('/assets/css/theme.css?ver=2.9.1') }}">
</head>

<body class="nk-body bg-white npc-default has-aside ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-lg wide-xl">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="{{ url('/dashboard') }}" class="logo-link">
                                    <h4 style="font-family: 'Nioicon';">Luna unversity</h4>
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown language-dropdown d-none d-sm-block mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <img class="icon"
                                                    src="./images/flags/{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}.png"
                                                    alt="{{ Config::get('languages')[App::getLocale()]['display'] }}">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-s1">
                                            <ul class="language-list">
                                                @foreach (Config::get('languages') as $lang => $language)
                                                    @if ($lang != App::getLocale())
                                                        <li>
                                                            <a href="{{ route('lang.switch', $lang) }}"
                                                                class="language-item">
                                                                <img src="{{ url('/images/flags/' . $language['flag-icon'] . '.png') }}"
                                                                    alt="" class="language-flag">
                                                                <span
                                                                    class="language-name">{{ $language['display'] }}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li><!-- .dropdown -->
                                    {{-- <li class="dropdown notification-dropdown">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">You have requested to
                                                                <span>Widthdrawl</span>
                                                            </div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em
                                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">Your <span>Deposit
                                                                    Order</span> is placed</div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">View All</a>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown --> --}}
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle mr-lg-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>{{ substr(Auth::user()->lastname, 0, 1) . substr(Auth::user()->firstname, 0, 1) }}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span
                                                            class="lead-text">{{ Auth::user()->lastname . ' ' . Auth::user()->firstname }}</span>
                                                        <span class="sub-text">{{ Auth::user()->phone }}</span>
                                                    </div>
                                                    <div class="user-action">
                                                        <a class="btn btn-icon mr-n2" href="/pr"><em
                                                                class="icon ni ni-setting"></em></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href=""><em class="icon ni ni-user-alt"></em><span>View
                                                                Profile</span></a></li>
                                                    <li><a href=""><em class="icon ni ni-setting-alt"></em><span>Account
                                                                Setting</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <li><a onclick="event.preventDefault();
                                                            this.closest('form').submit();"><em
                                                                    class="icon ni ni-signout"></em><span>Sign
                                                                    out</span></a></li>
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                    <li class="d-lg-none">
                                        <a href="#" class="toggle nk-quick-nav-icon mr-n1" data-target="sideNav"><em
                                                class="icon ni ni-menu"></em></a>
                                    </li>
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container wide-xl">
                        <div class="nk-content-inner">
                            <div class="nk-aside" data-content="sideNav" data-toggle-overlay="true"
                                data-toggle-screen="lg" data-toggle-body="true">
                                @include('components.navigation-menu')
                                <div class="nk-aside-close">
                                    <a href="#" class="toggle" data-target="sideNav"><em
                                            class="icon ni ni-cross"></em></a>
                                </div><!-- .nk-aside-close -->
                            </div><!-- .nk-aside -->
                            <div class="nk-content-body">
                                <div class="nk-content-wrap">
                                    @yield('content')
                                </div>
                                <!-- footer @s -->
                                <div class="nk-footer">
                                    <div class="container wide-xl">
                                        <div class="nk-footer-wrap g-2">
                                            <div class="nk-footer-copyright"> &copy; 2022 Luna Unversity. <a
                                                    href="https://satif.uz">SATIF</a>
                                            </div>
                                            <div class="nk-footer-links">
                                                <ul class="nav nav-sm">
                                                    <li class="nav-item dropup">
                                                        <a herf="#"
                                                            class="dropdown-toggle dropdown-indicator has-indicator nav-link"
                                                            data-toggle="dropdown"
                                                            data-offset="0,10"><span>{{ Config::get('languages')[App::getLocale()]['display'] }}</span></a>
                                                        <div
                                                            class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="language-list">
                                                                @foreach (Config::get('languages') as $lang => $language)
                                                                    @if ($lang != App::getLocale())
                                                                        <li>
                                                                            <a href="{{ route('lang.switch', $lang) }}"
                                                                                class="language-item">
                                                                                <img src="{{ url('/images/flags/' . $language['flag-icon'] . '.png') }}"
                                                                                    alt="" class="language-flag">
                                                                                <span
                                                                                    class="language-name">{{ $language['display'] }}</span>
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- footer @e -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
        <!-- select region modal -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ url('assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ url('assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="{{ url('assets/js/charts/gd-analytics.js?ver=2.9.1') }}"></script>
    <script src="{{ url('assets/js/libs/jqvmap.js?ver=2.9.1') }}"></script>
    <script src="{{ url('assets/js/libs/datatable-btns.js?ver=2.9.1') }}"></script>
    <script src="{{ url('assets/js/example-toastr.js?ver=2.4.0') }}"></script>
    <!-- select region modal -->

</html>
