@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to Student Dashboard.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-7 col-xxl-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Audience Overview</h6>
                                <p>How have your users, sessions, bounce rate metrics trended.</p>
                            </div>
                            <div class="card-tools shrink-0 d-none d-sm-block">
                                <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                    <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">3 M</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="analytic-ov">
                            <div class="analytic-data-group analytic-ov-group g-3">
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">2.57K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>12.37%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Sessions</div>
                                    <div class="amount">3.98K</div>
                                    <div class="change up"><em class="icon ni ni-arrow-long-up"></em>47.74%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">28.49%</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div>
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">7m 28s</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>0.35%</div>
                                </div>
                            </div>
                            <div class="analytic-ov-ck">
                                <canvas class="analytics-line-large" id="analyticOvData"></canvas>
                            </div>
                            <div class="chart-label-group ms-5">
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label d-none d-sm-block">15 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div>
    </div>
@endsection
