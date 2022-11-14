@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('dashboard.welcome') }}, {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}!  @if (Auth::user()->id == 12) ❤️ @endif</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            {{-- Timetable --}}
            <div class="col-lg-12 col-xxl-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.timetable') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner p-10">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer"
                            data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.day') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.time') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-md sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.teacher') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-lg sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.assistant') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $group->level }} {{ $group->name }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="text-capitalize badge">
                                                {{ __('dashboard.' . $group->days) }}
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="badge">{{ $group->lessonstarttime }}</span>
                                            <span class="badge">{{ $group->lessonendtime }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $group->teacher_fullname }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $group->assistant_fullname }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Attendance --}}
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.attendance') }}</h6>
                                <p class="attendance-card-title">
                                    <span class="span-box-success"></span> {{ __('dashboard.present') }} &nbsp;
                                    <span class="span-box-danger"></span> {{ __('dashboard.absent') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <div id="attendanceCalendar">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Exams --}}
            <div class="col-lg-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.exams') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer"
                            data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.exam') }}</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.result') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $exam->exam_type }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $exam->level }} {{ $exam->group_name }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span onclick="checkExam({{ $exam->id }})"
                                                class="text-capitalize badge"
                                                style="background-color: {{ ($exam->result && $exam->result >= 80 && !str_contains(strtolower($exam->level), 'ielts')) 
                                                    || ($exam->result && $exam->result >= 6 && str_contains(strtolower($exam->level), 'junior'))
                                                    || ($exam->result && $exam->result >= 7 && str_contains(strtolower($exam->level), 'senior')) ? '#1ee0ac' : '#e85347' }};color: white;"
                                                data-toggle="modal" data-target="#exam-anw">{{ $exam->result }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Payments --}}
            <div class="col-lg-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.payments') }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer"
                            data-auto-responsive="false" id="DataTables_Table_1"
                            aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group') }}</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                        rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.date') }}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0"
                                        aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.amount') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $payment->group_level }}
                                                {{ $payment->name }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $payment->payment_date }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="payment-amount" id="edit-button">{{ $payment->amount }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div id="attendanceCalendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->

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
                                    <label class="form-label" for="grammar">Grammar</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="exam[grammar]" class="form-control exam-result-input"
                                            id="grammar" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[grammar]') }}">
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
                    <p>Exam result: <span class="badge badge-secondary" id="result">0</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
       
        function checkExam(id) {
            $.ajax({
                url: "/exams/" + id + "/{{ Auth::user()->id }}/getExamId",
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
            $('#exam-anw').modal('show');
        }

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

        $(document).ready(function () {
            // initialize calendar
            const attendance = {!! json_encode($attendance) !!};
            const events = [];
            attendance.forEach(attend => {
                events.push({
                    id: 'attendance-' + attend.id,
                    title: attend.mark == 1 ? "{{ __('dashboard.present') }}" : "{{ __('dashboard.absent') }}",
                    start: attend.attendance_date,
                    className: attend.mark == 1 ? 'fc-event-success' : 'fc-event-danger'
                });
            });

            var calendarEl = document.getElementById('attendanceCalendar');
            var attendanceCalendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'title prev,next',
                    center: null,
                    right: 'today'
                },
                firstDay: 1,
                height: 520,
                nowIndicator: true,
                events: events,
            });
            attendanceCalendar.render();

            if($('.exam-result-input').length > 0) {
                new AutoNumeric.multiple('.exam-result-input', {
                    decimalPlaces: 0,
                    minimumValue: 0,
                    maximumValue: 100,
                    watchExternalChanges: true
                });
                $('#result').text(resultExam());
            }  

            if($('.ielts-exam-result-input').length > 0) {
                new AutoNumeric.multiple('.ielts-exam-result-input', {
                    decimalPlaces: 1,
                    minimumValue: 0,
                    maximumValue: 9,
                    watchExternalChanges: true
                });
                $('#result').text(resultIELTSExam());
            }

            if($('.payment-amount').length > 0) {
                new AutoNumeric('.payment-amount', {
                    decimalPlaces: 0,
                    minimumValue: 0
                });
            }
        });
    </script>
@endsection
