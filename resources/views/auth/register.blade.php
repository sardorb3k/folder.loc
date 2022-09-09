@section('title', 'Authentication')
@extends('layouts.guest')
@section('content')

    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="html/index.html" class="logo-link">
                <h1 style="font-size: 40px;">Luna unversity</h1>
            </a>
        </div>
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">{{ __('auth.register') }}</h4>
                        <div class="nk-block-des">
                            <p>Create New Luna Account</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="fistname">{{ __('auth.register_fistname') }}</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="fistname" name="firstname"
                                value="{{ old('fistname') }}" placeholder="{{ __('auth.register_fistname_feed') }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lastname">{{ __('auth.register_lastname') }}</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="lastname" name="lastname"
                                value="{{ old('lastname') }}" placeholder="{{ __('auth.register_lastname_feed') }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">{{ __('auth.register_phone') }}</label>
                        <div class="form-control-wrap">
                            <input type="phone" class="form-control form-control-lg" size="20" minlength="9" maxlength="14"
                                id="phone" name="phone" value="{{ old('phone') }}"
                                placeholder="{{ __('auth.register_phone_feed') }}" required autocomplete="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">{{ __('auth.register_passcode') }}</label>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" type="password"
                                name="password" placeholder="{{ __('auth.register_passcode_feed') }}" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">{{ __('auth.register_confirm') }}</label>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                data-target="password_confirmation">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation"
                                type="password" name="password_confirmation"
                                placeholder="{{ __('auth.register_confirm_feed') }}" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">{{ __('auth.register_submit') }}</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> {{ __('auth.register_login_desc') }} <a
                        href="{{ route('login') }}"><strong>{{ __('auth.register_signin') }}</strong></a>
                </div>
                @if ($errors->any())
                    <div class="example-alert">
                        <div class="alert alert-primary alert-icon">
                            <em class="icon ni ni-alert-circle"></em>
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="nk-footer nk-auth-footer-full">
        <div class="container wide-lg">
            <div class="row g-3">
                <div class="col-lg-6 order-lg-last">
                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                        <!--li class="nav-item">
                                <a class="nav-link" href="#">Terms & Condition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li -->
                        <li class="nav-item dropup">
                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown"
                                data-offset="0,10"><span>{{ Config::get('languages')[App::getLocale()]['display'] }}</span></a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="language-list">
                                    @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                            <li>
                                                <a href="{{ route('lang.switch', $lang) }}" class="language-item">
                                                    <img src="{{ url('/images/flags/' . $language['flag-icon'] . '.png') }}"
                                                        alt="" class="language-flag">
                                                    <span class="language-name">{{ $language['display'] }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="nk-block-content text-center text-lg-left">
                        <p class="text-soft">&copy; 2022 {{ __('dashboard.footer') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
