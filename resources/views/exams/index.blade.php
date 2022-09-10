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
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h5 class="title">All Exams</h5>
                        </div>
                    </div><!-- .card-title-group -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">Group name</span></th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-status d-none d-sm-inline-block">
                                        <span>Level</span>
                                    </span>
                                    <span class="tb-tnx-status d-md-inline-block d-none">
                                        <span class="d-none d-md-block">
                                            <span>Exam</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    <span class="tb-tnx-total">A/N</span>
                                    <span class="tb-tnx-status d-none d-md-inline-block">Date</span>
                                </th>
                                <th class="tb-tnx-action">
                                    <span>&nbsp;</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-id"><span>{{ $exam->group_id }}</span></td>
                                    <td class="tb-tnx-info">
                                        <div class="tb-tnx-status">
                                            <span class="title">
                                                {{ ucfirst($exam->level) }}
                                            </span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="title">{{ ucfirst($exam->exam_type) }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-amount is-alt">
                                        <div class="tb-tnx-total">
                                            <span class="badge badge-outline-primary">{{ $exam->accepted }}</span>
                                            <span class="badge">{{ $exam->notaccepted }}</span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            <span class="badge badge-outline-primary">{{ date("d-M-Y", strtotime($exam->created_at)) }}</span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-action">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li><a href="{{ route('exams.edit', $exam->id) }}">Edit</a></li>
                                                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li><a href="#"
                                                                onclick="event.preventDefault();
                                                                                                    this.closest('form').submit();"
                                                                data-confirm="Are you sure to delete this item?">Remove</a>
                                                        </li>
                                                    </form>
                                                </ul>
                                            </div>
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
