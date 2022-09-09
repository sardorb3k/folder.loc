@section('title', 'Groups')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Salary</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <div class="drodown">
                            <a href="{{ route('groups.create') }}" class="dropdown-toggle btn btn-icon btn-primary"><em
                                    class="icon ni ni-plus"></em></a>
                        </div>
                    </li>
                </ul>
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
                            <h5 class="title">All Group</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">Name</span></th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-status d-none d-sm-inline-block">
                                        <span>Teacher</span>
                                    </span>
                                    <span class="tb-tnx-status d-md-inline-block d-none">
                                        <span class="d-none d-md-block">
                                            <span>Assistant</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-total">Level</span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    <span class="tb-tnx-total">Lesson time</span>
                                    <span class="tb-tnx-status d-none d-md-inline-block">Week</span>
                                </th>
                                <th class="tb-tnx-action">
                                    <span>&nbsp;</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $item)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-id">
                                        <a
                                            href="{{ route('salary.show_student', ['date'=> $date, 'id'=>$id, 'group_id'=> $item->id]) }}"><span>{{ $item->name }}</span></a>
                                    </td>
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->teacher_id }}
                                            </span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ $item->assistant_id }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <span class="tb-tnx-total"
                                            style="text-transform: capitalize;">{{ $item->level }}</span>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <div class="tb-tnx-total">
                                            <span class="badge">{{ $item->lessontime }}</span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="badge">{{ $item->days }}</span>
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
        $('.delete').on("click", function(e) {
            e.preventDefault();

            var choice = confirm($(this).attr('data-confirm'));

            if (choice) {
                document.getElementById('form-service').submit();
            }
        });
    </script>
@endsection
