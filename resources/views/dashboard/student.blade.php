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
                                            <span class="text-capitalize">{{ $exam->group_level }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span onclick="editPayment({{ $exam->id }})"
                                                class="text-capitalize badge"
                                                style="background-color: {{ $exam->result && $exam->result >= 80 ? '#1ee0ac' : '#e85347' }};color: white;"
                                                data-toggle="modal" data-target="#exam-anw">{{ $exam->result }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                            <span class="text-capitalize">{{ $payment->level }}
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
       
        // button click event modal open and data set
        function editPayment(id) {
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
                    $('#result').text(resultExam());
                }
            });
            $('#exam-anw').modal('show');
        }

        function resultExam() {
            var sum = 0;
            var result = 0;
            $('.col-sm-4 input').each(function() {
                if (this.id != 'team') {
                    sum += Number($(this).val());
                }
                if (this.id == 'team') {
                    result = sum / 5 + Number($(this).val());
                }
            });
            return result;
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

            new AutoNumeric.multiple('.exam-result-input', {
                decimalPlaces: 0,
                minimumValue: 0,
                maximumValue: 100,
                watchExternalChanges: true
            });

            if($('.payment-amount').length > 0) {
                new AutoNumeric('.payment-amount', {
                    decimalPlaces: 0,
                    minimumValue: 0
                });
            }
            
            $(".col-sm-4").on("input", function() {
                $("#result").text(resultExam());
            });
            $('#result').text(resultExam());
        });
    </script>
@endsection
