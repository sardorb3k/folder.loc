@section('title', 'Create Teacher')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers List</a></li>
                    <li class="breadcrumb-item active">Create Teacher</li>
                </ul>
            </nav>
            <h3 class="nk-block-title page-title">Create Teacher</h3>
            <div class="nk-block-des">
                <p>Fill in the entire line to create a new reader.</p>
            </div>
        </div>
    </div><!-- .nk-block-head -->

    @if ($errors->any())
        <div class="example-alert">
            <div class="alert alert-primary alert-icon">
                <em class="icon ni ni-alert-circle"></em>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('teachers.store') }}" class="form-validate" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname">First name <span
                                        class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        tabindex="1" required="" autocomplete="firstname"
                                        value="{{ old('firstname') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Last name <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required=""
                                        tabindex="2" autocomplete="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Phone <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fv-phone">+998</span>
                                        </div>
                                        <input id="phone" type="phone" class="form-control" tabindex="3"
                                            pattern="^\d{2}-\d{3}-\d{2}-\d{2}$" name="phone" required=""
                                            autocomplete="phone">
                                    </div>
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
                                    <input type="text" class="form-control date-picker-alt" name="birthday" onkeydown="return false" 
                                        tabindex="4" data-date-format="yyyy-mm-dd" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password">Password <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch toggle-password"
                                        data-target="password_confirmation">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" class="form-control" id="password" name="password"
                                        tabindex="5" required="" autocomplet="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm Password <span
                                        class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <a href="#" class="form-icon form-icon-right passcode-switch toggle-password"
                                        data-target="password_confirmation">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input type="password" class="form-control toggle-password" id="password_confirmation"
                                        tabindex="6" name="password_confirmation" required=""
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Sex / Gender <span
                                        class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <ul class="custom-control-group" tabindex="7">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Role <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <ul class="custom-control-group" tabindex="8">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="role"
                                                    id="role-teacher" value="teacher" required="">
                                                <label class="custom-control-label" for="role-teacher">Teacher</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="role"
                                                    id="role-assistant" value="assistant" required="">
                                                <label class="custom-control-label" for="role-assistant">Assistant</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group"><label class="form-label">Image upload</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" name="imageupload" tabindex="9"
                                            id="imageupload" required>
                                        <label class="form-file-label" for="imageupload">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" tabindex="10"
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
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $("#phone").inputmask({
            "mask": "(99) 999-9999"
        });
    </script>
@endsection
