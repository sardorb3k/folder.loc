@section('title', 'Salary')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Salary</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of {{ $count }} teachers.</p>
                </div>
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
                                    value="{{ $date ?? date('Y-m') }}" data-date-format="yyyy-mm" autocomplete="off"
                                    required readonly>
                            </div>
                            <div class="form-note">Date format <code>mm/yyyy</code></div>
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
    <div class="nk-block">
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
                <div class="card-inner p-0">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">Teacher Name</span></th>
                                {{-- <th class="tb-tnx-info">
                                    <span class="tb-tnx-status d-none d-sm-inline-block">
                                        <span>Groups count</span>
                                    </span>
                                </th> --}}
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-status d-none d-sm-inline-block">
                                        <span>Students count</span>
                                    </span>
                                    <span class="tb-tnx-status d-md-inline-block d-none">
                                        <span class="d-none d-md-block">
                                            <span>Salary</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    <span class="tb-tnx-total">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $item)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-id">
                                        <a href="{{ route('salary.show', ['date' => $date, 'id' => $item->id]) }}"><span>{{ $item->firstname }}
                                                {{ $item->lastname }}</span></a>
                                    </td>
                                    {{-- <td class="tb-tnx-info">
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->group_count }}
                                            </span>
                                        </div>
                                    </td> --}}
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->students_count }}
                                            </span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="title">{{ $item->salary }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <div class="tb-tnx-total">
                                            <input type="number" pattern="/^-?\d+\.?\d*$/" value="{{ $item->salary_action }}"
                                                class="form-control" name="salary[{{ $item->id }}]">
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
                            <input name="salarydate" type="hidden" value="{{ $date }}">
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
        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });
    </script>
@endsection
