@section('title', 'Attendance')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Attendance</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $count }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <form action="{{ route('attendance.show_red', $id) }}" method="get" style="display: contents;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Select date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-calendar-alt"></em>
                                </div>
                                <input type="text" class="form-control date-picker" name="date" value="{{ $date }}"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-note">Date format <code>mm/dd/yyyy</code></div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="align-self: center;">
                        <div class="form-group"><a href="#" class="btn btn-secondary" onclick="event.preventDefault();
                                    this.closest('form').submit();">Search</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card nk-block">

        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <h5 class="title">All Students</h5>
                </div><!-- .card-inner -->
                @if ($students['status'] == true)
                        <form action="{{ route('attendance.update', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input name="attendance_date" type="hidden" value="{{ $date }}">
                    @else
                        <form action="{{ route('attendance.store') }}" method="POST">
                            @csrf
                @endif
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                            <div class="nk-tb-col tb-col-xl"><span class="sub-text">Birthday</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-right">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                        data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                </div>
                            </div>
                        </div><!-- .nk-tb-item -->
                        @foreach ($students['students'] as $data_student)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <a href="{{ route('students.show', $data_student->id) }}">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                                <img src="https://ui-avatars.com/api/?name={{ $data_student->lastname . '+' . $data_student->firstname }}&background=random"
                                                    alt="">
                                            </div>
                                            <div class="user-info">
                                                <span
                                                    class="tb-lead">{{ $data_student->lastname . ' ' . $data_student->firstname }}
                                                </span>
                                                <span>{{ $data_student->phone }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="nk-tb-col tb-col-xl">
                                    <span>{{ $data_student->birthday }}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <input name="attendance[{{ $data_student->id }}]" type="hidden" value="0">
                                                <input name="attendance[{{ $data_student->id }}]" type="checkbox" value="1"
                                                @if ($data_student->mark == 1)
                                                    checked
                                                @endif>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->



                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <input type="hidden" name="group_id" value="{{ $id}}">
                            <input type="hidden" name="attendance_date" value="{{ $date }}">
                            <div class="form-group"><a href="#" class="btn btn-secondary" onclick="event.preventDefault();
                                                        this.closest('form').submit();">Save</a>
                            </div>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
                </form>



            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <script>
        $("#datepicker").datepicker().datepicker("2022-03-09", new Date());

        // $("#datepicker").datepicker().datepicker("03-2022", new Date());
    </script>
    <script>
        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });
    </script>
@endsection
