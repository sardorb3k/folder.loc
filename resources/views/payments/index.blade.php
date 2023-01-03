@section('title', 'Payments')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Payments</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of {{ count($students) }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="{{ route('payments.export') }}" class="btn btn-white btn-outline-light">
                                <em class="icon ni ni-download-cloud"></em>
                                <span>Export</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- .nk-block-head-content -->
            @endif
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
                    <span class="sub-text">Student</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Group</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Payment Due</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <a href="{{ route('payments.show_red', $student->id) }}">
                            <div class="user-card">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $student->firstname }}
                                        </span>
                                        <span>{{ $student->lastname }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td class="nk-tb-col">
                        @if($student->group_level)
                            <span class="text-capitalize">
                                {{ $student->group_level }}
                                {{ $student->group_name }}
                            </span>
                        @else
                            <span class="text-danger">Not Assigned</span>
                        @endif
                    </td>
                    <td class="nk-tb-col">
                        <span class="badge bg-primary">
                            {{ date('d M, Y', strtotime($student->payment_end)) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
