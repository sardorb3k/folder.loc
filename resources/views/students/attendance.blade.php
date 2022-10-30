@section('title', 'Student Group')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students List</a></li>
                    <li class="breadcrumb-item active">Student Profile</li>
                </ul>
            </nav>
            <h3 class="nk-block-title page-title">{{ $student->lastname . ' ' . $student->firstname }}</h3>
            <div class="nk-block-des">
                <p>You have full control to manage your own account setting.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            @include('students.navigation-menu', ['id' => $id])
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h6 class="title">{{ __('dashboard.attendance') }}</h6>
                            <p class="attendance-card-title">
                                <span class="span-box-success"></span> {{ __('dashboard.present') }} &nbsp;
                                <span class="span-box-danger"></span> {{ __('dashboard.absent') }}
                            </p>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="card-inner">
                    <div id="attendanceCalendar">
                    </div>
                </div>
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->

    <script>
         $(document).ready(function () {
            // initialize calendar
            const attendance = {!! json_encode($attendance) !!};
            const events = [];
            attendance.forEach(attend => {
                events.push({
                    id: 'attendance-' + attend.id,
                    title: attend.mark == 1 ? "{{ __('dashboard.present') }}" : "{{ __('dashboard.absent') }}",
                    start: attend.attendance_date,
                    className: attend.mark == 1 ? 'fc-event-success' : 'fc-event-danger',
                });
            });

            var calendarElement = document.getElementById('attendanceCalendar');
            var attendanceCalendar = new FullCalendar.Calendar(calendarElement, {
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
        });
    </script>
@endsection
