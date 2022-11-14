@section('title', 'Exam')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <nav>
                    <ul class="breadcrumb breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exams List</a></li>
                        <li class="breadcrumb-item active">Group Exam Details</li>
                    </ul>
                </nav>
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
                                <p>Group name: <span class="badge badge-primary">{{ $exam->group_name }}</span></p>
                                <p>Level: <span class="badge badge-secondary">{{ strtoupper($exam->level) }}</span>
                                </p>
                                <p>Exam type: <span class="badge badge-secondary">{{ strtoupper($exam->exam_type) }}</span>
                                </p>
                                <p>Date: <span class="badge badge-secondary">{{ $exam->created_at }}</span></p>
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
                <div class="card-inner p-10">
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false"
                        id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1">
                                    <span class="sub-text">#</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1">
                                    <span class="sub-text">Student</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1">
                                    <span class="sub-text">Birthday</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                    rowspan="1" colspan="1">
                                    <span class="sub-text">Result</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="nk-tb-item odd">
                                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <div class="user-card">
                                            <a href="{{ route('students.show', $student->id) }}">
                                                <div class="user-card">
                                                    <div class="user-avatar"
                                                        style="{{ $student->image ? '' : 'background: #798bff;' }}">
                                                        <img src="{{ $student->image ? asset('uploads/student/' . $student->image) : 'https://ui-avatars.com/api/?name=' . $student->lastname . '+' . $student->firstname . '&background=random' }}"
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
                                    <td class="nk-tb-col tb-col-lg">
                                        <span>{{ $student->birthday }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <button
                                            class="btn btn-{{ ($student->result && $student->result >= 80) 
                                            || ($student->result && $student->result >= 6 && str_contains(strtolower($exam->level), 'junior'))
                                            || ($student->result && $student->result >= 7 && str_contains(strtolower($exam->level), 'senior')) 
                                            ? 'success' : 'danger' }}"
                                            id="edit-button" value="{{ $student->id }}-{{ $exam->id }}"
                                            data-toggle="modal"
                                            data-target="#exam-anw">{{ $student->result ? $student->result : '0' }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="exam-anw">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Exam</h5>
                </div>
                <div class="modal-body">
                    @if(str_contains(strtolower($exam->level), 'ielts'))
                        <div class="row gy-4" id="exam-data">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="listening">Listening</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[listening]" class="form-control ielts-exam-result-input"
                                            id="listening" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[listening]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="reading">Reading</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[reading]" class="form-control ielts-exam-result-input"
                                            id="reading" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[reading]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="writing">Writing</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[writing]" class="form-control ielts-exam-result-input"
                                            id="writing" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[writing]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="speaking">Speaking</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[speaking]" class="form-control ielts-exam-result-input"
                                            id="speaking" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[speaking]') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="row gy-4" id="exam-data">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="listening">Listening</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[listening]" class="form-control exam-result-input"
                                            id="listening" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[listening]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="grammar">Grammar</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[grammar]" class="form-control exam-result-input"
                                            id="grammar" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[grammar]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="reading">Reading</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[reading]" class="form-control exam-result-input"
                                            id="reading" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[reading]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="writing">Writing</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[writing]" class="form-control exam-result-input"
                                            id="writing" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[writing]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="speaking">Speaking</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[speaking]" class="form-control exam-result-input"
                                            id="speaking" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[speaking]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label" for="team">Team</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[team]" class="form-control exam-result-input"
                                            id="team" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[team]') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="exam_id" id="exam_id">
                    <p>Exam result: <span class="badge badge-secondary" id="result"></span></p>
                    @if (Auth::user()->role == 'superadmin')
                        <span class="sub-text"><button type="button" id="exam-save" class="btn btn-primary">Submit</button></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        if($('.exam-result-input').length > 0) {
            new AutoNumeric.multiple('.exam-result-input', {
                decimalPlaces: 0,
                minimumValue: 0,
                maximumValue: 100,
                watchExternalChanges: true
            });
        }  

        if($('.ielts-exam-result-input').length > 0) {
            new AutoNumeric.multiple('.ielts-exam-result-input', {
                decimalPlaces: 1,
                minimumValue: 0,
                maximumValue: 9,
                watchExternalChanges: true
            });
        }

        $('body').on('click', '#edit-button', function() {
            var link_id = $(this).val();
            var link_id = link_id.split('-');
            var student_id = link_id[0];
            var exam_id = link_id[1];
            $.ajax({
                url: "/exams/" + exam_id + "/" + student_id + "/getExamId",
                type: "GET",
                success: function(data) {
                    if (data != null) {
                        $('#listening').val(data.listening);
                        $('#reading').val(data.reading);
                        $('#writing').val(data.writing);
                        $('#speaking').val(data.speaking);
                        $('#grammar').val(data.grammar);
                        $('#team').val(data.team);
                        $('#student_id').val(student_id);
                        $('#exam_id').val(exam_id);
                    } else {
                        $('#listening').val(0);
                        $('#reading').val(0);
                        $('#writing').val(0);
                        $('#speaking').val(0);
                        $('#grammar').val(0);
                        $('#team').val(0);
                        $('#student_id').val(student_id);
                        $('#exam_id').val(exam_id);
                    }
                    $('.exam-result-input').length > 0 ? $('#result').text(resultExam()) : $('#result').text(resultIELTSExam());
                }
            });
        });

        @if (Auth::user()->role == 'superadmin')
            $("#exam-save").click(function(e) {
                e.preventDefault();
                // Backend Validation
                var listening = $('#listening').val();
                var reading = $('#reading').val();
                var writing = $('#writing').val();
                var speaking = $('#speaking').val();
                var grammar = $('#grammar').val();
                var team = $('#team').val();
                var student_id = $('#student_id').val();
                var exam_id = $('#exam_id').val();
                var result = $('#result').text();
                $.ajax({
                    url: "/exams/" + exam_id + "/" + student_id + "/getExamId",
                    type: "POST",
                    data: {
                        mark: {
                            listening: listening == '' ? 0 : listening,
                            reading: reading == '' ? 0 : reading,
                            writing: writing == '' ? 0 : writing,
                            speaking: speaking == '' ? 0 : speaking,
                            grammar: grammar == '' ? 0 : grammar,
                            team: team == '' ? 0 : team,
                        },
                        result: result,
                        student_id: student_id,
                        exam_id: exam_id,
                    },
                    success: function(data) {
                        $('#exam-anw').modal('hide');
                        $('#result').text(0);
                        // reset form
                        window.location.reload();
                    }
                });
            });
        @endif

        $(".exam-result-input").on("input", function() {
            $("#result").text(resultExam());
        });

        $(".ielts-exam-result-input").on("input", function() {
            $("#result").text(resultIELTSExam());
        });

        function resultIELTSExam() {
            var inputs = $('.ielts-exam-result-input').length;
            var sum = 0;
            $('.ielts-exam-result-input').each(function() {
                res = parseFloat($(this).val());
                if(!isNaN(res)) {
                    sum += res;
                }
            });
            var result = ((sum / 4).toFixed(2)).toString().split('.');
            var decimal = result[1];
            if((decimal >= 25 && decimal <= 50) || (decimal > 50 && decimal < 75)) {
                return result[0] + '.5';
            } else if(decimal < 25) {
                return result[0] + '.0';
            } else if(decimal >= 75) {
                return parseInt(result[0]) + 1 + '.0';
            }
        }

        function resultExam() {
            var inputs = $('.exam-result-input').length;
            var sum = 0;
            $('.exam-result-input').each(function() {
                res = parseInt($(this).val());
                if(!isNaN(res)) {
                    if (this.id != 'team') {
                        sum += res;
                    }
                    if (this.id == 'team') {
                        result = sum / 5 + res;
                    }
                }
            });
            return result > 100 ? 100 : Math.ceil(result);
        }
    </script>
@endsection
