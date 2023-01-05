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
            <div class="nk-block-head-content">

                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="dropdown" data-bs-toggle="tooltip"
                                data-bs-placement="left" title="come soon">
                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top"
                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light disabled"
                                        data-bs-toggle="dropdown" disabled><em
                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                class="d-none d-md-inline">Last</span> 30 Days</span><em
                                            class="dd-indc icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt "  data-bs-toggle="tooltip"
                            data-bs-placement="left" title="come soon"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" class="btn btn-primary disabled" disabled><em
                                        class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-6">
                <div class="row g-gs">
                    <div class="col-lg-6 col-xxl-12">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Sales Revenue</h6>
                                        <p>amount of the current and next month.</p>
                                    </div>
                                </div>
                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ number_format($amount->amount) }} <span
                                                    class="change down @if ($amount->pres < 0) text-danger
                                            @else
                                            text-success @endif"><em
                                                        class="icon ni @if ($amount->pres < 0) ni-arrow-long-down
                                                    @else
                                                    ni-arrow-long-up @endif"></em>{{ $amount->pres }}%</span></span>
                                            <span class="sub-title">Amount</span>
                                        </div>
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ number_format($user->count) }}<span
                                                    class="change up @if ($user->pres < 0) text-danger
                                            @else
                                            text-success @endif"><em
                                                        class="icon ni @if ($user->pres < 0) ni-arrow-long-down
                                                    @else
                                                    ni-arrow-long-up @endif"></em>{{ $user->pres }}%</span></span>
                                            <span class="sub-title">Users</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Student birthdate</h6>
                                </div>
                            </div>
                        </div>

                        @forelse ($birthdays as $birthday)
                            <div class="card-inner card-inner-md">
                                <div class="user-card">
                                    <div class="user-avatar bg-primary-dim">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span
                                            class="lead-text">{{ $birthday->lastname . ' ' . $birthday->firstname }}</span>
                                        <span class="sub-text">{{ $birthday->phone }}</span>
                                    </div>
                                    <div class="user-action">
                                        <span class="lead-text">{{ $birthday->birthday }}</span>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="card-inner card-inner-md">
                                ...
                            </div>
                        @endforelse
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-lg-6 col-xxl-4">
                <div class="card card-bordered h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Tasks</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div class="timeline">
                            <ul class="timeline-list">

                                @forelse ($tasks as $task)
                                    <li class="timeline-item">
                                        <div class="timeline-status bg-primary is-outline"></div>
                                        <div class="timeline-date">{{ $task->deadline_name }}
                                            @if ($task->board_id == 1)
                                                <em class="icon ni ni-blank-alt"></em>
                                            @endif
                                            @if ($task->board_id == 2)
                                                <em class="icon ni ni-loader"></em>
                                            @endif
                                            @if ($task->board_id == 3)
                                                <em class="icon ni ni-circle"></em>
                                            @endif
                                            @if ($task->board_id == 6)
                                                <em class="icon ni ni-check-circle"></em>
                                            @endif
                                            <div class="timeline-data">
                                                <h6 class="timeline-title">{{ $task->name }}</h6>
                                                <div class="timeline-des">
                                                    <span class="time">{{ $task->deadline_time }}</span>
                                                </div>
                                            </div>
                                    </li>

                                @empty
                                    <li class="timeline-item">
                                        <p>No....</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-6 col-xxl-6">
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
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label d-none d-sm-block">15 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
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
                                                style="background: rgb(156, 171, 255);"></span><span
                                                style="text-transform:capitalize;">{{ $item->title }}</span>
                                        </div>
                                        <div class="amount">{{ $item->result }}</div>
                                    </div>
                                @endforeach
                            </div><!-- .traffic-channel-group -->
                        </div><!-- .traffic-channel -->
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Students who did not attend class</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false"
                            id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">#</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">Student</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">Missed days</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance_n as $attendance)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col nk-tb-col-check sorting_1">
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $attendance->fullname }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $attendance->day }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Payments</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false"
                            id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">#</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">Student</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">Payment Due</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col nk-tb-col-check sorting_1">
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <a href="{{ route('payments.show_red', $payment->userId) }}">
                                                <span class="text-capitalize">{{ $payment->fullname }}</span>
                                            </a>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ date('d M, Y', strtotime($payment->payment_end)) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

        var analyticOvData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            dataUnit: 'People',
            lineTension: .1,
            datasets: [{
                label: "Current Month",
                color: "#c4cefe",
                dash: [5],
                background: "transparent",
                data: [3910, 4420, 4110, 5180, 4400, 5170, 6460, 8830, 5290, 5430, 4690, 4350]
            }, {
                label: "Current Month",
                color: "#798bff",
                dash: 0,
                background: NioApp.hexRGB('#798bff', .15),
                data: [4110, 4220, 4810, 5480, 4600, 5670, 6660, 4830, 5590, 5730, 4790, 4950]
            }]
        };
    </script>
@endsection
