@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <h2 class="mb-4">Videos Created</h2>
        <div class="row">
            @forelse($user->videos as $video)
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                    <div class="card video-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <div class="video-preview">
                                <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                            <p class="card-text">{{ $video->published_at->format('j \d\e F \d\e Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>No videos created by this user.</p>
            @endforelse
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back to Users</a>
    </div>
@endsection

<style>
    .video-card {
        cursor: pointer;
        transition: transform 0.2s;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .video-card:hover {
        transform: scale(1.05);
    }

    .video-preview {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        background: #000;
        margin-bottom: 15px;
    }

    .video-preview iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .card-title {
        font-size: 0.875rem;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 0.75rem;
        color: #6c757d;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .col-6, .col-md-4, .col-lg-2 {
        flex: 0 0 auto;
        width: 15%;
    }
</style>
