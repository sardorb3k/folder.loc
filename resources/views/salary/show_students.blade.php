@section('title', 'Salary')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Salary - {{ $group->level }} {{ $group->name }}</h3>
                <p></p>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Students</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                @if ($formStatus)
                    <form action="{{ route('salary.store', $id) }}" class="form-validate" novalidate="novalidate"
                        method="post">
                        @csrf
                    @else
                        <form action="{{ route('salary.update', $id) }}" class="form-validate" novalidate="novalidate"
                            method="POST">
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
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Student</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Attendance</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Payment</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Amount</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="nk-tb-item odd">
                                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <div class="user-card">
                                            <a href="{{ route('students.show', $student->id) }}">
                                                <div class="user-card">
                                                    <div class="user-avatar" style="{{ $student->image ? '' : 'background: #798bff;'}}">
                                                        <img src="{{ $student->image ? asset('uploads/student/'.$student->image) : 'https://ui-avatars.com/api/?name='. $student->lastname . '+' . $student->firstname .'&background=random' }}"
                                                            alt="">
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $student->firstname }}
                                                        </span>
                                                        <span>{{ $student->lastname }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <span class="badge badge-outline-secondary">{{ $student->att_ap }}</span> /
                                        <span class="badge badge-outline-secondary">{{ $crm_attendance_day }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="payment"
                                                value="{{ number_format($student->payment) }}" disabled>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <div class="form-control-wrap">
                                            <input type="text" name="amount[{{ $student->id }}]" id="amount"
                                                value="{{ $student->amount }}" class="form-control payment-amount" autocomplete="off">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <input type="hidden" name="group_id" value="{{ $id }}">
                            <input name="salarydate" type="hidden" value="{{ $date }}">
                            <input name="teacher_id" type="hidden" value="{{ $teacher_id }}">
                            <div class="form-group">
                                <a href="#" class="btn btn-secondary"
                                    onclick="event.preventDefault();this.closest('form').submit();">Save</a>
                            </div>
                        </div>
                    </div><!-- .nk-block-between -->
                </div>
                </form>
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <script>
         new AutoNumeric.multiple('.payment-amount', {decimalPlaces: 0, minimumValue: 0});
        // Payment Format Number
        $('#payment').on('keyup', function() {
            var payment = $(this).val();
            var usFormat = payment.toLocaleString('en-US');
            $('#payment').val(usFormat);
        });
    </script>
@endsection
