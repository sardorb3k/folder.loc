@section('title', 'Create Student')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Settings</h3>
            <div class="nk-block-des">
                <p>CRM all settings</p>
            </div>
        </div>
        @if (session('success') || session('error'))
            <div class="example-alert">
                <div class="alert alert-primary alert-icon">
                    <em class="icon ni ni-alert-circle"></em> <strong>Message</strong>. {{ session('success') }}
                    {{ session('error') }}
                </div>
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
                <form action="{{ route('settings.store') }}" class="form-validate" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="attendance_day">Attendance day
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control" id="attendance_day" name="attendance_day"
                                        tabindex="1" value="{{ $info->attendance_day }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" onclick="this.form.setAttribute('novalidate', 'novalidate');'"
                                    class="btn btn-lg btn-primary" tabindex="14">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->

@endsection
