@section('title', 'Create Group')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Create Group</h3>
            {{-- <div class="nk-block-des">
                <p>You have full control to manage your own account setting.</p>
            </div> --}}
        </div>
        @if ($errors->any())
            <div class="example-alert">
                <div class="alert alert-pro alert-danger">
                    <div class="alert-text">
                        <h6>Whoops! <strong>There were some problems with your input.</strong></h6>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <form action="{{ route('groups.store') }}" class="form-validate" novalidate="novalidate"
                    method="post">
                    @csrf
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="firstname" name="name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Lesson start time</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control time-picker" name="lessonstarttime"
                                        placeholder="Time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Lesson end time</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control time-picker" name="lessonendtime"
                                        placeholder="Time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-email">Teacher</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="teacher_id" id="default-06" required>
                                            @foreach ($teachers as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->lastname . ' ' . $item->firstname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-email">Assestent</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="assistant_id" id="default-06" required>
                                            @foreach ($assistants as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->lastname . ' ' . $item->firstname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-phone">Days</label>
                                <div class="form-control-wrap">
                                    <ul class="custom-control-group">
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="days"
                                                    id="sex-odd" value="odd" required="">
                                                <label class="custom-control-label" for="sex-odd">Odd</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="days"
                                                    id="sex-even" value="even" required="">
                                                <label class="custom-control-label" for="sex-even">Even</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-email">Level</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="level" id="default-06" required>
                                            <option value="beginner">Beginner</option>
                                            <option value="elementary">Elemantary</option>
                                            <option value="pre-intermediate">Pre-Intermediate</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="upper-intermediate">Upper-Intermediate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection
