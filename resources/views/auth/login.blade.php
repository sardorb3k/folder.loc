@section('title', 'Authentication')
@extends('layouts.guest')
@section('content')
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="html/index.html" class="logo-link">
                <h1 style="font-size: 40px;">Luna unversity</h1>
                <!--img class="logo-light logo-img logo-img-lg" src="./images/logo.png" srcset="./images/logo2x.png 2x"
                    alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="./images/logo-dark.png"
                    srcset="./images/logo-dark2x.png 2x" alt="logo-dark"-->
            </a>
        </div>
        <div class="card card-bordered">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">{{__('auth.sign_in')}}</h4>
                        <div class="nk-block-des">
                            <p>{{__('auth.sign_in_decs')}}</p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">{{__('auth.phone')}}</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="phone" name="phone" value="{{ old('phone') }}"
                                class="form-control form-control-lg" id="default-01"
                                placeholder="{{__('auth.phone_feed')}}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">{{__('auth.passcode')}}</label>
                            @if (Route::has('password.request'))
                                <a class="link link-primary link-sm" href="{{ route('password.request') }}">{{__('auth.forgot_code')}}</a>
                            @endif
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" name="password" value="{{ old('password') }}"
                                class="form-control form-control-lg" id="password" placeholder="{{__('auth.passcode_feed')}}"
                                required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">{{__('auth.signin_submit')}}</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4"> {{__('auth.signin_register_desc')}} <a
                        href="{{ route('register') }}">{{__('auth.signin_register')}}</a>
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
