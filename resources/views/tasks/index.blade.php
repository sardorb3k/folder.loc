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
    @include('error')

    <div class="nk-block">
        <div class="row g-gs">
            <div class="nk-content-body">
                <div class="ng-block">
                    <div id="rexarTaskBoard" class="nk-kanban"></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .title-task {
            max-width: 400px;
            width: 100%;
        }

        .title-task:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
            outline: none;

        }
    </style>
    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="task">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <form method="POST" action="{{ route('tasks.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <div class="col-sm-12">
                            <div class="form-control-wrap">
                                <input type="text" name="name" class="form-control title-task"
                                    onkeyup="updateTask(this)" id="task-name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-4">

                            <div class="col-sm-12">
                                <label class="form-label" for="default-01">Description</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" id="task-description" name="description" class="form-control no-resize" rows="5"
                                        onkeyup="updateTask(this)"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Deadline</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker" name="deadline"
                                            id="task-deadline" onkeyup="updateTask(this)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="labels">Labels</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="labels" id="labels">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Users</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" name="users[]" multiple="multiple">
                                            @forelse ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->firstname }}
                                                    {{ $user->lastname }}</option>
                                            @empty
                                                <option value="">No user</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <input type="hidden" name="task_id" id="task_id">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#labels").selectize({
            delimiter: ",",
            persist: true,
            // list of labels

            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });

        function updateTask(el) {
            var task_id = $('#task').val();
            var task_name = $(el).val();
            console.log(el.value);
        }
        $(document).ready(function() {
            const tasks = {!! json_encode($tasks) !!};
            const boards = {!! json_encode($boards) !!};
            const colors = ['light', 'primary', 'warning', 'success'];
            const boardsWithTasks = boards.map((board, index) => {
                var boardTasks = [];
                tasks.forEach(task => {
                    if (task.board_id == board.board_id) {
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
                    var task = tasks.find(task => task.id == el.dataset.eid);
                    $('#task-name').val(task.name);
                    $('#task-description').val(task.description);
                    $('#task-deadline').val(task.deadline);
                    $('#task_id').val(task.id);

                    $('#task').val(el.dataset.eid).modal('show');
                },
                context: (el, e) => {
                    console.log(el, '-', e);
                },
                dropEl: (el, target, source, sibling) => {
                    console.log(el.dataset.eid);
                    // console.log(el, target, source, sibling);
                },
                buttonClick: (el, boardId) => {
                    var func = el.getAttribute('id');

                    if (func.includes('edit')) {
                        editBoardTitle(boardId);
                    } else if (func.includes('remove')) {
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
                                        ${task.users != null ? JSON.parse(task.users)?.slice(0, 4).map(user => {
                                            return `<div class='user-avatar xs'><img src='{{ Auth::user(1)->getAvatarAttribute() }}'></div>`;
                                        }).join('') : ''}
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
                            ${task.labels != null && task.labels != undefined ? JSON.parse(task.labels)?.map(label => {
                                return `<li><span class='badge badge-outline-light text-dark'>${label.name}</span></li>`;
                            }).join('') : ''}
                        </ul>
                        <div class='kanban-item-meta'>
                            <ul class='kanban-item-meta-list'>
                                ${task.deadline != null && task.labels != undefined ? `<li class='text-danger'><em class='icon ni ni-calendar'></em><span>${task.deadline}</span></li>` : ''}
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
                    url: '{{ route('boards.store') }}',
                    type: 'POST',
                    data: {
                        board_id: id,
                        name: 'New Board',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
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
                    url: '{{ route('boards.delete') }}',
                    type: 'DELETE',
                    data: {
                        board_id: currentBoardId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
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
                    url: '{{ route('boards.update') }}',
                    type: 'PUT',
                    data: {
                        board_id: currentBoardId,
                        name: newTitle
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
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
                    url: '{{ route('tasks.store') }}',
                    type: 'POST',
                    data: {
                        name: 'New Task',
                        board_id: currentBoardId,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endsection
