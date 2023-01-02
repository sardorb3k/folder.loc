@section('title', 'Archived Student list')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <nav>
                    <ul class="breadcrumb breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students List</a></li>
                        <li class="breadcrumb-item active">Archives</li>
                    </ul>
                </nav>
                <h3 class="nk-block-title page-title">
                    Archived Students Lists
                </h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ count($students) }} students in archive.</p>
                </div>
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
                    <span class="sub-text">Phone</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Birthday</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Reason</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Archived Date</span>
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
                    <td class="nk-tb-col tb-col-lg">
                        <input type="text" class="phone border-0 bg-transparent text-soft no-focus-outline cursor-pointer"  value="{{ $student_data->phone }}" onclick="window.location = 'tel:+{{ $student_data->phone }}'" readonly>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ $student_data->birthday }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-md">
                        <span class="tb-status">
                            @if($student_data->archive_reason != '')
                                <textarea readonly class="form-control no-resize min-height-50" id="default-textarea">{{ $student_data->archive_reason }}</textarea>
                            @else
                                *
                            @endif
                        </span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date('d M, Y', strtotime($student_data->archived_at)) }}</span>
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
                                                <a href="{{ route('students.edit', $student_data->id) }}"><em
                                                class="icon ni ni-edit"></em><span>Edit</span></a>
                                            </li>
                                            <li class="divider"></li>
                                            <form action="{{ route('students.unarchive', $student_data->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <li class="cursor-pointer">
                                                    <a onclick="this.closest('form').submit()">
                                                        <em class="icon ni ni-unarchive"></em>
                                                        <span>Unarchive</span>
                                                    </a>
                                                </li>
                                            </form>
                                            <li class="divider"></li>
                                            <form action="{{ route('students.delete', $student_data->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $student_data->id }}">
                                                <li>
                                                    <a onclick="deleteStudent(this)">
                                                        <em class="icon ni ni-na"></em><span>Delete</span>
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

        async function deleteStudent (element) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });
            if (result.isConfirmed) {
                await element.closest('form').submit();
            }
        }
    </script>
@endsection
