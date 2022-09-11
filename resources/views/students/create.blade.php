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
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ route('students.store') }}" class="form-validate"
                method="post">
                @csrf
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="firstname">First name
                                *</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-user"></em>
                                </div>
                                <input type="text" class="form-control"
                                    id="firstname" name="firstname" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="lastname">Last name
                                *</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-user"></em>
                                </div>
                                <input type="text" class="form-control"
                                    id="lastname" name="lastname" required="">
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
                                <input type="text" class="form-control"
                                    id="fv-email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Phone
                                *</label>
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="fv-phone">+998</span>
                                    </div>
                                    <input type="tel" class="form-control"
                                        id="phone"
                                        pattern="^\d{2}-\d{3}-\d{2}-\d{2}$"
                                        name="phone" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-phone">Sex /
                                Gender *</label>
                            <div class="form-control-wrap">
                                <ul class="custom-control-group">
                                    <li>
                                        <div
                                            class="custom-control custom-radio custom-control-pro no-control">
                                            <input type="radio"
                                                class="custom-control-input"
                                                name="gender" id="sex-male"
                                                value="male" required="">
                                            <label class="custom-control-label"
                                                for="sex-male">Male</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div
                                            class="custom-control custom-radio custom-control-pro no-control">
                                            <input type="radio"
                                                class="custom-control-input"
                                                name="gender" id="sex-female"
                                                value="female" required="">
                                            <label class="custom-control-label"
                                                for="sex-female">Female</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Birth day *</label>
                            <div class="form-control-wrap focused">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-gift"></em>
                                </div>
                                <input type="text"
                                    class="form-control date-picker-alt"
                                    name="birthday"
                                    data-date-format="yyyy-mm-dd" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="password">Password
                                *</label>
                            <div class="form-control-wrap">
                                <a href="#"
                                    class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password">
                                    <em
                                        class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em
                                        class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="password"
                                    class="form-control form-control-lg"
                                    id="password" required
                                    autocomplete="current-password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label"
                                for="password_confirmation">Password
                                Confirmation *</label>
                            <div class="form-control-wrap">
                                <a href="#"
                                    class="form-icon form-icon-right passcode-switch lg"
                                    data-target="password_confirmation">
                                    <em
                                        class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em
                                        class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control form-control-lg"
                                    id="password_confirmation" required
                                    autocomplete="current-password">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-homeaddress">Home
                                address *</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                    id="fv-homeaddress" name="homeaddress">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-why-english">Why
                                are you ging to learn english *</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                    id="fv-why-english" name="whyenglish">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label"
                                for="fv-enteresteds">Interests *</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                    id="fv-interests" name="interests">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-about">Where did you hear about us*</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                    id="fv-about" name="hear_about">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fv-about">Course
                                *</label>
                            <ul class="custom-control-group">
                                <li>
                                    <div
                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            name="course[]"
                                            id="btnCheckControl1"><label
                                            class="custom-control-label"
                                            for="btnCheckControl1">English Language</label>
                                    </div>
                                </li>
                                <li>
                                    <div
                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            name="course[]"
                                            id="btnCheckControl2"><label
                                            class="custom-control-label"
                                            for="btnCheckControl2">Web Development</label>
                                    </div>
                                </li>
                                <li>
                                    <div
                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            name="course[]"
                                            id="btnCheckControl3"><label
                                            class="custom-control-label"
                                            for="btnCheckControl3">Mobile App Development</label>
                                    </div>
                                </li>
                                <li>
                                    <div
                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro checked">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            name="course[]"
                                            id="btnCheckControl5"><label
                                            class="custom-control-label"
                                            for="btnCheckControl5">Game Development</label>
                                    </div>
                                </li>
                                <li>
                                    <div
                                        class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                        <input type="checkbox"
                                            class="custom-control-input"
                                            name="course[]"
                                            id="btnCheckControl6"
                                            disabled=""><label
                                            class="custom-control-label"
                                            for="btnCheckControl6">Graphic Design</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit"
                                onclick="this.form.setAttribute('novalidate', 'novalidate');'"
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
        $(document).ready(function(){
            $('.phone').inputmask('(999)-999-9999');
        });
</script>
@endsection