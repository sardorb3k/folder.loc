@section('title', 'Create Student')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Create Student</h3>
            <div class="nk-block-des">
                <p>Fill in the entire line to create a new reader.</p>
            </div>
        </div>
        @if (session('success') || session('error'))
            <div
                class="callout @if (session('error')) callout-danger @endif @if (session('success')) callout-success @endif">
                <h5>Message</h5>
                {{ session('success') }} {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="example-alert">
                <div class="alert alert-danger alert-icon alert-dismissible"><em class="icon ni ni-cross-circle"></em>
                    <strong>Message</strong>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <button class="close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('students.store') }}" class="form-validate" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname">First name
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Last name
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-email">Email
                                    address</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-mail"></em>
                                    </div>
                                    <input type="text" class="form-control" id="fv-email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Phone
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fv-phone">+998</span>
                                        </div>
                                        <input type="phone" class="form-control" id="phone"
                                            pattern="^\d{2}-\d{3}-\d{2}-\d{2}$" name="phone" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Sex /
                                    Gender <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <ul class="custom-control-group">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="sex-male" value="male" required="">
                                                <label class="custom-control-label" for="sex-male">Male</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="sex-female" value="female" required="">
                                                <label class="custom-control-label" for="sex-female">Female</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Birth day <span class="valid-form">*</span></label>
                                <div class="form-control-wrap focused">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-gift"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker-alt" name="birthday"
                                        data-date-format="yyyy-mm-dd" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password">Password
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="password" required autocomplete="current-password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Password
                                    Confirmation <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                        data-target="password_confirmation">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg" id="password_confirmation" required
                                        autocomplete="current-password">
                                </div>
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
                                    <input type="text" class="form-control" id="fv-homeaddress" name="homeaddress"
                                        required>
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
                                    <input type="text" class="form-control" id="fv-why-english" name="reasontostudy"
                                        required>
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
                                    <input type="text" class="form-control" id="fv-interests" name="interests"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label class="form-label">Image upload</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" name="imageupload"
                                            id="imageupload">
                                        <label class="form-file-label" for="imageupload">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-about">Where did you hear about us
                                    <span class="valid-form">*</span></label>
                                <ul class="custom-control-group" id="hear_about">
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="friends" id="friends"><label class="custom-control-label"
                                                for="friends">Friends</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="relatives" id="Relatives"><label class="custom-control-label"
                                                for="Relatives">Relatives</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="teacher" id="teacher"><label class="custom-control-label"
                                                for="teacher">Teacher</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div
                                            class="custom-control custom-control-sm custom-radio custom-control-pro checked">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="banner" id="banner"><label class="custom-control-label"
                                                for="banner">Banner</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="social_media" id="social_media"><label
                                                class="custom-control-label" for="social_media">Social media</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="flyer" id="flyer"><label class="custom-control-label"
                                                for="flyer">Flyer</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="seminar" id="seminar"><label class="custom-control-label"
                                                for="seminar">Seminar</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-radio custom-control-pro">
                                            <input type="radio" class="custom-control-input" name="hear_about"
                                                value="others-radio" id="others-radio"><label
                                                class="custom-control-label" for="others-radio">
                                                <input type="text" id="others" name="hear_about"
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
                                        <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                            <input type="checkbox" class="custom-control-input" name="course[]"
                                                value="englishlanguage" id="englishlanguage"><label
                                                class="custom-control-label" for="englishlanguage">English
                                                Language</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                            <input type="checkbox" class="custom-control-input" name="course[]"
                                                value="webdevelopment" id="webdevelopment"><label
                                                class="custom-control-label" for="webdevelopment">Web Development</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                            <input type="checkbox" class="custom-control-input" name="course[]"
                                                value="mobiledevelopment" id="mobiledevelopment"><label
                                                class="custom-control-label" for="mobiledevelopment">Mobile App
                                                Development</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div
                                            class="custom-control custom-control-sm custom-checkbox custom-control-pro checked">
                                            <input type="checkbox" class="custom-control-input" name="course[]"
                                                value="gamedevelopment" id="gamedevelopment"><label
                                                class="custom-control-label" for="gamedevelopment">Game
                                                Development</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                            <input type="checkbox" class="custom-control-input" name="course[]"
                                                value="graphicdesign" id="graphicdesign"><label
                                                class="custom-control-label" for="graphicdesign">Graphic Design</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" onclick="this.form.setAttribute('novalidate', 'novalidate');'"
                                    class="btn btn-lg btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->

    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("form-icon form-icon-right");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).ready(function() {
            $('.phone').inputmask('(999)-999-9999');
        });


        $('#others').click(() => {
            $('#others-radio').prop('checked', true);
            $("#others").attr('name', 'hear_about');
        });
        // Others
        $('#hear_about input').on('change', function() {
            if ($(this).val() == 'others-radio') {
                $("#others").attr('name', 'hear_about');
            } else {
                $("#others").attr('name', '');
            }
            // alert($('input[name=hear_about]:checked', '#hear_about').val());
        });
        $("#phone").inputmask({
            "mask": "(99) 999-9999"
        });
    </script>
@endsection
