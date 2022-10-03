@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome, {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}!</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-12 col-xxl-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Groups</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Group</span></div>
                            <div class="nk-tb-col"><span>Day</span></div>
                            <div class="nk-tb-col"><span>Lesson Time</span></div>
                            <div class="nk-tb-col"><span>Teacher</span></div>
                            <div class="nk-tb-col"><span>Assistant</span></div>
                        </div>
                        @foreach ($groups as $group)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span class="text-capitalize">{{ $group->level }} {{ $group->name }}</span></div>
                                <div class="nk-tb-col"><span class="text-capitalize badge">{{ $group->days }}</span></div>
                                <div class="nk-tb-col">
                                    <span class="badge">{{ $group->lessonstarttime }}</span>
                                    <span class="badge">{{ $group->lessonendtime }}</span>
                                </div>
                                <div class="nk-tb-col"><span>{{ $group->teacher_fullname }}</span></div>
                                <div class="nk-tb-col"><span>{{ $group->assistant_fullname }}</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Attendance</h6>
                                <p style="border-left: 10px solid antiquewhite;"> &nbsp; Absent</p>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Group</span></div>
                            <div class="nk-tb-col"><span>Date</span></div>
                        </div>
                        @foreach ($attendance as $item)
                            <div class="nk-tb-item" style="{{ $item->mark == 0 ? 'background:antiquewhite' : '' }}">
                                <div class="nk-tb-col"><span class="text-capitalize">{{ $item->level }} {{ $item->name }}</span></div>
                                <div class="nk-tb-col"><span>{{ $item->attendance_date }}</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Exams</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Exam</span></div>
                            <div class="nk-tb-col"><span>Group name</span></div>
                            <div class="nk-tb-col"><span>level</span></div>
                            <div class="nk-tb-col tb-col-sm text-end"><span>Action</span></div>
                        </div>
                        @foreach ($exams as $exam)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span>{{ $exam->exam_type }}</span></div>
                                <div class="nk-tb-col"><span>{{ $exam->group_name }}</span></div>
                                <div class="nk-tb-col"><span>{{ $exam->group_level }}</span></div>
                                <div class="nk-tb-col"><span>{{ $exam->result }}</span></div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
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
                            <div class="nk-tb-col"><span>Group</span></div>
                            <div class="nk-tb-col"><span>Date</span></div>
                            <div class="nk-tb-col tb-col-sm text-end"><span>Amount</span></div>
                        </div>
                        @foreach ($payments as $payment)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span class="text-capitalize">{{ $item->level }} {{ $item->name }}</span></div>
                                <div class="nk-tb-col"><span>{{ $payment->payment_date }}</span></div>
                                <div class="nk-tb-col"><span>{{ $payment->amount }}</span></div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection
