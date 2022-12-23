<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <base href="{{ url('/') }}">
    <meta charset="utf-8">
    <meta name="author" content="Sardor Sattorov">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Rexar Academy. LMS panel">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>@yield('title') - {{ config('app.name', 'Rexar Academy') }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.1') }}">
    <script src="{{ asset('assets/js/autonumeric.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('js/libs/selectize.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/selectize.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <script src="{{ asset('js/libs/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/nano.pickr.css') }}">
    <script src="{{ asset('js/libs/pickr.min.js') }}"></script>
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.1') }}">
    @livewireStyles
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">

                            <img class="logo-light logo-img" src="./images/rexar-logo.png" srcset="./images/rexar-logo.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="./images/rexar-logo.png" srcset="./images/rexar-logo.png 2x" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        @include('components.navigation-menu')
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->

            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo-rexar-white.png" srcset="./images/logo-rexar-white.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-rexar-white.png" srcset="./images/logo-rexar-white.png 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                {{-- <div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                            <p>Do you know the latest update of 2022? <span> A overview of our is now available on YouTube</span></p>
                                            <em class="icon ni ni-external"></em>
                                        </div>
                                    </a>
                                </div> --}}
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <img class="icon"
                                                    src="./images/flags/{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}.png"
                                                    alt="{{ Config::get('languages')[App::getLocale()]['display'] }}">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
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
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">{{ Auth::user()->role }}</div>
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->lastname . ' ' . Auth::user()->firstname }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar sm"
                                                        style="{{ Auth::user()->image == null ? 'background: #798bff;' : '' }}">
                                                        @if (Auth::user()->image != null)
                                                            <img src="{{ asset('uploads/' . Auth::user()->role . '/' . Auth::user()->image) }}"
                                                                alt="{{ Auth::user()->firstname }}">
                                                        @else
                                                            <em class='icon ni ni-user'></em>
                                                        @endif
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->lastname . ' ' . Auth::user()->firstname }}</span>
                                                        <span class="sub-text">{{ Auth::user()->phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('profile.show') }}"><em class="icon ni ni-setting-alt"></em><span>{{ __('dashboard.account_settings') }}</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <li><a
                                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                                <em class="icon ni ni-signout"></em>
                                                                <span>{{ __('dashboard.sign_out') }}</span>
                                                            </a>
                                                        </li>
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- main @e -->
        <!-- select region modal -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script>
        var darkM = localStorage.getItem("darkMode");
        var body = document.body;
        if (darkM) {
            body.classList.add('dark-mode');
        } else {
            body.classList.remove('dark-mode');
        }

        function DarkMode() {
            var darkM = localStorage.getItem("darkMode");
            var body = document.body;
            if (darkM) {
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
            }
            localStorage.getItem("darkMode", false);
            console.log(darkM)
        }
    </script>
    <script src="{{ asset('assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-analytics.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/libs/jqvmap.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/example-toastr.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/apps/calendar.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jkanban.js') }}"></script>
    <script src="{{ asset('assets/js/apps/kanban.js') }}"></script>
    <!-- select region modal -->

</html>
