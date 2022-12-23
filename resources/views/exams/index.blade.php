@section('title', 'Exam')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Exam</h3>
                <div class="nk-block-des text-soft">
                    <p>You have a total of  groups.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->role == 'superadmin')
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-bs-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#group-create"
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
                    <span class="sub-text">Exam</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text"><em class="icon ni ni-check"></em> / <em class="icon ni ni-cross"></em></span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1">
                    <span class="sub-text">Date</span>
                </th>
                @if (Auth::user()->role == 'superadmin')
                <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <a href="{{ route('exams.show', $exam->id) }}">
                            <span class="text-capitalize">
                                {{ ucfirst($exam->level) }} {{ $groups->where('id', $exam->group_id)->first()->name }}
                            </span>
                        </a>
                    </td>
                    <td class="nk-tb-col tb-col-mb">
                        <span>{{ ucfirst($exam->exam_type) }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span class="badge badge-outline-primary">{{ $exam->accepted }}</span>
                        <span class="badge">{{ $exam->notaccepted }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span class="badge badge-outline-primary">{{ date("d-M-Y", strtotime($exam->created_at)) }}</span>
                    </td>
                    @if (Auth::user()->role == 'superadmin')
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="true">
                                            <em class="icon ni ni-more-h"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="{{ route('exams.show', $exam->id) }}">
                                                    <em class="icon ni ni-repeat"></em><span>Edit</span></a>
                                                </li>
                                                <li class="divider"></li>
                                                <form action="{{ route('exams.destroy', $exam->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id"
                                                        value="{{ $exam->id }}">
                                                    <li>
                                                        <a onclick="deleteExam(this)">
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
    @if (Auth::user()->role == 'superadmin')
        <div class="modal fade" role="dialog" id="group-create">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">Create Exam</h5>
                        <form action="{{ route('exams.create') }}" method="post">
                            <div class="tab-content">
                                <div class="tab-pane active" id="create">
                                    <div class="row gy-4">
                                        @csrf
                                        @method('POST')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="exam">Exam</label>
                                                <select class="form-control" name="exam" id="exam" required>
                                                    <option value="mid">Mid</option>
                                                    <option value="final">Final</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="group_id">Groups list</label>
                                                <select class="form-control" name="group_id" id="group_id" required>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}">
                                                            {{ $group->name }} - {{ strtoupper($group->level) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <a href="#" onclick="event.preventDefault();
                                                                                        this.closest('form').submit();"
                                                        class="btn btn-lg btn-primary">Add</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                                </li>
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
    @endif
    <script>
         async function deleteExam (element) {
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
