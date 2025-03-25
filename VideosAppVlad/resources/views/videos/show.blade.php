@extends('layouts.videos-app-layout')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="max-width: 800px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <!-- Header -->
            <div class="card-header d-flex justify-content-center align-items-center text-center" style="border-radius: 15px 15px 0 0; background-color: #007bff; color: white; border: 2px solid #007bff;">
                <h1 class="mb-0 font-weight-bold">{{ $video->title }}</h1>
            </div>

            <!-- Subtitle -->
            <div class="card-subtitle text-center py-3" style="background-color: #f8f9fa; color: #333;">
                <h5 class="mb-0">{{ $video->description }}</h5>
            </div>

            <!-- Video -->
            <div class="card-body">
                <div class="video-wrapper mb-3">
                    <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen class="rounded"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
        border-radius: 20px;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 8px;
    }
</style>
