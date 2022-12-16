@section('title', 'Course')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Course item</h3>
                <div class="nk-block-des text-soft">
                </div>
            </div><!-- .nk-block-head-content -->
            @if (Auth::user()->getRole() == 'admin' or Auth::user()->getRole() == 'superadmin')
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('course.create', $id) }}" class="btn btn-icon btn-primary">
                                    <em class="icon ni ni-plus"></em>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div>
            @endif
        </div><!-- .nk-block-between -->
        @include('error')
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            @forelse ($courses as $course)
                <div class="col-sm-6 col-lg-4 col-xxl-3">
                    <div class="card card-bordered">
                        {{-- <img src="https://dashlite.net/demo4/images/slides/slide-a.jpg" class="card-img-top" alt=""> --}}
                        <div class="card-inner">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <a href="{{ route('course.course', ['id' => $id, 'courseid' => $course->id]) }}" class="btn btn-primary">Video</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No course items found</p>
            @endforelse
        </div>
    </div>
@endsection
