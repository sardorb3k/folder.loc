@section('title', 'Student list')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
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
                            <li><a href="{{ route('students.create') }}" class="btn btn-white btn-outline-light"><em
                                        class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="{{ route('students.create') }}"
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
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                            {{-- <div class="nk-tb-col tb-col-mb"><span class="sub-text">Group</span></div> --}}
                            <div class="nk-tb-col tb-col-xl"><span class="sub-text">Exam</span></div>
                            <div class="nk-tb-col tb-col-xl"><span class="sub-text">Birthday</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
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
                                {{-- <div class="nk-tb-col tb-col-mb">
                                    <span class="tb-amount">580.00 <span class="currency">USD</span></span>
                                </div> --}}
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
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                    data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ route('students.show', $data_student->id) }}"><em
                                                                    class="icon ni ni-focus"></em><span>View</span></a>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('students.edit', $data_student->id) }}"><em
                                                                    class="icon ni ni-repeat"></em><span>Edit</span></a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <form action="{{ route('students.destroy', $data_student->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $data_student->id }}">
                                                            <li><a href="#" onclick="event.preventDefault();
                                                                this.closest('form').submit();"><em
                                                                        class="icon ni ni-na"></em><span>Delete</span></a>
                                                            </li>
                                                        </form>
                                                    </ul>
                                                </div>
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
                            {{ $students->links() }}
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
