@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $video->thumbnail_url }}" class="card-img-top" alt="{{ $video->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">{{ Str::limit($video->description, 100) }}</p>
                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-primary">Watch Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
