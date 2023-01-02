@section('title', 'Task Board')
@extends('layouts.app')
@section('content')

    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="task">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <a class="close cursor-pointer" data-bs-dismiss="modal" aria-label="Close" id="closemodal">
                    <em class="icon ni ni-cross"></em>
                </a>
                <form method="POST" action="{{ route('tasks.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <div class="title-task form-control-wrap">
                            <input type="text" name="name" class="form-control" id="task-name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <label class="form-label" for="default-01">Description</label>
                                <div class="form-control-wrap">
                                    <textarea name="description" id="task-description" name="description" class="form-control no-resize" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Deadline</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker" name="deadline"
                                            data-date-format="yyyy-mm-dd" onkeydown="return false" autocomplete="off"
                                            id="task-deadline">
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
                                        <select id="task-users" class="form-select js-select2" name="users[]"
                                            multiple="multiple">
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
                        <button id="delete-task-button" type="button" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                        class="btn btn-icon btn-trigger toggle-expand me-n1" data-bs-target="pageMenu"><em
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#board-create"
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
        .kanban-board .kanban-drag {
            max-height: 450px;
            overflow-y: scroll;
        }
    </style>
    <script>
        const labelSelect = $("#labels").selectize({
            delimiter: ",",
            persist: true,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });

        $('#closemodal').click(function() {
            $('#task').modal('hide');
        });

        $(document).ready(function() {
            const tasks = {!! json_encode($tasks) !!};
            const boards = {!! json_encode($boards) !!};
            const users = {!! json_encode($users) !!};
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
                var board = {
                    'id': board.id,
                    'title': titletemplate(board.name, boardTasks.length),
                    'item': boardTasks,
                    'color': board.color
                };
                return board;
            });

            // toastr.options
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

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
                click: (el) => openEditTaskModal(el),
                context: (el, e) => deleteCurrentTask(el.dataset.eid),
                dropEl: (el, target, source, sibling) => {
                    // Ajax update
                    var targetBoardTasks = [];
                    var sourceBoardTasks = [];
                    kanban.getBoardElements(kanban.getParentBoardID(el.dataset.eid)).forEach((task) => {
                        targetBoardTasks.push(task.dataset.eid);
                    });
                    if(target.parentNode.dataset.id != source.parentNode.dataset.id) {
                        kanban.getBoardElements(source.parentNode.dataset.id).forEach((task) => {
                            sourceBoardTasks.push(task.dataset.eid);
                        });
                    }
                    $.ajax({
                        url: "{{ route('tasks.updateBoard') }}",
                        type: 'PUT',
                        data: {
                            task_id: el.dataset.eid,
                            board_id: kanban.getParentBoardID(el.dataset.eid),
                            source_board: source.parentNode.dataset.id,
                            targetBoardTasks: JSON.stringify(targetBoardTasks),
                            sourceBoardTasks: JSON.stringify(sourceBoardTasks),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            getTasksCountByBoard(target.parentNode);
                            getTasksCountByBoard(source.parentNode);
                            toastr.success('Task moved successfully');
                        }
                    });
                },
                dragendBoard: (el) => {
                    var boardIds = [];
                    $('.kanban-board').each((index, board) => {
                        boardIds.push(board.getAttribute('data-id'));
                    });
                    $.ajax({
                        url: '{{ route('boards.reorder') }}',
                        type: 'PUT',
                        data: {
                            boardIds: JSON.stringify(boardIds),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            toastr.success('Board has been updated.', 'Updated!');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
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

            $('#delete-task-button').click((event) => {
                const taskId = $('#task_id').val();
                if(taskId != null && taskId != '') {
                    deleteCurrentTask(taskId);
                }
            });

            // open edit task Modal Window
            function openEditTaskModal(el) {
                if(!$(el).find('.drodown').hasClass('show')) {
                    var task = tasks.find(task => task.id == el.dataset.eid) || {
                        name: 'New Task',
                        description: '',
                        deadline: '',
                        labels: '',
                        users: []
                    };
                    if(task.labels != null && task.labels != '') {
                        var selectize = labelSelect[0].selectize;
                        selectize.addOption(JSON.parse(task.labels).map((label) => {
                            return {'text': label, 'value': label};
                        }));
                        selectize.setValue(JSON.parse(task.labels));
                    }
                    $('#task-name').val(task.name);
                    $('#task-description').val(task.description);
                    $('#task-deadline').val(task.deadline);
                    $('#task_id').val(task.id || el.dataset.eid);
                    if(task.users != null && task.users.length > 0) {
                        $('#task-users').val(JSON.parse(task.users)).trigger('change');
                    }
                    $('#task').val(el.dataset.eid).modal('show');
                }
            }

            // Task delete
            async function deleteCurrentTask(taskId) {
                const result = await Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete',
                    showLoaderOnConfirm: true,
                });

                if (result.isConfirmed) {
                    // Ajax delete task
                    $.ajax({
                        url: "{{ route('tasks.destroy') }}",
                        type: 'DELETE',
                        data: {
                            task_id: taskId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                var task = kanban.findElement(taskId);
                                var currentBoard = $(task).parent().parent();
                                kanban.removeElement(taskId);
                                getTasksCountByBoard(currentBoard);
                                toastr.success('Task has been deleted.', 'Deleted!');
                            } else {
                                toastr.error('Task has not been deleted.', 'Failed!');
                            }
                            $('#task').modal('hide');
                        }
                    });
                }

            }

            function titletemplate(title, count) {
                return `<div class='kanban-title-content'>
                            <h6 class='title'>${title}</h6>
                            <span class='badge badge-pill badge-outline-light text-dark board-count'>${count}</span>
                        </div>
                    </div>`;
            }

            function taskTemplate(task) {
                var currentTaskUsers = [];
                if(task.users != null && task.users.length > 0) {
                    JSON.parse(task.users).forEach(taskUser => {
                        currentTaskUsers.push(users.find((user) => user.id == taskUser));
                    });
                }
                return `<div class='kanban-item-title'>
                            <h6 class='title' style='word-break: break-word;'>${task.name}</h6>
                            <div class='drodown' onclick="this.classList.add('show')">
                                <a class='dropdown-toggle' data-bs-toggle='dropdown'>
                                    <div class='user-avatar-group'>
                                        ${currentTaskUsers != null ? currentTaskUsers.map(user => {
                                            return `<div class='user-avatar xs bg-primary'>
                                                        <span>${user.firstname[0]}${user.lastname[0]}</span>
                                                    </div>`;
                                        }).join('') : ''}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                                    <ul class="link-list-opt no-bdr p-3 g-2">
                                        ${currentTaskUsers != null ? currentTaskUsers.map(user => {
                                            return `<li>
                                                        <div class="user-card">
                                                            <div class="user-avatar sm bg-primary">
                                                                <span>${user.firstname[0]}${user.lastname[0]}</span>
                                                            </div>
                                                            <div class="user-name">
                                                                <span class="tb-lead">${user.firstname} ${user.lastname}</span>
                                                            </div>
                                                        </div>
                                                    </li>`;
                                        }).join('') : ''}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class='kanban-item-text'>
                            <pre style='word-break: break-word; white-space: break-spaces;'>${task.description ?? ''}</pre>
                        </div>
                        <ul class='kanban-item-tags'>
                            ${task.labels != null && task.labels != undefined ? JSON.parse(task.labels).map(label => {
                                return `<li><span class='badge badge-outline-light text-dark'>${label}</span></li>`;
                            }).join('') : ''}
                        </ul>
                        <div class='kanban-item-meta'>
                            <ul class='kanban-item-meta-list'>
                                ${task?.deadline != null && task?.labels != undefined ? `<li class='text-danger'><em class='icon ni ni-calendar'></em><span>${task?.deadline}</span></li>` : ''}
                            </ul>
                        </div>`;
            }

            function addNewBoard() {
                // Ajax call to create new board
                $.ajax({
                    url: '{{ route('boards.store') }}',
                    type: 'POST',
                    data: {
                        name: 'New Board',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        kanban.addBoards([{
                            'id': data.board.id,
                            'title': titletemplate('New Board', 0),
                            'class': 'kanban-light',
                            'item': []
                        }]);
                        addBoardFooter(data.board.id);
                        $('#rexarTaskBoard').scrollLeft($('#rexarTaskBoard').get(0).scrollWidth);
                        toastr.success('Board has been created.', 'Created!');
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
                        id: currentBoardId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        toastr.success('Board has been deleted.', 'Deleted!');
                    }
                });
            }

            function editBoardTitle(currentBoardId) {
                var board = kanban.findBoard(currentBoardId);
                var boardTitle = $(board).find('.kanban-title-content .title');
                var borderTopColor = $(board).find('.kanban-board-header').css('borderTopColor');
                var boardTitleText = boardTitle.text();
                var formContainer = document.createElement('div');
                var formInput = document.createElement('input');
                var colorPicker = document.createElement('input');
                var colorPickerVal = document.createElement('input');
                var formSaveButton = document.createElement('button');

                formSaveButton.classList.add('btn', 'btn-sm', 'btn-icon', 'btn-trigger', 'ml-2');
                formSaveButton.innerHTML = 'Save';
                formSaveButton.addEventListener('click', () => saveBoardTitle(currentBoardId));
                formInput.classList.add('form-control', 'form-control-sm', 'form-title', 'mr-1');
                colorPicker.classList.add('color-picker');
                colorPickerVal.classList.add('color-picker-val');
                colorPickerVal.setAttribute('type', 'hidden');
                formInput.value = boardTitleText;
                formContainer.setAttribute('style', 'display: flex;');
                formContainer.appendChild(formInput);
                formContainer.appendChild(colorPicker);
                formContainer.appendChild(colorPickerVal);
                formContainer.appendChild(formSaveButton);
                boardTitle.html(formContainer);
                colorPickerVal.value = borderTopColor;
                const pickr = Pickr.create({
                    el: '.color-picker',
                    theme: 'nano', // or 'monolith', or 'nano'
                    comparison: false,
                    default: borderTopColor,
                    swatches: [
                        'rgba(244, 67, 54, 1)',
                        'rgba(233, 30, 99, 1)',
                        'rgba(156, 39, 176, 1)',
                        'rgba(103, 58, 183, 1)',
                        'rgba(63, 81, 181, 1)',
                        'rgba(33, 150, 243, 1)',
                        'rgba(3, 169, 244, 1)',
                        'rgba(0, 188, 212, 1)',
                        'rgba(0, 150, 136, 1)',
                        'rgba(76, 175, 80, 1)',
                        'rgba(139, 195, 74, 1)',
                        'rgba(205, 220, 57, 1)',
                        'rgba(255, 235, 59, 1)',
                        'rgba(255, 193, 7, 1)'
                    ],
                    components: {
                        // Main components
                        preview: true,
                        opacity: true,
                        hue: true,
                        // Input / output Options
                        interaction: {
                            input: true,
                        }
                    }
                }).on('change', (color, source, instance) => {
                    colorPickerVal.value = color.toHEXA().toString();
                });
                $(board).find('.kanban-title-content .title input').focus();
                $(board).find('.kanban-title-content .drodown').hide();
                $(board).find('.kanban-title-content .board-count').hide();
            }

            function saveBoardTitle(currentBoardId) {
                var board = kanban.findBoard(currentBoardId);
                var newTitle = $(board).find('.kanban-title-content .form-title').val();
                var newColor = $(board).find('.kanban-title-content .color-picker-val').val();
                $(board).find('.kanban-title-content .title').html(newTitle);
                $(board).find('.kanban-board-header').css('borderTopColor', newColor);
                $(board).find('.kanban-title-content .drodown').show();
                $(board).find('.kanban-title-content .board-count').show();
                $.ajax({
                    url: '{{ route('boards.update') }}',
                    type: 'PUT',
                    data: {
                        id: currentBoardId,
                        name: newTitle,
                        color: newColor,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        toastr.success('Board has been updated.', 'Updated!');
                    }
                });
            }

            function addNewTask(e) {
                var currentBoardId = e.currentTarget.closest('.kanban-board').getAttribute('data-id');
                $.ajax({
                    url: '{{ route('tasks.store') }}',
                    type: 'POST',
                    data: {
                        name: 'New Task',
                        board_id: currentBoardId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        kanban.addElement(
                        currentBoardId, {
                            'id': data.task.id,
                            'title': taskTemplate({
                                    name: 'New Task',
                                    description: '',
                                }),
                            }
                        );
                        var board = kanban.findBoard(currentBoardId);
                        var tasksContainer = $(board).find('.kanban-drag');
                        $(tasksContainer).scrollTop($(tasksContainer)[0].scrollHeight);
                        getTasksCountByBoard(board);
                        toastr.success('Task has been created.', 'Created!');
                    }
                });

            }

            function getTasksCountByBoard(currentBoard) {
                var count = $(currentBoard).find('.kanban-item').length;
                $(currentBoard).find('.kanban-title-content .board-count').html(count);
            }

        });
    </script>
@endsection
