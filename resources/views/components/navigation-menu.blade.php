<div class="nk-sidebar-menu" data-simplebar>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Dashboards</h6>
        </li><!-- .nk-menu-heading -->
        <li class="nk-menu-item">
            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                <span class="nk-menu-text">Dashboard</span>
            </a>
        </li><!-- .nk-menu-item -->
        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Assessment</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('exams.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                    <span class="nk-menu-text">Exam</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Accounting</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('salary.index_red') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-bar-chart-fill"></em></span>
                    <span class="nk-menu-text">Salary</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Academy</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('students.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                    <span class="nk-menu-text">Students</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin")
            <li class="nk-menu-item">
                <a href="{{ route('teachers.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                    <span class="nk-menu-text">Teachers</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
            <li class="nk-menu-item">
                <a href="{{ route('groups.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                    <span class="nk-menu-text">Groups</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin")
            <li class="nk-menu-item">
                <a href="{{ route('payments.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                    <span class="nk-menu-text">Payments</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->role == "admin" || Auth::user()->role == "teacher")
            <li class="nk-menu-item">
                <a href="{{ route('attendance.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking"></em></span>
                    <span class="nk-menu-text">Attendance</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
    </ul><!-- .nk-menu -->
</div><!-- .nk-sidebar-menu -->
