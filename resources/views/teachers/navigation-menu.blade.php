<ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('teachers/*/') ? 'active' : '' }}" href="{{ route('teachers.show', $id) }}"><em
                class="icon ni ni-user-fill-c"></em><span>Personal</span></a>
    </li>
</ul><!-- .nav-tabs -->
