@section('title', 'Attendance')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Attendance</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of {{ $count }} groups.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
        <thead>
            <tr class="nk-tb-item nk-tb-head">
                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">#</span>
                </th>
                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Group</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Teacher</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Assistant</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Days</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Time</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <a href="{{ route('attendance.show_red', $group->id) }}">
                            <span class="text-capitalize">{{ $group->level }}
                                {{ $group->name }}</span>
                        </a>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <div class="user-card">
                            <div class="user-card">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $group->teacher_firstname }}
                                    </span>
                                    <span>{{ $group->teacher_lastname }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <div class="user-card">
                            <div class="user-card">
                                <div class="user-info">
                                    <span class="tb-lead">{{ $group->assistant_firstname }}
                                    </span>
                                    <span>{{ $group->assistant_lastname }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span class="badge text-capitalize">
                            {{ $group->days }}
                        </span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span class="badge">{{ $group->lessonstarttime }}</span>
                        <span class="badge">{{ $group->lessonendtime }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
