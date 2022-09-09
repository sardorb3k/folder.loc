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
        <div class="row ">
            <div class="col-lg-6">
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
                            <div class="nk-tb-col"><span>Teacher</span></div>
                            <div class="nk-tb-col"><span>Assistant</span></div>
                        </div>
                        @foreach ($groups as $group)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col"><span>{{ $group->name }}</span></div>
                                <div class="nk-tb-col"><span>{{ $group->teacher }}</span></div>
                                <div class="nk-tb-col"><span>{{ $group->assistant }}</span></div>
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
                    <div class="nk-tb-list is-loose">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Exam</span></div>
                            {{-- <div class="nk-tb-col"><span>Date</span></div> --}}
                            <div class="nk-tb-col tb-col-sm text-end"><span>Action</span></div>
                        </div>
                        @if(Auth::user()->midexam)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text"><span class="tb-lead">Final</span></div>
                            </div>
                            {{-- <div class="nk-tb-col">
                                <div class="icon-text"><span class="tb-lead">25-05-2022</span></div>
                            </div> --}}
                            <div class="nk-tb-col tb-col-sm text-end"><span class="tb-sub" style="text-transform: capitalize;">Passed</span></div>
                        </div>
                        @endif
                        @if(Auth::user()->finalexam)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <div class="icon-text"><span class="tb-lead">Final</span></div>
                            </div>
                            {{-- <div class="nk-tb-col">
                                <div class="icon-text"><span class="tb-lead">25-05-2022</span></div>
                            </div> --}}
                            <div class="nk-tb-col tb-col-sm text-end"><span class="tb-sub" style="text-transform: capitalize;">Passed</span></div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection
