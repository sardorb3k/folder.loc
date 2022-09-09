@section('title', 'Group Details')
@extends('layouts.app')
@section('content') <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Students Lists</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $count }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="#" data-toggle="modal" data-target="#group-create"
                                        class="dropdown-toggle btn btn-icon btn-primary">
                                        <em class="icon ni ni-plus"></em></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    @include('error')
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <h5 class="title">All Student</h5>
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                            <div class="nk-tb-col tb-col-xl"><span class="sub-text">Exam</span></div>
                            <div class="nk-tb-col tb-col-xl"><span class="sub-text">Birthday</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools text-right">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                        data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
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
                                <div class="nk-tb-col tb-col-mb">
                                    <span
                                        class="tb-status text-{{ $data_student->status == 'active' ? 'success' : 'info' }}">
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
                                                <form action="{{ route('groups.unsubscribe') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value="{{ $data_student->group_id }}">
                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                    <a href="#" onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                        data-toggle="dropdown"><em class="icon ni ni-trash"></em></a>
                                                </form>
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
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <div class="modal fade" role="dialog" id="group-create">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Students list</h5>
                    <form action="{{ route('groups.subscription') }}" method="post">
                        <div class="tab-content">
                            <div class="tab-pane active" id="create">
                                <div class="row gy-4">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="address-county">Student list</label>
                                            <select class="form-select" id="address-county" name="student_id" required data-ui="lg">
                                                @foreach ($unsubscribelist as $item)
                                                    @if ($item->role == 'student')
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->lastname . ' ' . $item->firstname }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                <a href="#" onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                    class="btn btn-lg btn-primary">Add</a>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->

                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->
@endsection
