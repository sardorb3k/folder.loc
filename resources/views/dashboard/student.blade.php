@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('dashboard.welcome')}}, {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}!</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-lg-12 col-xxl-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.timetable')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner p-10">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.day')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.time')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.teacher')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.assistant')}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $group->level }} {{ $group->name }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="text-capitalize badge">
                                                {{ __('dashboard.'. $group->days)}}
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="badge">{{ $group->lessonstarttime }}</span>
                                            <span class="badge">{{ $group->lessonendtime }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $group->teacher_fullname }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $group->assistant_fullname }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.attendance')}}</h6>
                                <p style="border-left: 10px solid antiquewhite;"> &nbsp; {{ __('dashboard.absent')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner p-10">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.date')}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $item)
                                    <tr class="nk-tb-item odd" style="{{ $item->mark == 0 ? 'background:antiquewhite' : '' }}">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $group->level }} {{ $group->name }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $item->attendance_date }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.exams')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.exam')}}</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.result')}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $exam->exam_type }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $exam->level }} {{ $exam->name }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $exam->result }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-bordered h-100">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">{{ __('dashboard.payments')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <table class="datatable-init-nohelpers nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.group')}}</span>
                                    </th>
                                    <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.date')}}</span>
                                    </th>
                                    <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                        <span class="sub-text">{{ __('dashboard.amount')}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr class="nk-tb-item odd">
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $payment->level }} {{ $payment->name }}</span>
                                        </td>
                                        <td class="nk-tb-col">
                                            <span class="text-capitalize">{{ $payment->payment_date }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="payment-amount">{{ $payment->amount }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->

    <script>
        new AutoNumeric('.payment-amount', {decimalPlaces: 0, minimumValue: 0});
    </script>
@endsection
