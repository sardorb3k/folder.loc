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
                            <h4 class="nk-block-title">Attendance</h4>
                            <div class="nk-block-des">
                                <p>You can count the days you are not in school<span class="text-soft"><em
                                            class="icon ni ni-info"></em></span></p>
                                <p style="border-left: 10px solid antiquewhite;"> &nbsp; Absent</p>
                            </div>
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
                                <th class="tb-col-ip"><span class="overline-title">Date</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $item)
                                <tr style="{{ $item->mark == 0 ? 'background:antiquewhite' : '' }}">
                                    <td class="tb-col-os">{{ $item->name }}</td>
                                    <td class="tb-col-ip"><span class="sub-text">{{ $item->attendance_date }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .nk-block-head -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
