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
                <div class="card-inner p-10">
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
                                    <span class="sub-text">Days</span>
                                </th>
                                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
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
                                    <td class="nk-tb-col tb-col-lg">
                                        <a href="{{ route('salary.show_student', ['date'=> $date, 'id'=>$id, 'group_id'=> $group->id]) }}">
                                            <span class="text-capitalize">{{ $group->level }} {{ $group->name }}</span>
                                        </a>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span class="badge">{{ $group->lessonstarttime }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span class="badge text-capitalize">{{ $group->days }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
@endsection
