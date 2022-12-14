@section('title', $teacher->lastname . ' ' . $teacher->firstname)
@extends('layouts.app')
@section('content') <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers List</a></li>
                    <li class="breadcrumb-item active">Teacher Profile</li>
                </ul>
            </nav>
            <h3 class="nk-block-title page-title">{{ $teacher->lastname . ' ' . $teacher->firstname }}</h3>
            <div class="nk-block-des">
                <p>You have full control to manage your own account setting.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    @include('error')
    <div class="nk-block">
        <div class="card card-bordered">
            @include('teachers.navigation-menu', ['id' => $teacher->id])
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Personal Information</h4>
                        <div class="nk-block-des">
                            <p>Basic info, like your name and address, that you use on CRM Platform.</p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="nk-data data-list data-list-s2">
                        <div class="data-head">
                            <h6 class="overline-title">Basics</h6>
                        </div>
                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Full Name</span>
                                <span class="data-value">{{ $teacher->lastname . ' ' . $teacher->firstname }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Phone Number</span>
                                <span class="data-value text-soft">
                                    <input type="text"
                                        class="phone border-0 bg-transparent text-soft no-focus-outline cursor-pointer"
                                        value="{{ $teacher->phone }}" readonly>
                                </span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more disable"><em
                                        class="icon ni ni-lock-alt"></em></span></div>
                        </div><!-- data-item -->
                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Date of Birth</span>
                                <span class="data-value">{{ $teacher->birthday }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address">
                            <div class="data-col">
                                <span class="data-label">Gender</span>
                                <span class="data-value">{{ $teacher->gender == 'male' ? 'Male' : 'Female' }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                    </div><!-- data-list -->
                </div><!-- .nk-block -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->

    @if (Auth::user()->getRole() == 'superadmin')
        <div class="modal fade" role="dialog" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">Update Teacher Profile</h5>
                        <ul class="nk-nav nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password">Password</a>
                            </li>
                        </ul><!-- .nav-tabs -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="personal">
                                <form action="{{ route('teachers.update', $teacher->id) }}" class="form-validate"
                                    novalidate="novalidate" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="firstname">First name <span
                                                        class="valid-form">*</span></label>
                                                <input type="text" class="form-control form-control-lg" name="firstname"
                                                    id="firstname" value="{{ $teacher->firstname }}"
                                                    placeholder="Enter First name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="lastname">Last name <span
                                                        class="valid-form">*</span></label>
                                                <input type="text" class="form-control form-control-lg"
                                                    name="lastname" id="lastname" value="{{ $teacher->lastname }}"
                                                    placeholder="Enter Last name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-phone">Sex / Gender <span
                                                        class="valid-form">*</span></label>
                                                <div class="form-control-wrap">
                                                    <ul class="custom-control-group">
                                                        <li>
                                                            <div
                                                                class="custom-control custom-radio custom-control-pro no-control">
                                                                <input type="radio" class="custom-control-input"
                                                                    name="gender" id="sex-male" value="male"
                                                                    @if ($teacher->gender == 'male') checked @endif
                                                                    required="">
                                                                <label class="custom-control-label"
                                                                    for="sex-male">Male</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div
                                                                class="custom-control custom-radio custom-control-pro no-control">
                                                                <input type="radio" class="custom-control-input"
                                                                    name="gender" id="sex-female" value="female"
                                                                    @if ($teacher->gender == 'female') checked @endif
                                                                    required="">
                                                                <label class="custom-control-label"
                                                                    for="sex-female">Female</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-phone">Role <span
                                                        class="valid-form">*</span></label>
                                                <div class="form-control-wrap">
                                                    <ul class="custom-control-group">
                                                        <li>
                                                            <div
                                                                class="custom-control custom-radio custom-control-pro no-control">
                                                                <input type="radio" class="custom-control-input"
                                                                    name="role" id="role-teacher" value="teacher"
                                                                    @if ($teacher->role == 'teacher') checked @endif
                                                                    required="">
                                                                <label class="custom-control-label"
                                                                    for="role-teacher">Teacher</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div
                                                                class="custom-control custom-radio custom-control-pro no-control">
                                                                <input type="radio" class="custom-control-input"
                                                                    @if ($teacher->role == 'assistant') checked @endif
                                                                    name="role" id="role-assistant" value="assistant"
                                                                    required="">
                                                                <label class="custom-control-label"
                                                                    for="role-assistant">Assistant</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone-no">Phone Number <span
                                                        class="valid-form">*</span></label>
                                                <input type="phone" class="phone form-control form-control-lg"
                                                    name="phone" id="phone" value="{{ $teacher->phone }}"
                                                    placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="birth-day">Date of Birth <span
                                                        class="valid-form">*</span></label>
                                                <input type="text" class="form-control date-picker-alt"
                                                    name="birthday" onkeydown="return false"
                                                    value="{{ $teacher->birthday }}" data-date-format="yyyy-mm-dd"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group"><label class="form-label">Image upload</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="form-file-input" name="imageupload"
                                                            tabindex="9" id="imageupload">
                                                        <label class="form-file-label" for="imageupload">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="custom-control custom-switch">
                                                <img src="{{ asset('uploads/teacher/' . $teacher->image) }}" height="100"
                                                    width="100">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="custom-control custom-switch">
                                                <input name="status" type="hidden" value="inactive">
                                                <input type="checkbox" name="status" class="custom-control-input"
                                                    value="active" @if ($teacher->status == 'active') checked @endif
                                                    id="latest-sale">
                                                <label class="custom-control-label" for="latest-sale">Status</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <input type="hidden" name="update_action" value="personal">
                                                    <input type="hidden" name="id" value="{{ $teacher->id }}">
                                                    <a href="#"
                                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                        class="btn btn-lg btn-primary">Update
                                                        Profile</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-dismiss="modal"
                                                        class="link link-light">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- .tab-pane -->
                            <div class="tab-pane" id="password">
                                <form action="{{ route('teachers.update', $teacher->id) }}" class="form-validate"
                                    novalidate="novalidate" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password <span
                                                        class="valid-form">*</span></label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-lock"></em>
                                                    </div>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="password_confirmation">Confirm
                                                    Password <span class="valid-form">*</span></label>
                                                <div class="form-control-wrap">
                                                    <div class="toggle-password form-icon form-icon-right">
                                                        <em class="icon ni ni-lock"></em>
                                                    </div>
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation"
                                                        required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                                <li>
                                                    <input type="hidden" name="update_action" value="password">
                                                    <input type="hidden" name="id" value="{{ $teacher->id }}">
                                                    <a href="#"
                                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                        class="btn btn-lg btn-primary">Update
                                                        Address</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-dismiss="modal"
                                                        class="link link-light">Cancel</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- .tab-pane -->
                        </div><!-- .tab-content -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->
    @endif
    <script>
        $(".phone").inputmask({
            "mask": "+999 (99) 999-99-99"
        });
    </script>
@endsection
