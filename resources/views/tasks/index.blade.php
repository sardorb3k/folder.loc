@section('title', 'Task Board')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Task Board</h3>
                <div class="nk-block-des text-soft">
                    <p>{{ __('dashboard.welcome') }}, {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                        class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#task-create"
                                    class="btn btn-white btn-outline-light dropdown-toggle boardupdate">
                                    <em class="icon ni ni-plus"></em>
                                    <span>Add Task</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="#" data-toggle="modal" data-target="#board-create"
                                    class="btn btn-primary dropdown-toggle add-new-board">
                                    <em class="icon ni ni-plus"></em>
                                    <span>Add Board</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="nk-block">
        <div class="row g-gs">
            <div class="nk-content-body">
                <div class="ng-block">
                    <div id="rexarTaskBoard" class="nk-kanban"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="task-create-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Exam</h5>
                </div>
                <div class="modal-body">
                    <div class="row gy-4" id="exam-data">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="listening">Listening</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[listening]" class="form-control exam-result-input"
                                        id="listening" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[listening]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="grammar">Grammar</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[grammar]" class="form-control exam-result-input"
                                        id="grammar" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[grammar]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="reading">Reading</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[reading]" class="form-control exam-result-input"
                                        id="reading" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[reading]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="writing">Writing</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[writing]" class="form-control exam-result-input"
                                        id="writing" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[writing]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="speaking">Speaking</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[speaking]" class="form-control exam-result-input"
                                        id="speaking" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[speaking]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-label" for="team">Team</label>
                                <div class="form-control-wrap">
                                    <input type="text" name="exam[team]" class="form-control exam-result-input"
                                        id="team" @disabled(Auth::user()->getRole() != 'superadmin') value="{{ old('exam[team]') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <input type="hidden" name="student_id" id="student_id">
                    <input type="hidden" name="exam_id" id="exam_id">
                    <p>Exam result: <span class="badge badge-secondary" id="result"></span></p>
                    @if (Auth::user()->role == 'superadmin')
                        <span class="sub-text"><button type="button" id="exam-save"
                                class="btn btn-primary">Submit</button></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            const tasks = {!! json_encode($tasks) !!};
            const boards = {!! json_encode($boards) !!};
            const colors = ['light', 'primary', 'warning', 'success'];
            const boardsWithTasks = boards.map((board, index) => {
                var boardTasks = [];
                tasks.forEach(task => {
                    console.log(task);
                    if (task.board_id == board.id) {
                        boardTasks.push({
                            id: task.id,
                            title: taskTemplate(task)
                        });
                    }
                });
                console.log(boardTasks);
                return {
                    'id': '_' + board.name.replace(' ', '_').toLowerCase(),
                    'title': titletemplate(board.name, boardTasks.length),
                    'class': 'kanban-light',
                    'item': boardTasks
                };
            });

            var kanban = new jKanban({
                element: '#rexarTaskBoard',
                gutter: '0',
                widthBoard: '320px',
                responsivePercentage: false,
                boards: boardsWithTasks
            });

            for (var i = 0; i < kanban.options.boards.length; i++) {
                var board = kanban.findBoard(kanban.options.boards[i].id);
                $(board).find("footer").html(
                    `<button class='kanban-add-task btn btn-block footer-kanban-add-task'>
                        <em class='icon ni ni-plus-sm'></em>
                        <span>Add another task</span>
                    </button>`);
            }





            function titletemplate(title, count) {
                var optionicon = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "more-h";
                return `<div class='kanban-title-content'>
                            <h6 class='title'>${title}</h6>
                            <span class='badge badge-pill badge-outline-light text-dark board-count'>${count}</span>
                        </div>
                        <div class='kanban-title-content'>
                            <div class='drodown'>
                                <a href='#' class='dropdown-toggle btn btn-sm btn-icon btn-trigger mr-n1' data-toggle='dropdown'>
                                    <em class='icon ni ni-${optionicon}'></em>
                                </a>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <ul class='link-list-opt no-bdr kanban-title-action'>
                                        <li><a class="edit-board"><em class='icon ni ni-edit'></em><span>Edit Board</span></a></li>
                                        <li><a class="remove-board"><em class='icon ni ni-trash'></em><span>Remove Board</span></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>`;
            }

            function taskTemplate(task) {
                return `<div class='kanban-item-title'>
                            <h6 class='title'>${task.name}</h6>
                            <div class='drodown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                    <div class='user-avatar-group'>
                                        <div class='user-avatar xs bg-primary'>
                                            <span>A</span>
                                        </div>
                                    </div>
                                </a>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <ul class='link-list-opt no-bdr p-3 g-2'>
                                        <li>
                                            <div class=user-card>
                                                <div class=user-avatar sm bg-primary>
                                                    <span>AB</span>
                                                </div>
                                                <div class='user-name'>
                                                    <span class='tb-lead'>Abu Bin Ishtiyak</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class='kanban-item-text'>
                            <p>${task.description}</p>
                        </div>
                        <ul class='kanban-item-tags'>
                            <li>
                                <span class='badge badge-success'>Dashlite</span>
                            </li>
                            <li>
                                <span class='badge badge-light'>UI Design</span>
                            </li>
                        </ul>
                        <div class='kanban-item-meta'>
                            <ul class='kanban-item-meta-list'>
                                <li class='text-danger'>
                                    <em class='icon ni ni-calendar'></em>
                                    <span>${task.deadline}</span>
                                </li>
                                <li>
                                    <em class='icon ni ni-notes'></em>
                                    <span>Design</span>
                                </li>
                            </ul>
                            <ul class='kanban-item-meta-list'>
                                <li>
                                    <em class='icon ni ni-clip'></em>
                                    <span>1</span>
                                </li>
                                <li>
                                    <em class='icon ni ni-comments'></em>
                                    <span>4</span>
                                </li>
                            </ul>
                        </div>`;
            }

            function newTaskTemplate(className) {
                return `<form action="{{ route('tasks.store') }}" class="form-validate" method="POST">
                            <div class="form-group">
                                <div class="form-group">
                                    <input class="form-control ${className}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>`;
            }

            $('.kanban-container').on('click', '.kanban-add-task', (e) => {
                var currentBoard = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                console.log(currentBoard);
                var className = 'newly-created-task-' + currentBoard;
                kanban.addElement(
                    currentBoard, {
                        'title': taskTemplate({
                            name: 'New Task',
                            description: 'New Task Description',
                            deadline: '12/12/2020'
                        }),
                    }
                );
                // $('.' + className).focus();
                // board count update
                var board = kanban.findBoard(currentBoard);
                var count = $(board).find('.kanban-item').length;
                $(board).find('.kanban-title-content .board-count').html(count);
            });

            $('.add-new-board').click((e) => {
                var id = '_' + Math.floor(Math.random() * 1000);
                kanban.addBoards([{
                    'id': id,
                    'title': titletemplate('New Board', 0),
                    'class': 'kanban-board',
                    'item': []
                }]);
                // board footer add button
                var board = kanban.findBoard(id);
                $(board).find("footer").html(
                    `<button class='kanban-add-task btn btn-block footer-kanban-add-task'>
                        <em class='icon ni ni-plus-sm'></em>
                        <span>Add another task</span>
                    </button>`);
                // Ajax call to create new board
                $.ajax({
                    url: '{{ route("boards.store") }}',
                    type: 'POST',
                    data: {
                        action: 'addBoard',
                        id: id,
                        title: 'New Board'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });

            });

            // Board count update function
            $('.boardupdate').click((e) => {
                console.log('board count update');
                var boards = kanban.getBoards();
                boards.forEach(board => {
                    var count = $(board).find('.kanban-item').length;
                    $(board).find('.kanban-title-content .board-count').html(count);
                });
            });


            // Kanban board remove
            $('.kanban-container').on('click', '.remove-board', (e) => {
                // Board remove
                // Board

                var currentBoard = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                console.log(e);
                console.log($(this).data('data-id'));
                kanban.removeBoard(currentBoard);
            });
            // Kanban board edit
            $('.kanban-container').on('click', '.edit-board', (e) => {
                // Kanban board edit
                var currentBoard = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                var board = kanban.findBoard(currentBoard);
                var boardTitle = $(board).find('.kanban-title-content .title').html();
                console.log(currentBoard);
                $(board).find('.kanban-title-content .title').html(
                    `<div style='display: flex;'><input class='form-control form-control-sm form-title' value='${boardTitle}' />
                    <button class='btn btn-sm btn-icon btn-trigger ml-2 form-save'>Save</button></div>`);
                $(board).find('.kanban-title-content .title input').focus();
                // kanban title content drodown hide
                $(board).find('.kanban-title-content .drodown').hide();
                // kanban board-count hide
                $(board).find('.kanban-title-content .board-count').hide();
                // kanban title content add new a tag
                // $(board).find('.kanban-title-content .title input').on('blur', (e) => {
                //     var newTitle = e.currentTarget.value;
                //     $(board).find('.kanban-title-content .kanban-title').html(newTitle);
                // });
            });
            // Kanban board title save
            $('.kanban-container').on('click', '.form-save', (e) => {
                var currentBoard = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                var board = kanban.findBoard(currentBoard);
                var newTitle = $(board).find('.kanban-title-content .form-title').val();
                $(board).find('.kanban-title-content .title').html(newTitle);
                // kanban title content drodown show
                $(board).find('.kanban-title-content .drodown').show();
                // kanban board-count show
                $(board).find('.kanban-title-content .board-count').show();
                // Ajax call to update board title
                $.ajax({
                    url: '{{ route("boards.update") }}',
                    type: 'POST',
                    data: {
                        action: 'updateBoard',
                        id: currentBoard,
                        title: newTitle
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
