@section('title', 'Course')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Course</h3>
                <div class="nk-block-des text-soft">
                </div>
            </div><!-- .nk-block-head-content -->
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
                            <a href="{{ route('course.show', $course->id) }}" class="btn btn-primary">Course elements</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Ooops, Not course</p>
            @endforelse
        </div>
    </div>
@endsection
