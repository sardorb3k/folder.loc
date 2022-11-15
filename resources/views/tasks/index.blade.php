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
                                <a class="btn btn-white btn-outline-light dropdown-toggle boardupdate">
                                    <em class="icon ni ni-update"></em>
                                    <span>Update Board</span>
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
                    if (task.board_id == board.id) {
                        boardTasks.push({
                            id: task.id,
                            title: taskTemplate(task)
                        });
                    }
                });
                return {
                    'id': board.board_id,
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
                itemAddOptions: {
                    enabled: true,
                    content: ':-', // : for edit board; - remove board buttons
                    class: 'kanban-title-button btn btn-default btn-xs',  
                    footer: false,
                },
                boards: boardsWithTasks,
                click: (el) => {
                    console.log(el);
                },
                buttonClick: (el, boardId) => {
                    var func = el.getAttribute('id');

                    if(func.includes('edit')) {
                        editBoardTitle(boardId);
                    } else if(func.includes('remove')) {
                        removeCurrentBoard(boardId);
                    }
                }
            });

            for (var i = 0; i < kanban.options.boards.length; i++) {
                addBoardFooter(kanban.options.boards[i].id);
            }

            $('.add-new-board').click(addNewBoard);
            
            $('.boardupdate').click(updateAllBoards);

            function titletemplate(title, count) {
                return `<div class='kanban-title-content'>
                            <h6 class='title'>${title}</h6>
                            <span class='badge badge-pill badge-outline-light text-dark board-count'>${count}</span>
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

            function addNewBoard() {
                var id = '_' + new Date().toISOString();
                kanban.addBoards([{
                    'id': id,
                    'title': titletemplate('New Board', 0),
                    'class': 'kanban-board',
                    'item': []
                }]);
                addBoardFooter(id);

                // Ajax call to create new board
                $.ajax({
                    url: '{{ route("boards.store") }}',
                    type: 'POST',
                    data: {
                        board_id: id,
                        name: 'New Board',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }

            function addBoardFooter(boardId) {
                var board = kanban.findBoard(boardId);
                var addTaskButton = document.createElement('button');
                addTaskButton.classList.add('kanban-add-task', 'btn', 'btn-block', 'footer-kanban-add-task');
                addTaskButton.innerHTML = `<em class='icon ni ni-plus-sm'></em><span>Add another task</span>`;
                addTaskButton.addEventListener('click', addNewTask);
                $(board).find("footer").append(addTaskButton);
            }

            function updateAllBoards() {
                window.location.reload();
            }

            function removeCurrentBoard(currentBoardId) {
                kanban.removeBoard(currentBoardId);

                $.ajax({
                    url: '{{ route("boards.delete") }}',
                    type: 'DELETE',
                    data: {
                        board_id: currentBoardId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
            
            function editBoardTitle(currentBoardId) {
                var board = kanban.findBoard(currentBoardId);
                var boardTitle = $(board).find('.kanban-title-content .title');
                var boardTitleText = boardTitle.text();
                var formContainer = document.createElement('div');
                var formInput = document.createElement('input');
                var formSaveButton = document.createElement('button');

                formSaveButton.classList.add('btn', 'btn-sm', 'btn-icon', 'btn-trigger', 'ml-2');
                formSaveButton.innerHTML = 'Save';
                formSaveButton.addEventListener('click', () => saveBoardTitle(currentBoardId));
                formInput.classList.add('form-control', 'form-control-sm', 'form-title');
                formInput.value = boardTitleText;
                formContainer.setAttribute('style', 'display: flex;');
                formContainer.appendChild(formInput);
                formContainer.appendChild(formSaveButton);
                boardTitle.html(formContainer);
                $(board).find('.kanban-title-content .title input').focus();
                $(board).find('.kanban-title-content .drodown').hide();
                $(board).find('.kanban-title-content .board-count').hide();
            }

            function saveBoardTitle(currentBoardId) {
                var board = kanban.findBoard(currentBoardId);
                var newTitle = $(board).find('.kanban-title-content .form-title').val();
                $(board).find('.kanban-title-content .title').html(newTitle);
                $(board).find('.kanban-title-content .drodown').show();
                $(board).find('.kanban-title-content .board-count').show();

                $.ajax({
                    url: '{{ route("boards.update") }}',
                    type: 'PUT',
                    data: {
                        board_id: currentBoardId,
                        name: newTitle
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }

            function addNewTask(e) {
                var currentBoardId = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                var className = 'new-task-' + currentBoardId + new Date().toISOString();
                kanban.addElement(
                    currentBoardId, {
                        'title': taskTemplate({
                            name: 'New Task',
                            description: 'New Task Description',
                            deadline: '12/12/2020'
                        }),
                    }
                );
                var board = kanban.findBoard(currentBoardId);
                var count = $(board).find('.kanban-item').length;
                $(board).find('.kanban-title-content .board-count').html(count);

                $.ajax({
                    url: '{{ route("tasks.store") }}',
                    type: 'POST',
                    data: {
                        name: 'New Task',
                        board_id: currentBoardId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endsection
