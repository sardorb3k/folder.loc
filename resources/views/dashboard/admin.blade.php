@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('dashboard.welcome') }}, {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
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
                                <p>What is the trend of your students, teachers, indicators.</p>
                            </div>
                            {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                    <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">3 M</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="analytic-ov">
                            <div class="analytic-data-group analytic-ov-group g-3">
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Students</div>
                                    <div class="amount">{{ $audience_student_count[0]->count }}</div>
                                    {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>12.37%</div> --}}
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Teacher</div>
                                    <div class="amount">{{ $audience_teacher_count[0]->count }}</div>
                                    {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>47.74%</div> --}}
                                </div>
                                <div class="analytic-data analytic-ov-data">
                                    <div class="title">Group</div>
                                    <div class="amount">{{ $audience_group_count[0]->count }}</div>
                                    {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div> --}}
                                </div>
                                {{-- <div class="analytic-data analytic-ov-data">
                                    <div class="title">Users</div>
                                    <div class="amount">7m 28s</div>
                                    <div class="change down"><em class="icon ni ni-arrow-long-down"></em>0.35%</div>
                                </div> --}}
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
            <div class="col-md-5 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Students who did not attend class</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>User</span></div>
                            <div class="nk-tb-col tb-col-sm text-end"><span>Day</span></div>
                        </div><!-- .nk-tb-head -->
                        @foreach ($attendance_n as $item)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-sub">{{ $item->fullname }}</span>
                                </div>
                                <div class="nk-tb-col text-end">
                                    <span class="tb-sub tb-amount">{{ $item->day }}</span>
                                </div>
                            </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                </div><!-- .card -->
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Traffic Channel</h6>
                            </div>
                            <div class="card-tools">
                                {{-- <div class="drodown">
                                    <a href="#"
                                        class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white"
                                        data-bs-toggle="dropdown">30 Days</a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>7 Days</span></a></li>
                                            <li><a href="#"><span>15 Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="traffic-channel">
                            <div class="traffic-channel-doughnut-ck">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas class="analytics-doughnut chartjs-render-monitor" id="TrafficChannelDoughnutData"
                                    style="display: block; width: 360px; height: 160px;" width="360"
                                    height="160"></canvas>
                            </div>
                            <div class="traffic-channel-group g-2">
                                @foreach ($student_hear as $item)
                                    <div class="traffic-channel-data">
                                        <div class="title"><span class="dot dot-lg sq" data-bg="#9cabff"
                                                style="background: rgb(156, 171, 255);"></span><span style="text-transform:capitalize;">{{ $item->title }}</span>
                                        </div>
                                        <div class="amount">{{ $item->result }}</div>
                                    </div>
                                @endforeach
                            </div><!-- .traffic-channel-group -->
                        </div><!-- .traffic-channel -->
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-md-5 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Payments</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>User</span></div>
                            <div class="nk-tb-col tb-col-sm text-end"><span>Day</span></div>
                        </div><!-- .nk-tb-head -->
                        @foreach ($payments as $payment_item)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-sub">{{ $payment_item->fullname }}</span>
                                </div>
                                <div class="nk-tb-col text-end">
                                    <span class="tb-sub tb-amount">{{ $payment_item->payment_end }}</span>
                                </div>
                            </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                </div><!-- .card -->
            </div>
        </div>
    </div>
    {{-- {{ $student_hear }} --}}
    <script>
        var TrafficChannelDoughnutData = {
            labels: [
                @foreach ($student_hear as $item_student)
                    "{{ $item_student->title }}",
                @endforeach
            ],
            dataUnit: 'relatives',
            legend: false,
            datasets: [{
                borderColor: "#fff",
                background: ["#798bff", "#b8acff", "#ffa9ce", "#f9db7b", "#9cabff", "#ff9a9e", "#f6f5f7",
                    "#a3d2ca"
                ],
                data: [
                    @foreach ($student_hear as $item_student)
                        {{ $item_student->result }},
                    @endforeach
                ]
            }]
        };
    </script>
@endsection
