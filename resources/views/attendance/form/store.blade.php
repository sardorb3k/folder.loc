<form action="{{ route('attendance.store') }}" method="POST">
    @csrf
    <div class="card-inner p-0">
        <div class="nk-tb-list nk-tb-ulist">
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span class="sub-text">User</span></div>
                <div class="nk-tb-col tb-col-mb"><span class="sub-text">Group</span></div>
                <div class="nk-tb-col tb-col-xl"><span class="sub-text">Exam</span></div>
                <div class="nk-tb-col tb-col-xl"><span class="sub-text">Birthday</span></div>
                <div class="nk-tb-col tb-col-md"><span class="sub-text">Status  </span></div>
                <div class="nk-tb-col nk-tb-col-tools text-right">
                    <div class="dropdown">
                        <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-toggle="dropdown"
                            data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                    </div>
                </div>
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
                    <div class="nk-tb-col tb-col-mb">
                        <span class="tb-amount">580.00 <span class="currency">USD</span></span>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <ul class="list-status">
                            <li><em class="icon text-success ni ni-check-circle"></em> <span>Med</span>
                            </li>
                            <li><em class="icon text-info ni ni-alarm-alt"></em> <span>Final</span></li>
                        </ul>
                    </div>
                    <div class="nk-tb-col tb-col-xl">
                        <span>{{ $data_student->birthday }}</span>
                    </div>
                    <div class="nk-tb-col tb-col-md">
                        <span class="tb-status text-{{ $data_student->status == 'active' ? 'success' : 'info' }}">
                            @if ($data_student->status == 'active')
                                Active
                            @else
                                Completed
                            @endif
                        </span>
                    </div>
                    <div class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <input type="checkbox" name="attendance[][{{ $data_student->id }}]"
                                        class="custom-control custom-checkbox">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .nk-tb-item -->
            @endforeach
        </div><!-- .nk-tb-list -->
    </div><!-- .card-inner -->



    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            <div class="g">
                <input type="hidden" name="group_id" value="{{ $group_id }}">
                <div class="form-group"><a href="#" class="btn btn-secondary" onclick="event.preventDefault();
                                this.closest('form').submit();">Save</a>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .card-inner -->
</form>
