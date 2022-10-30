@section('title', 'Group ' . $group->name)
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <nav>
                <ul class="breadcrumb breadcrumb-arrow">
                    <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Groups List</a></li>
                    <li class="breadcrumb-item active">Edit Group</li>
                </ul>
            </nav>
            <h3 class="nk-block-title page-title">Group Edit</h3>
            <div class="nk-block-des">
                <p>{{ $group->level }} {{ $group->name }}</p>
            </div>
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
                <form action="{{ route('groups.update', $group->id) }}" class="form-validate" novalidate="novalidate"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="firstname">Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="firstname" name="name"
                                        value="{{ $group->name }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Lesson start time</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control time-picker" name="lessonstarttime"
                                    value="{{ $group->lessonstarttime }}" placeholder="Time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Lesson end time</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control time-picker" name="lessonendtime"
                                    value="{{ $group->lessonendtime }}" placeholder="Time" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-teacher">Teacher</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="teacher_id" id="fv-teacher" required>
                                            @foreach ($teachers as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $group->teacher_id ? 'selected' : '' }}>
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
                                <label class="form-label" for="fv-assistants">Assestent</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="assistant_id" id="fv-assistants" required>
                                            @foreach ($assistants as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $group->assistant_id ? 'selected' : '' }}>
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
                                                    id="day_odd" value="odd" required=""
                                                    @if ($group->days == 'odd') checked @endif>
                                                <label class="custom-control-label" for="day_odd">Odd</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio custom-control-pro no-control">
                                                <input type="radio" class="custom-control-input" name="days"
                                                    id="day_even" value="even" required=""
                                                    @if ($group->days == 'even') checked @endif>
                                                <label class="custom-control-label" for="day_even">Even</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fv-level">Level</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control" name="level" id="fv-level" required>
                                            @forelse ($grouplevel as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $group->level ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @empty
                                                <option value="">No level</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $group->id }}">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection
