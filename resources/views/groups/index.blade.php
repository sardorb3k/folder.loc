@section('title', 'Groups')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Groups</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of {{ count($groups) }} groups.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="{{ route('groups.archives') }}" class="btn btn-white btn-outline-light">
                                <em class="icon ni ni-archived"></em>
                                <span>Archives</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('groups.create') }}" class="btn btn-icon btn-primary">
                                <em class="icon ni ni-plus"></em>
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
                    <span class="sub-text">Group</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Teacher</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Assistant</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Students #</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Days</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Time</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Created Date</span>
                </th>
                @if(Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                    <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <a href="{{ route('groups.show', $group->id) }}">
                            <span class="text-uppercase">{{ $group->level }}
                                {{ $group->name }}</span>
                        </a>
                    </td>
                    <td class="nk-tb-col">
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
                    <td class="nk-tb-col">
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
                    <td class="nk-tb-col">
                        <span> {{$group->students_count}} </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="badge bg-primary">
                            {{ $group->days }}
                        </span>
                    </td>
                    <td class="nk-tb-col">
                        <span class="badge">{{ $group->lessonstarttime }}</span>
                        <span class="badge">{{ $group->lessonendtime }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>{{ date_format($group->created_at, 'd-m-Y') }}</span>
                    </td>
                    @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="true">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="{{ route('groups.edit', $group->id) }}">
                                                        <em class="icon ni ni-edit"></em>
                                                        <span>Edit</span>
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <form action="{{ route('groups.archive', $group->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input id="archive_reason" type="hidden" name="archive_reason" value="">
                                                    <li class="cursor-pointer">
                                                        <a onclick="archiveGroup(this)">
                                                            <em class="icon ni ni-archive"></em><span>Archive</span>
                                                        </a>
                                                    </li>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        async function archiveGroup (element) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "Please enter a reason.",
                input: 'text',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Archive',
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    if(reason == '') {
                        Swal.showValidationMessage(
                            `Please enter a reason`
                        )
                    }
                    $('#archive_reason').val(reason);
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            if (result.isConfirmed) {
                await element.closest('form').submit();
            }
        }
    </script>
@endsection
