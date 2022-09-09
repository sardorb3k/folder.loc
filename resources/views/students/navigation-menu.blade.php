<ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students.show', $id) }}"><em
                class="icon ni ni-user-fill-c"></em><span>Personal</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students.group', $id) }}"><em
                class="icon ni ni-bell-fill"></em><span>Group</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students.attendance', $id) }}"><em
                class="icon ni ni-bell-fill"></em><span>Attendance</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students.exam', $id) }}"><em
                class="icon ni ni-bell-fill"></em><span>Exams</span></a>
    </li>
</ul><!-- .nav-tabs -->
