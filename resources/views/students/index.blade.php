@section('title', 'Student list')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Students Lists</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ count($students) }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-bs-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="{{ route('students.archives') }}" class="btn btn-white btn-outline-light">
                                    <em class="icon ni ni-archived"></em>
                                    <span>Archives</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('students.create') }}"
                                    class="btn btn-icon btn-primary">
                                    <em class="icon ni ni-plus"></em>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    @include('error')
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
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Phone</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Birthday</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Created Date</span>
                </th>
                <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student_data)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <div class="user-card">
                            <a href="{{ route('students.show', $student_data->id) }}">
                                <div class="user-card">
                                    <div class="user-avatar" style="{{ $student_data->image ? '' : 'background: #798bff;'}}">
                                        <img src="{{ $student_data->image ? asset('uploads/student/'.$student_data->image) : 'https://ui-avatars.com/api/?name='. $student_data->lastname . '+' . $student_data->firstname .'&background=random' }}"
                                            alt="">
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $student_data->firstname }}
                                        </span>
                                        <span>{{ $student_data->lastname }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td class="nk-tb-col tb-col-mb">
                        <span class="text-capitalize" style="@if(!$student_data->group_level) color: red; @endif">
                            {{ $student_data->group_level ? $student_data->group_level . ' ' . $student_data->group_name : 'No Group'}}
                        </span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <input type="text" class="phone border-0 bg-transparent text-soft no-focus-outline cursor-pointer"  value="{{ $student_data->phone }}" onclick="window.location = 'tel:+{{ $student_data->phone }}'" readonly>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date('d M, Y', strtotime($student_data->birthday)) }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date_format($student_data->created_at, 'd M, Y') }}</span>
                    </td>
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
                                                <a href="{{ route('students.edit', $student_data->id) }}">
                                                    <em class="icon ni ni-edit"></em>
                                                    <span>Edit</span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <form action="{{ route('students.archive', $student_data->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input id="archive_reason" type="hidden" name="archive_reason" value="">
                                                <li class="cursor-pointer">
                                                    <a onclick="archiveStudent(this)">
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('.phone').inputmask('+999 (99) 999 99 99');
        });

        async function archiveStudent (element) {
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
