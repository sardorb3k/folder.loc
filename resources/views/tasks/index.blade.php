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
                <a class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <form method="POST" action="{{ route('tasks.update') }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        {{-- <div class="col-sm-12"> --}}
                        <div class="title-task form-control-wrap">
                            <input type="text" name="name" class="form-control" id="task-name">
                        </div>
                        {{-- </div> --}}
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
                                        <select class="form-select js-select2" name="users[]" name="users"
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
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });

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
                click: (el) => {
                    var task = tasks.find(task => task.id == el.dataset.eid);
                    console.log(task);
                    console.log(el);
                    $('#task-name').val(task?.name);
                    $('#task-description').val(task?.description);
                    $('#task-deadline').val(task?.deadline);
                    $('#task_id').val(task.id);

                    $('#task').val(el.dataset.eid).modal('show');
                },
                context: (el, e) => {
                    archiveStudent(el.dataset.eid);
                },
                dropEl: (el, target, source, sibling) => {
                    // Ajax update
                    $.ajax({
                        url: "{{ route('tasks.updateBoard') }}",
                        type: 'PUT',
                        data: {
                            task_id: el.dataset.eid,
                            board_id: kanban.getParentBoardID(el.dataset.eid),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success('Task moved successfully');
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

            // Task delete
            async function archiveStudent(id) {
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
                            task_id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                toastr.success('Task has been deleted.', 'Deleted!');
                                kanban.removeElement(id);
                            } else {
                                toastr.error('Task has not been deleted.', 'Failed!');
                            }
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
                console.log(task);
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
                            </div>
                        </div>
                        <div class='kanban-item-text'>
                            <p>${task?.description ?? ''}</p>
                        </div>
                        <ul class='kanban-item-tags'>
                            ${task.labels != null && task.labels != undefined ? JSON.parse(task?.labels)?.map(label => {
                                return `<li><span class='badge badge-outline-light text-dark'>${label.name}</span></li>`;
                            }).join('') : ''}
                        </ul>
                        <div class='kanban-item-meta'>
                            <ul class='kanban-item-meta-list'>
                                ${task?.deadline != null && task?.labels != undefined ? `<li class='text-danger'><em class='icon ni ni-calendar'></em><span>${task?.deadline}</span></li>` : ''}
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
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
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
                        board_id: currentBoardId,
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
                        name: newTitle,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        toastr.success('Board has been updated.', 'Updated!');
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
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        toastr.success('Task has been created.', 'Created!');
                    }
                });
            }
        });
    </script>
@endsection
