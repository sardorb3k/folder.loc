@section('title', 'Exam')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title" style="margin-bottom: 1rem">Exam</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        <div class="card nk-block">
            <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <span class="preview-title overline-title">Group information</span>
                            <div class="nk-block-des text-soft">
                                <p>Group name: <span class="badge badge-primary">{{ $group[0]->name }}</span></p>
                                <p>Level: <span class="badge badge-secondary">{{ strtoupper($group[0]->level) }}</span>
                                </p>
                                <p>Teacher: <span class="badge badge-secondary">{{ $group[0]->teacher_id }}</span></p>
                                <p>Assistant: <span class="badge badge-secondary">{{ $group[0]->assistant_id }}</span></p>
                                <hr>
                                <p>Exam type: <span class="badge badge-secondary">{{ strtoupper($exam_type) }}</span></p>
                                <p>Date: <span class="badge badge-secondary">{{ date('Y-M-d -- D') }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('error')
        @if ($errors->any())
            <div class="example-alert">
                <div class="alert alert-pro alert-danger">
                    <div class="alert-text">
                        <h6>Whoops! <strong>There were some problems with your input.</strong></h6>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div><!-- .nk-block-head -->
    <div class="card nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <h5 class="title">All Students</h5>
                    <p>Number of students in the group: <span class="badge badge-secondary">{{ $count }}</span></p>
                </div><!-- .card-inner -->
                <form action="{{ route('exams.store') }}" method="POST">
                    @csrf
                    <div class="card-inner p-0">
                        <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                <div class="nk-tb-col tb-col-xl"><span class="sub-text">Birthday</span></div>
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                <div class="nk-tb-col"><span class="sub-text">A/N</span></div>
                            </div><!-- .nk-tb-item -->
                            @foreach ($students as $data_student)
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
                                    <div class="nk-tb-col tb-col-md">
                                        <span
                                            class="tb-status text-{{ $data_student->status == 'active' ? 'success' : 'info' }}">
                                            @if ($data_student->status == 'active')
                                                Active
                                            @else
                                                Completed
                                            @endif
                                        </span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <li>
                                            <div class="drodown">
                                                <input name="students[{{ $data_student->id }}]" type="hidden" value="0">
                                                <input name="students[{{ $data_student->id }}]" type="checkbox" value="1">
                                            </div>
                                        </li>
                                    </div>
                                </div><!-- .nk-tb-item -->
                            @endforeach
                        </div><!-- .nk-tb-list -->
                    </div><!-- .card-inner -->

                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                <div class="row gy-4">
                                    <div class="col-sm-6" style="align-self: center;">
                                        <input type="hidden" name="group_id" value="{{ $group[0]->id }}">
                                        <input type="hidden" name="exam_type" value="{{ $exam_type }}">
                                        <input type="hidden" name="level" value="{{ $group[0]->level }}">
                                        <div class="form-group"><a href="#" class="btn btn-secondary" onclick="event.preventDefault();
                                                            this.closest('form').submit();">Save</a>
                                        </div>
                                    </div>
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
