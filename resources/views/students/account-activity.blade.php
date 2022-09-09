@section('title', 'Account Activity')
@php
function user_braw($user_agent)
{
    if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
        $bname = 'Internet Explorer';
        $ub = 'MSIE';
    } elseif (preg_match('/Firefox/i', $user_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = 'Firefox';
    } elseif (preg_match('/Chrome/i', $user_agent)) {
        $bname = 'Google Chrome';
        $ub = 'Chrome';
    } elseif (preg_match('/Safari/i', $user_agent)) {
        $bname = 'Apple Safari';
        $ub = 'Safari';
    } elseif (preg_match('/Opera/i', $user_agent)) {
        $bname = 'Opera';
        $ub = 'Opera';
    } elseif (preg_match('/Netscape/i', $user_agent)) {
        $bname = 'Netscape';
        $ub = 'Netscape';
    }
    return $ub;
}
function user_os($user_agent)
{
    if (preg_match('/linux/i', $user_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
        $platform = 'Mac';
    } elseif (preg_match('/windows|win32/i', $user_agent)) {
        $platform = 'windows';
    }
    return $platform;
}
@endphp
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">My Profile</h3>
            <div class="nk-block-des">
                <p>You have full control to manage your own account setting.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            @include('students.navigation-menu', ['id' => $user->id])
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Login Activity</h4>
                            <div class="nk-block-des">
                                <p>Here is your last {{ $data_sessions }} login activities log. <span class="text-soft"><em
                                            class="icon ni ni-info"></em></span></p>
                            </div>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block card card-bordered">
                    <table class="table table-ulogs">
                        <thead class="thead-light">
                            <tr>
                                <th class="tb-col-os"><span class="overline-title">Browser <span
                                            class="d-sm-none">/ IP</span></span></th>
                                <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $item)
                                <tr>
                                    <td class="tb-col-os">{{ user_os($item->user_agent) }} on {{ user_braw($item->user_agent) }}</td>
                                    <td class="tb-col-ip"><span class="sub-text">{{ $item->ip_address }}</span></td>
                                    <td class="tb-col-time"><span class="sub-text">{{ date("M d, Y", $item->last_activity) }} <span
                                        class="d-none d-sm-inline-block">{{ date("g:i A", $item->last_activity) }}</span></span></td>
                                    <td class="tb-col-action"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .nk-block-head -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
