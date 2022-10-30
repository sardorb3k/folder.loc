@section('title', 'Teacher list')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <nav>
                    <ul class="breadcrumb breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers List</a></li>
                        <li class="breadcrumb-item active">Archives</li>
                    </ul>
                </nav>
                <h3 class="nk-block-title page-title">
                    Archived Teachers Lists
                </h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ count($teachers) }} teachers.</p>
                </div>
            </div><!-- .nk-block-head-content -->

        @if (Auth::user()->getRole() == 'superadmin')
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="{{ route('teachers.create') }}"
                                        class="dropdown-toggle btn btn-icon btn-primary">
                                        <em class="icon ni ni-plus"></em></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
            @endif
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
                    <span class="sub-text">Teacher</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Role</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Phone</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Birthday</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Reason</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Archived Date</span>
                </th>
                @if (Auth::user()->getRole() == 'superadmin')
                    <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <div class="user-card">
                            <a href="{{ route('teachers.show', $teacher->id) }}">
                                <div class="user-card">
                                    <div class="user-avatar" style="{{ $teacher->image ? '' : 'background: #798bff;'}}">
                                        <img src="{{ $teacher->image ? asset('uploads/teacher/'.$teacher->image) : 'https://ui-avatars.com/api/?name='. $teacher->lastname . '+' . $teacher->firstname .'&background=random' }}"
                                            alt="">
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">{{ $teacher->firstname }}
                                        </span>
                                        <span>{{ $teacher->lastname }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span style="text-transform: capitalize">{{ $teacher->role }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <input type="text" class="phone border-0 bg-transparent text-soft no-focus-outline cursor-pointer"  value="{{ $teacher->phone }}" onclick="window.location = 'tel:+{{ $teacher->phone }}'" readonly>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date('d M, Y', strtotime($teacher->birthday)) }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        @if($teacher->archive_reason != '') 
                            <textarea readonly class="form-control no-resize min-height-50" id="default-textarea">{{ $student_data->archive_reason }}</textarea>
                        @else 
                            *
                        @endif
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date('d M, Y', strtotime($teacher->archived_at)) }}</span>
                    </td>
                    @if (Auth::user()->getRole() == 'superadmin')
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="true">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('teachers.show', $teacher->id) }}"><em
                                                    class="icon ni ni-edit"></em><span>Edit</span></a>
                                                </li>
                                                <li class="divider"></li>
                                                <form action="{{ route('teachers.unarchive', $teacher->id) }}"
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
                                                <form action="{{ route('teachers.delete', $teacher->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id"
                                                        value="{{ $teacher->id }}">
                                                    <li>
                                                        <a onclick="deleteTeacher(this)">
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
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(".phone").inputmask({
            "mask": "+999 (99) 999-99-99"
        });

        async function deleteTeacher (element) {
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
