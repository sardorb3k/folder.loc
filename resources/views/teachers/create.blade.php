@section('title', 'Create Teacher')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
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
                <form action="{{ route('teachers.store') }}" class="form-validate" method="post">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname">First name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        required="" autocomplete="firstname">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Last name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required=""
                                        autocomplete="lastname">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Phone</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fv-phone">+998</span>
                                        </div>
                                        <input type="tel" class="form-control" pattern="^\d{2}-\d{3}-\d{2}-\d{2}$"
                                            name="phone" required="" autocomplete="phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Birth day</label>
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
                                <label class="form-label" for="password">Password</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-lock"></em>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password"
                                        required="" autocomplet="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="form-control-wrap">
                                    <div class="toggle-password form-icon form-icon-right">
                                        <em class="icon ni ni-lock"></em>
                                    </div>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required="" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Sex / Gender</label>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" onclick="this.form.setAttribute('novalidate', 'novalidate');'"  class="btn btn-lg btn-primary">Create</button>
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
    </script>
@endsection
