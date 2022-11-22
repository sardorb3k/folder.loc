<div>
    {{-- updateMode  --}}
    @if (!$updateMode)
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Enter firstname"
                                    wire:model="firstname" required>
                                @error('firstname')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Enter lastname"
                                    wire:model="lastname" required>
                                @error('lastname')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="email" class="form-control" id="phone" wire:model="phone"
                                    placeholder="Enter phone" required>
                                @error('phone')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label" for="role">Roles</label>
                                    <select class="form-control" name="role" id="role" wire:model="role"
                                        required>
                                        <option value="superadmin">SEO</option>
                                        <option value="admin">Admin</option>
                                        <option value="accounting">Accounting</option>
                                        <option value="marketing">Marketing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" placeholder="Enter password"
                                    wire:model="password" required>
                                @error('password')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('livewire.update')
    @endif
    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">x
            {{ session('message') }}
        </div>
    @endif
    <div class="nk-block-head">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Staff Lists</h3>
                <div class="nk-block-des text-soft">
                    <p>You have total {{ count($users) }} staff.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            {{-- <li>
                                <a href="{{ route('students.archives') }}" class="btn btn-white btn-outline-light">
                                    <em class="icon ni ni-archived"></em>
                                    <span>Archives</span>
                                </a>
                            </li> --}}
                            @include('livewire.create')
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    @include('error')
    <table class="nk-tb-list nk-tb-ulist no-footer" data-auto-responsive="false">
        <thead>
            <tr class="nk-tb-item nk-tb-head">
                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">#</span>
                </th>
                <th class="nk-tb-col sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1"
                    colspan="1">
                    <span class="sub-text">Student</span>
                </th>
                <th class="nk-tb-col tb-col-mb sorting" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1">
                    <span class="sub-text">Phone</span>
                </th>
                <th class="nk-tb-col tb-col-md sorting" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1">
                    <span class="sub-text">Birthday</span>
                </th>
                <th class="nk-tb-col tb-col-lg sorting" tabindex="0" aria-controls="DataTables_Table_1"
                    rowspan="1" colspan="1">
                    <span class="sub-text">Role</span>
                </th>
                <th class="nk-tb-col nk-tb-col-tools text-end sorting" tabindex="0"
                    aria-controls="DataTables_Table_1" rowspan="1" colspan="1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $student_data)
                <tr class="nk-tb-item odd">
                    <td class="nk-tb-col nk-tb-col-check sorting_1">
                        <span>{{ $loop->iteration }}</span>
                    </td>
                    <td class="nk-tb-col">
                        <div class="user-card">
                            <a href="{{ route('students.show', $student_data->id) }}">
                                <div class="user-card">
                                    <div class="user-avatar"
                                        style="{{ $student_data->image ? '' : 'background: #798bff;' }}">
                                        <img src="{{ $student_data->image ? asset('uploads/student/' . $student_data->image) : 'https://ui-avatars.com/api/?name=' . $student_data->lastname . '+' . $student_data->firstname . '&background=random' }}"
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
                        <input type="text"
                            class="phone border-0 bg-transparent text-soft no-focus-outline cursor-pointer"
                            value="{{ $student_data->phone }}"
                            onclick="window.location = 'tel:+{{ $student_data->phone }}'" readonly>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ date('d M, Y', strtotime($student_data->birthday)) }}</span>
                    </td>
                    <td class="nk-tb-col tb-col-lg">
                        <span>{{ $student_data->role }}</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                        data-toggle="dropdown" aria-expanded="true">
                                        <em class="icon ni ni-more-h"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <ul class="link-list-opt no-bdr">
                                            <li>
                                                <a data-toggle="modal" data-target="#updateModal"
                                                    wire:click="edit({{ $student_data->id }})">
                                                    <em class="icon ni ni-edit"></em>
                                                    <span>Edit</span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            {{-- <form action="{{ route('students.archive', $student_data->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT') --}}
                                                {{-- <input id="archive_reason" type="hidden" name="archive_reason"
                                                    value=""> --}}
                                                <li class="cursor-pointer">
                                                    <a wire:click="delete({{ $student_data->id }})">
                                                        <em class="icon ni ni-archive"></em><span>Archive</span>
                                                    </a>
                                                </li>
                                            {{-- </form> --}}
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

        async function archiveStudent(element) {
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "Please enter a reason.",
                input: 'text',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Archive',
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    if (reason == '') {
                        Swal.showValidationMessage(
                            `Please enter a reason`
                        )
                    }
                    $('#archive_reason').val(reason);
                },
                allowOutsideClick: () => !Swal.isLoading()
            });

            if (result.isConfirmed) {
                await element.closest('form').submit();
            }

        }
    </script>
</div>
