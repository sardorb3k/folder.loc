@section('title', 'Student Group')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">My Profile</h3>
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
                            <h4 class="nk-block-title">Exams</h4>
                        </div>
                        <div class="nk-block-head-content align-self-start d-lg-none">
                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block card card-bordered">
                    <table class="table table-ulogs">
                        <thead class="thead-light">
                            <tr>
                                <th class="tb-col-os"><span class="overline-title">Group Name</span></th>
                                <th class="tb-col-ip"><span class="overline-title">Teacher</span></th>
                                <th class="tb-col-time"><span class="overline-title">Assistant</span></th>
                                <th class="tb-col-time"><span class="overline-title">Level</span></th>
                                <th class="tb-col-time"><span class="overline-title">Result</span></th>
                                <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $item)
                                <tr>
                                    <td class="tb-col-os">{{ $item->name }}</td>
                                    <td class="tb-col-ip"><span class="sub-text">{{ $item->teacher_id }}</span></td>
                                    <td class="tb-col-time"><span class="sub-text">{{ $item->assistant_id }}</span></td>
                                    <td class="tb-col-time"><span class="sub-text">{{ $item->level }}</span></td>
                                    <td class="tb-col-time"><span class="sub-text"><a href="{{ route('exams.show', $item->group_id) }}">{{ $item->result }}</a></span></td>
                                    <td class="tb-col-action"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .nk-block-head -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
