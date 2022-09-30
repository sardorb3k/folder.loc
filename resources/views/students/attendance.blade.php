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
                <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                <span class="sub-text">#</span>
                            </th>
                            <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                <span class="sub-text">Group</span>
                            </th>
                            <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                <span class="sub-text">Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $atten)
                            <tr class="nk-tb-item odd" style="{{ $atten->mark == 0 ? 'background:antiquewhite' : '' }}">
                                <td class="nk-tb-col nk-tb-col-check sorting_1">
                                    <span>{{ $loop->iteration }}</span>
                                </td>
                                <td class="nk-tb-col tb-col-mb">
                                    <span class="text-capitalize">
                                        {{  $atten->level . ' ' . $atten->name }} 
                                    </span>
                                </td>
                                <td class="nk-tb-col tb-col-lg">
                                    <span>{{ $atten->attendance_date }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
