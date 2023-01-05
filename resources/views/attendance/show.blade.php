@section('title', 'Attendance')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <nav>
                    <ul class="breadcrumb breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Attendance List</a></li>
                        <li class="breadcrumb-item active">Group Attendance List</li>
                    </ul>
                </nav>
                <h3 class="nk-block-title page-title">Attendance - {{ $group[0]->level }} {{ $group[0]->name }}</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $count }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        <p></p>
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="gy-4">
                <form action="{{ route('attendance.show_red', $id) }}" method="get" style="display: contents;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Select date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-calendar-alt"></em>
                                </div>
                                <input type="text" class="form-control date-picker" name="date"
                                    value="{{ $date }}" data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-note">Date format <code>mm/dd/yyyy</code></div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="align-self: center;">
                        <div class="form-group"><a href="#" class="btn btn-secondary"
                                onclick="event.preventDefault();
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
                <div class="card-inner p-10">
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">#</span>
                                </th>
                                <th class="nk-tb-col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Student</span>
                                </th>
                                <th class="nk-tb-col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Present / Total</span>
                                </th>
                                <th class="nk-tb-col" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Mark</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students['students'] as $student)
                                @if($student->id)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col nk-tb-col-check sorting_1">
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <a href="{{ route('students.show', $student->id) }}">
                                                    <div class="user-card">
                                                        <div class="user-avatar" style="{{ $student->image ? '' : 'background: #798bff;'}}">
                                                            <img src="{{ $student->image ? asset('uploads/student/'.$student->image) : 'https://ui-avatars.com/api/?name='. $student->lastname . '+' . $student->firstname .'&background=random' }}"
                                                                alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $student->firstname }}
                                                            </span>
                                                            <span>{{ $student->lastname }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span>
                                                <span class="badge bg-primary">{{ $student->attendance_a }}</span>
                                                /
                                                <span class="badge bg-primary">{{ $crm_attendance_day }}</span>
                                            </span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input name="attendance[{{ $student->id }}]" type="hidden"
                                                        value="0">
                                                    <div class="custom-control custom-switch">
                                                        <input name="attendance[{{ $student->id }}]" value="1" type="checkbox" @if ($student->mark == 1) checked @endif class="custom-control-input" id="attendanceSwitch{{$student->id}}">
                                                        <label class="custom-control-label" for="attendanceSwitch{{$student->id}}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->

                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <input type="hidden" name="group_id" value="{{ $id }}">
                            <input type="hidden" name="attendance_date" value="{{ $date }}">
                            <div class="form-group"><a href="#" class="btn btn-secondary"
                                    onclick="event.preventDefault();
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
        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });
    </script>
@endsection
