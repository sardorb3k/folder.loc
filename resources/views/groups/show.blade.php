@section('title', 'Group Details')
@extends('layouts.app')
@section('content') <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Students Lists - {{ $group->level }} {{ $group->name }}</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ $count }} students.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                                class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <div class="drodown">
                                        <a href="#" data-toggle="modal" data-target="#group-create"
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
    <table class="datatable-init-export nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false"
        id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
        <thead>
            <tr class="nk-tb-item nk-tb-head">
                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">#</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">Student</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">Birthday</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">Status</span>
                </th>
                @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                    <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1">
                        <span class="sub-text">Action</span>
                    </th>
                @endif
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
                                    <div class="user-avatar" style="{{ $student->image ? '' : 'background: #798bff;' }}">
                                        <img src="{{ $student->image ? asset('uploads/student/' . $student->image) : 'https://ui-avatars.com/api/?name=' . $student->lastname . '+' . $student->firstname . '&background=random' }}"
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
                        <span>{{ $student->birthday }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span class="tb-status text-{{ $student->status == 'active' ? 'success' : 'info' }}">
                            @if ($student->status == 'active')
                                Active
                            @else
                                Inactive
                            @endif
                        </span>
                    </td>
                    @if (Auth::user()->role != 'teacher' && Auth::user()->role != 'assistant')
                        <td class="nk-tb-col tb-col-lg">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <form action="{{ route('groups.unsubscribe') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{ $student->group_id }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <a href="#" onclick="unsubscribeStudent(this)"
                                                class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em
                                                    class="icon ni ni-trash"></em></a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" role="dialog" id="group-create">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Students list</h5>
                    <form action="{{ route('groups.subscription') }}" method="post">
                        <div class="tab-content">
                            <div class="tab-pane active" id="create">
                                <div class="row gy-4">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Student list</label>
                                            <div class="form-control-wrap">
                                                <select class="form-select js-select2" multiple="multiple"
                                                    name="student_id[]" data-placeholder="Select Multiple options">
                                                    @foreach ($unsubscribelist as $item)
                                                        @if ($item->role == 'student')
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->lastname . ' ' . $item->firstname }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                <a href="#"
                                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                    class="btn btn-lg btn-primary">Add</a>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                            {{-- @dd(count($unsubscribelist)) --}}
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->

                    </form>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->

    <script>
        async function unsubscribeStudent(element) {
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
