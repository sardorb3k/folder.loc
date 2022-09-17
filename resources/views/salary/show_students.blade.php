@section('title', 'Salary')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Salary</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Students</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
            @if ($formStatus)
                <form action="{{ route('salary.store', $id) }}" class="form-validate" novalidate="novalidate"
                    method="post">
                    @csrf
            @else
                <form action="{{ route('salary.update', $id) }}" class="form-validate" novalidate="novalidate"
                    method="POST">
                    @csrf
                    @method('PUT')
            @endif
                    <div class="card-inner p-0">
                        <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                <div class="nk-tb-col tb-col-xl"><span class="sub-text">Attendance</span></div>
                                <div class="nk-tb-col tb-col-xl"><span class="sub-text">Payment</span></div>
                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></div>
                            </div><!-- .nk-tb-item -->
                            @foreach ($students as $data_student)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <a href="{{ route('students.show', $data_student->id) }}">
                                            <div class="user-card">
                                                <div class="user-avatar" style="{{ $data_student->image ? '' : 'background: #798bff;'}}">
                                                    <img src="{{ $data_student->image ? asset('uploads/students/'.$data_student->image) : 'https://ui-avatars.com/api/?name='. $data_student->lastname . '+' . $data_student->firstname .'&background=random' }}"
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
                                        <span>
                                            <span class="badge badge-outline-primary">{{ $data_student->att_ap }}</span> /
                                            <span class="badge badge-outline-primary">{{ $crm_attendance_day }}</span></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-xl">
                                        <span>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $data_student->payment }}" disabled>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="nk-tb-col tb-col-mb">
                                        <span>
                                            <div class="form-control-wrap">
                                                <input type="text" name="amount[{{ $data_student->id }}]"
                                                    value="{{ $data_student->amount }}" class="form-control">
                                            </div>
                                        </span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                            @endforeach
                        </div><!-- .nk-tb-list -->
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                <input type="hidden" name="group_id" value="{{ $id }}">
                                <input name="salarydate" type="hidden" value="{{ $date }}">
                                <input name="teacher_id" type="hidden" value="{{ $teacher_id }}">
                                <div class="form-group">
                                    <a href="#" class="btn btn-secondary"
                                        onclick="event.preventDefault();this.closest('form').submit();">Save</a>
                                </div>
                            </div>
                        </div><!-- .nk-block-between -->
                    </div>
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
