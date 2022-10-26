@section('title', 'Payments')
@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Payments - {{ $student->firstname}} {{ $student->lastname }}</h3>
                <div class="nk-block-des text-soft">
                    <p>Student has total {{ count($studentPayments) }} payment history.</p>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        <p></p>
        @include('error')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="paymentError" style="display: none" class="alert alert-danger">
            <ul>
                <li></li>
            </ul>
        </div>
    </div><!-- .nk-block-head -->
    <div class="card card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <form action="{{ route('payments.show_red', $studentId) }}" method="get" style="display: contents;">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Select date</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-calendar-alt"></em>
                                </div>
                                <input type="text" id="mesVigencia" class="form-control" name="datetime" onkeydown="return false"
                                    value="{{ $date }}" data-date-format="yyyy-mm" autocomplete="off" required>
                            </div>
                            <div class="form-note">Date format <code>mm/yyyy</code></div>
                        </div>
                    </div>

                    <div class="col-sm-6" style="align-self: center;">
                        <input type="hidden" name="group" value="{{ $studentId }}">
                        <div class="form-group"><a href="#" class="btn btn-secondary"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">Search</a>
                        </div>
                    </div>
                </form>

                <form id="paymentForm" action="{{ route('payments.update', $studentId) }}" method="POST" class="w-100">
                    @csrf
                    @method('PUT')
                    <div class="card-inner p-10">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="payment_amount">Amount
                                    <span class="valid-form">*</span></label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-money"></em>
                                        </div>
                                        <input data-affixes-stay="true" id="payment_amount"
                                                name="payment_amount" value="{{ $studentPaymentByDate['amount'] ?? '' }}"
                                                class="form-control payment-amount" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="lastname">Period
                                        <span class="valid-form">*</span></label>
                                    <div class="form-control-wrap">
                                        <div class="input-daterange input-group" id="dateonemot">
                                            <input type="text" class="form-control payment_date"
                                                data-date-format="yyyy-mm-dd" autocomplete="off"
                                                onkeydown="return false"
                                                name="payment_start_date"
                                                value="{{ $studentPaymentByDate['payment_start'] ?? '' }}"
                                                id="payment_start_date"
                                                onchange="handler('payment_start_date', 'payment_end_date');" />
                                            <div class="input-group-addon">TO</div>
                                            <input type="text" class="form-control"
                                                data-date-format="yyyy-mm-dd"
                                                onkeydown="return false"
                                                value="{{ $studentPaymentByDate['payment_end'] ?? '' }}"
                                                name="payment_end_date"
                                                id="payment_end_date" readonly role="button"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-block-between-md g-3 py-2">
                            <div class="g">
                                <input name="payments_date" type="hidden" value="{{ $date }}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary">Save</button>
                                </div>
                            </div>
                        </div><!-- .nk-block-between -->
                    </div><!-- .card-inner -->
                </form>
            </div>
        </div>
    </div>
    <div class="card nk-block">

        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <h5 class="title">Payment History</h5>
                </div><!-- .card-inner -->

                <div class="card-inner p-10">
                    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">#</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Payment Date</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Amount</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                                    <span class="sub-text">Period</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$studentPayments}}
                            @foreach ($studentPayments as $payment)
                                <tr class="nk-tb-item odd">
                                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <div class="user-card">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ date('d F', strtotime($payment->payment_date)) }}
                                                        </span>
                                                        <span>{{ date('Y', strtotime($payment->payment_date)) }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <div class="form-control-wrap">
                                            <input data-affixes-stay="true" value="{{ $payment->amount }}"
                                                class="form-control payment-amount" disabled>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-lg">
                                        <span hidden>{{ $payment->payment_end }}</span>
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="input-daterange input-group" id="dateonemot">
                                                    <input type="text" class="form-control"
                                                        data-date-format="yyyy-mm-dd" 
                                                        value="{{ $payment->payment_start }}"
                                                        disabled/>
                                                    <div class="input-group-addon">TO</div>
                                                    <input type="text" class="form-control"
                                                        data-date-format="yyyy-mm-dd"
                                                        value="{{ $payment->payment_end }}" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <script>
        // format amount input
        new AutoNumeric.multiple('.payment-amount', {decimalPlaces: 0, minimumValue: 0});

        $('.payment_date').datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date('{{ $date }}-01'),
            endDate: new Date('{{ $date }}-30')
        });
        // The select date
        $('#mesVigencia').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        });

        function addnull(y, m, d) {
            var d0 = '',
                m0 = '';
            if (d < 10) d0 = '0';
            if (m < 10) m0 = '0';
            // return '' + d0 + d + '-' + m0 + m + '-' + y;
            return '' + y + '-' + m0 + m + '-' + d0 + d;
        }

        function handler(s, e) {

            var date1 = document.getElementById(s).value;
            date1 = date1.split("-");
            date1[1] = parseInt(date1[1], 10) + parseInt(1, 10);
            date1[0] = parseInt(date1[0], 10);
            date1[2] = parseInt(date1[2], 10);
            if (parseInt(date1[1]) < 10) {
                var mon = "0" + date1[1];
            } else {
                var mon = date1[1];
            }
            if (parseInt(date1[2]) < 10) {
                var mon = "0" + date1[2];
            } else {
                var mon = date1[2];
            }
            if (date1[1] > 12) {
                date1[1] = date1[1] - 12;
                date1[2] = date1[2] + 1;
            }
            var may_date = date1[0] + "-" + mon + "-" + date1[2];

            document.getElementById(e).value = addnull(date1[0], date1[1], date1[2]);
        }
    </script>
@endsection
