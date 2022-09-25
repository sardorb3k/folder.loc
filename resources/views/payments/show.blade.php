@section('title', 'Payments')
@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Payments</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $count }} students.</p>
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
                <form action="{{ route('payments.show_red', $id) }}" method="get" style="display: contents;">
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
                        <input type="hidden" name="group" value="{{ $id }}">
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
                <div class="card-inner position-relative card-tools-toggle">
                    <h5 class="title">All Students</h5>
                </div><!-- .card-inner -->

                {{-- @if ($students['status'] == true) --}}
                <form id="paymentForm" action="{{ route('payments.update', $id) }}" method="POST">
                    @csrf
                    @method('PUT')
                {{-- @else
                    <form id="paymentForm" action="{{ route('payments.store') }}" method="POST">
                        @csrf --}}
                {{-- @endif --}}
                    <div class="card-inner p-0">
                        <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                <div class="nk-tb-col"><span class="sub-text">Amuont</span></div>
                                <div class="nk-tb-col nk-tb-col-tools text-right">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                            data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-tb-item -->
                            @foreach ($students['students'] as $student_data)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <a href="{{ route('students.show', $student_data->id) }}">
                                            <div class="user-card">
                                                <div class="user-avatar"
                                                    style="{{ $student_data->image ? '' : 'background: #798bff;' }}">
                                                    <img src="{{ $student_data->image ? asset('uploads/student/' . $student_data->image) : 'https://ui-avatars.com/api/?name=' . $student_data->lastname . '+' . $student_data->firstname . '&background=random' }}"
                                                        alt="">
                                                </div>
                                                <div class="user-info">
                                                    <span
                                                        class="tb-lead">{{ $student_data->lastname . ' ' . $student_data->firstname }}
                                                    </span>
                                                    <span>{{ $student_data->phone }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="nk-tb-col">
                                        <div class="form-control-wrap">
                                            <input data-affixes-stay="true" id="amount{{ $student_data->id }}"
                                                name="amount[{{ $student_data->id }}]" value="{{ $student_data->amount }}"
                                                class="form-control payment-amount" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-xl">
                                        <ul class="nk-tb-actions gx-1">
                                            <li>
                                                <div class="drodown">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="input-daterange input-group" id="dateonemot">
                                                                <input type="text" class="form-control payment_date"
                                                                    data-date-format="yyyy-mm-dd" autocomplete="off"
                                                                    onkeydown="return false"
                                                                    name="payments[{{ $student_data->id }}][start]"
                                                                    value="{{ $student_data->payment_start }}"
                                                                    id="start{{ $student_data->id }}"
                                                                    onchange="handler('start{{ $student_data->id }}', 'end{{ $student_data->id }}');" />
                                                                <div class="input-group-addon">TO</div>
                                                                <input type="text" class="form-control"
                                                                    data-date-format="yyyy-mm-dd"
                                                                    onkeydown="return false"
                                                                    value="{{ $student_data->payment_end }}"
                                                                    name="payments[{{ $student_data->id }}][end]"
                                                                    id="end{{ $student_data->id }}" readonly />
                                                            </div>
                                                        </div>
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
                                <input type="hidden" name="group_id" value="{{ $id }}">
                                <input name="payments_date" type="hidden" value="{{ $date }}">
                                <input name="salarydate" type="hidden" value="{{ $students['date_salary'] }}">
                                <div class="form-group">
                                    <button onclick="submitPaymentForm()" type="button" class="btn btn-secondary">Save</button>
                                </div>
                            </div>
                        </div><!-- .nk-block-between -->
                    </div><!-- .card-inner -->
                </form>
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

        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });

        const submitPaymentForm = () => {  
            $('#paymentError').hide();
            var readyToSubmit = true;
            $('.payment-amount').each(function() {
                const amount = this.value;
                const id =  $(this).attr('id').split('amount')[1];
                const startDate = $('#start' + id).val();
                $('#start'+id).css({'borderColor': '#dbdfea'});
                if(amount && !startDate) {
                    $('#paymentError ul li').text('Iltimos to\'lov sanasini kiriting.');
                    $('#paymentError').show();
                    $('#start'+id).css({'borderColor': 'red'});
                    readyToSubmit = false;
                } 
            });

            if(readyToSubmit) {
                $('#paymentForm').submit();
            }
          
        }

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
