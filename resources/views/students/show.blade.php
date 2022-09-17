@section('title', $student->lastname . ' ' . $student->firstname)
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">{{ $student->lastname . ' ' . $student->firstname }}</h3>
            <div class="nk-block-des">
                <p>You have full control to manage your own account setting.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    @include('error')
    <div class="nk-block">
        <div class="card card-bordered">
            @include('students.navigation-menu', ['id' => $student->id])
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Personal Information</h4>
                        <div class="nk-block-des">
                            <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="nk-data data-list data-list-s2">
                        <div class="data-head">
                            <h6 class="overline-title">Basics</h6>
                        </div>
                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Full Name</span>
                                <span class="data-value">{{ $student->lastname . ' ' . $student->firstname }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                        {{-- <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Email</span>
                                <span
                                    class="data-value">{{ $student->email == null ? 'Not add yet' : $student->email }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item --> --}}
                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Phone Number</span>
                                <span class="data-value text-soft">{{ $student->phone }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more disable"><em
                                        class="icon ni ni-lock-alt"></em></span></div>
                        </div><!-- data-item -->
                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                            <div class="data-col">
                                <span class="data-label">Date of Birth</span>
                                <span class="data-value">{{ $student->birthday }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                        <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                            <div class="data-col">
                                <span class="data-label">Gender</span>
                                <span class="data-value">{{ $student->gender == 'male' ? 'Male' : 'Female' }}</span>
                            </div>
                            <div class="data-col data-col-end"><span class="data-more"><em
                                        class="icon ni ni-forward-ios"></em></span></div>
                        </div><!-- data-item -->
                    </div><!-- data-list -->
                </div><!-- .nk-block -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Update Student Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#password">Password</a>
                        </li>
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <form action="{{ route('students.update', $student->id) }}" class="form-validate"
                                novalidate="novalidate" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="firstname">First name *</label>
                                            <input type="text" class="form-control form-control-lg" name="firstname"
                                                id="firstname" value="{{ $student->firstname }}"
                                                placeholder="Enter First name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="lastname">Last name *</label>
                                            <input type="text" class="form-control form-control-lg" name="lastname"
                                                id="lastname" value="{{ $student->lastname }}"
                                                placeholder="Enter Last name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-phone">Sex / Gender *</label>
                                            <div class="form-control-wrap">
                                                <ul class="custom-control-group">
                                                    <li>
                                                        <div
                                                            class="custom-control custom-radio custom-control-pro no-control">
                                                            <input type="radio" class="custom-control-input"
                                                                name="gender" id="sex-male" value="male"
                                                                @if ($student->gender == 'male') checked @endif
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
                                                                @if ($student->gender == 'female') checked @endif
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
                                            <label class="form-label" for="phone-no">Phone Number *</label>
                                            <input type="tel" class="form-control form-control-lg" name="phone"
                                                id="phone-no" value="{{ $student->phone }}" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="birth-day">Date of Birth *</label>
                                            <input type="text" class="form-control date-picker-alt" name="birthday"
                                                value="{{ $student->birthday }}" data-date-format="yyyy-mm-dd" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-homeaddress">Home
                                                address <span class="valid-form">*</span></label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-home"></em>
                                                </div>
                                                <input type="text" class="form-control" id="fv-homeaddress"
                                                    value="{{ $student->homeaddress }}" name="homeaddress" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-why-english">Why
                                                are you ging to learn english <span class="valid-form">*</span></label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-target"></em>
                                                </div>
                                                <input type="text" class="form-control" id="fv-why-english"
                                                    value="{{ $student->reasontostudy }}" name="reasontostudy" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-enteresteds">Interests <span
                                                    class="valid-form">*</span></label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-tag"></em>
                                                </div>
                                                <input type="text" class="form-control" id="fv-interests"
                                                    value="{{ $student->interests }}" name="interests" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-about">Where did you hear about us
                                                <span class="valid-form">*</span></label>
                                            <ul class="custom-control-group" id="hear_about">
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about" value="friends"
                                                            {{ $student->hear_about == 'friends' ? 'checked' : '' }}
                                                            id="friends"><label class="custom-control-label"
                                                            for="friends">Friends</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'relatives' ? 'checked' : '' }}
                                                            value="relatives" id="Relatives"><label
                                                            class="custom-control-label" for="Relatives">Relatives</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'teacher' ? 'checked' : '' }}
                                                            value="teacher" id="teacher"><label
                                                            class="custom-control-label" for="teacher">Teacher</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro checked">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'banner' ? 'checked' : '' }}
                                                            value="banner" id="banner"><label
                                                            class="custom-control-label" for="banner">Banner</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'social_media' ? 'checked' : '' }}
                                                            value="social_media" id="social_media"><label
                                                            class="custom-control-label" for="social_media">Social
                                                            media</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'flyer' ? 'checked' : '' }}
                                                            value="flyer" id="flyer"><label
                                                            class="custom-control-label" for="flyer">Flyer</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'seminar' ? 'checked' : '' }}
                                                            value="seminar" id="seminar"><label
                                                            class="custom-control-label" for="seminar">Seminar</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-radio custom-control-pro">
                                                        <input type="radio" class="custom-control-input"
                                                            name="hear_about"
                                                            {{ $student->hear_about == 'others-radio' ? 'checked' : '' }}
                                                            value="others-radio" id="others-radio"><label
                                                            class="custom-control-label" for="others-radio">
                                                            <input type="text" id="others"
                                                                value="{{ $student->hear_about == 'others-radio' ? $student->hear_about : '' }}"
                                                                class="form-control" placeholder="Others">

                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-about">Course
                                                <span class="valid-form">*</span></label>
                                            <ul class="custom-control-group">
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="course[]"
                                                            {{ in_array('englishlanguage', json_decode($student->course)) ? 'checked' : '' }}
                                                            value="englishlanguage" id="englishlanguage"><label
                                                            class="custom-control-label" for="englishlanguage">English
                                                            Language</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="course[]"
                                                            {{ in_array('webdevelopment', json_decode($student->course)) ? 'checked' : '' }}
                                                            value="webdevelopment" id="webdevelopment"><label
                                                            class="custom-control-label" for="webdevelopment">Web
                                                            Development</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="course[]"
                                                            {{ in_array('mobiledevelopment', json_decode($student->course)) ? 'checked' : '' }}
                                                            value="mobiledevelopment" id="mobiledevelopment"><label
                                                            class="custom-control-label" for="mobiledevelopment">Mobile
                                                            App
                                                            Development</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro checked">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="course[]"
                                                            {{ in_array('gamedevelopment', json_decode($student->course)) ? 'checked' : '' }}
                                                            value="gamedevelopment" id="gamedevelopment"><label
                                                            class="custom-control-label" for="gamedevelopment">Game
                                                            Development</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="course[]"
                                                            {{ in_array('graphicdesign', json_decode($student->course)) ? 'checked' : '' }}
                                                            value="graphicdesign" id="graphicdesign"><label
                                                            class="custom-control-label" for="graphicdesign">Graphic
                                                            Design</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="graduation" class="custom-control-input"
                                                @if ($student->status == 'active') checked @endif id="latest-sale">
                                            <label class="custom-control-label" for="latest-sale">Status </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="hidden" name="update_action" value="personal">
                                                <input type="hidden" name="id" value="{{ $student->id }}">
                                                <a href="#"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                    class="btn btn-lg btn-primary">Update
                                                    Profile</a>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .tab-pane -->
                        <div class="tab-pane" id="password">
                            <form action="{{ route('students.update', $student->id) }}" class="form-validate"
                                novalidate="novalidate" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password *</label>
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
                                                Password *</label>
                                            <div class="form-control-wrap">
                                                <div class="toggle-password form-icon form-icon-right">
                                                    <em class="icon ni ni-lock"></em>
                                                </div>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <input type="hidden" name="update_action" value="password">
                                                <input type="hidden" name="id" value="{{ $student->id }}">
                                                <a href="#"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                    class="btn btn-lg btn-primary">Update
                                                    Address</a>
                                            </li>
                                            <li>
                                                <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
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


    <script>
        $("#phone-no").inputmask({
            "mask": "998 (99) 999-99-99"
        });
    </script>
@endsection
