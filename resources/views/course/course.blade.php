@section('title', 'Course')
@extends('layouts.app')
@section('content')
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />

    <div class="nk-block-head">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $course->name }}</h3>
                <div class="nk-block-des text-soft">
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <iframe width="800" height="360" src="{{ $course->videolink }}" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>
@endsection
