@section('title', 'Salary')
@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Salary</h3>
                <p></p>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <form action="{{ route('salary.index_red') }}" method="get" style="display: contents;">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Select date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-calendar-alt"></em>
                                </div>
                                <input type="text" id="mesVigencia" class="form-control" name="datetime"
                                    value="{{ $date ?? date('Y-m') }}" data-date-format="yyyy-mm" onkeydown="return false"
                                    required>
                            </div>
                            <div class="form-note">Date format <code>yyyy/mm</code></div>
                        </div>
                    </div>

                    <div class="col-sm-6" style="align-self: center;">
                        <div class="form-group"><a href="#" class="btn btn-secondary"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">Search</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Teachers</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                @if ($formStatus)
                    <form action="{{ route('salary.storeSalaryList', $date) }}" class="form-validate"
                        novalidate="novalidate" method="post">
                        @csrf
                @else
                    <form action="{{ route('salary.updateSalaryList', $date) }}" class="form-validate"
                        novalidate="novalidate" method="POST">
                        @csrf
                        @method('PUT')
                @endif
                <div class="card-inner p-10">
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">#</span>
                                </th>
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Teacher</span>
                                </th>
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Role</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Students #</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Total Salary</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb text-end sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Total Paid</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr class="nk-tb-item odd">
                                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <a href="{{ route('salary.show', ['date' => $date, 'id' => $teacher->id]) }}">
                                            <span>{{ $teacher->firstname }}  {{ $teacher->lastname }}</span>
                                        </a>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span class="text-capitalize">  {{ $teacher->role }} </span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span>  {{ $teacher->students_count }} </span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <input type="text" class="payment-amount border-0 bg-transparent text-soft no-focus-outline"  value="{{ $teacher->role == 'teacher' ? $teacher->salary : $teacher->salary_assistent }}" readonly>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg nk-tb-col-tools">
                                        <input value="{{ $teacher->salary_action }}" class="form-control payment-amount"
                                            @disabled(Auth::user()->getRole() != 'superadmin')
                                            name="salary[{{ $teacher->id }}]" autocomplete="off">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
                @if (Auth::user()->getRole() == 'superadmin')
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                                <input name="salarydate" type="hidden" value="{{ $date }}">
                                <div class="form-group">
                                    <a href="#" class="btn btn-secondary"
                                        onclick="event.preventDefault();this.closest('form').submit();">Save</a>
                                </div>
                            </div>
                        </div><!-- .nk-block-between -->
                    </div>
                @endif
                </form>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <script>
        // The select date
        $('#mesVigencia').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });

        new AutoNumeric.multiple('.payment-amount', {decimalPlaces: 0, minimumValue: 0});
    </script>
@endsection
