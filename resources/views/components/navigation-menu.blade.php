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
        @if(Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'teacher' or Auth::user()->getRole() == 'assistant' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-item">
                <a href="{{ route('tasks.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-note-add-fill"></em></span>
                    <span class="nk-menu-text">Tasks</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'teacher' or Auth::user()->getRole() == 'assistant' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{__('dashboard.assessment')}}</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('exams.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.exam')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'teacher' or Auth::user()->getRole() == 'assistant' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{__('dashboard.accounting')}}</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('salary.index_red') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-bar-chart-fill"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.salary')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{__('dashboard.academy')}}</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('students.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.students')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-item">
                <a href="{{ route('teachers.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.teachers')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'teacher' or Auth::user()->getRole() == 'assistant' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-item">
                <a href="{{ route('groups.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.groups')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-item">
                <a href="{{ route('payments.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.payments')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'teacher' or Auth::user()->getRole() == 'assistant' or Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-item">
                <a href="{{ route('attendance.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-calendar-booking"></em></span>
                    <span class="nk-menu-text">{{__('dashboard.attendance')}}</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
        @if (Auth::user()->getRole() == 'superadmin')
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{__('dashboard.settings')}}</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('staff.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                    <span class="nk-menu-text">Staff</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="{{ route('settings.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                    <span class="nk-menu-text">CRM</span>
                </a>
            </li><!-- .nk-menu-item -->
        @endif
    </ul><!-- .nk-menu -->
</div><!-- .nk-sidebar-menu -->
