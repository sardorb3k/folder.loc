@section('title', 'Course')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create course</h3>
                <div class="nk-block-des text-soft">
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('course.store') }}" class="form-validate" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-box"></em>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name"
                                        tabindex="1" value="{{ old('name') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="videolink">Video link
                                    <span class="valid-form">*</span></label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-link"></em>
                                    </div>
                                    <input type="text" class="form-control" id="videolink" name="videolink"
                                        value="{{ old('videolink') }}" tabindex="2" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" onclick="this.form.setAttribute('novalidate', 'novalidate');"
                                    class="btn btn-lg btn-primary" tabindex="14">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection
