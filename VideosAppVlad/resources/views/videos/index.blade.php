@extends('layouts.videos-app-layout')

@section('content')
    <div class="container">
        <h1 class="mb-4">Videos</h1>

        @if ($videos->isEmpty())
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 50vh; color: gray; font-size: 1.5rem;">
                <p>No hi ha cap video creat per el moment.</p>
                <a href="{{ route('videos.manage.create') }}" class="btn custom-create-btn mt-3">
                    <i class="fas fa-plus"></i> Crear Video
                </a>
            </div>
        @else
            <a href="{{ route('videos.manage.create') }}" class="btn custom-create-btn mb-4"><i class="fas fa-plus"></i> Crear video</a>

            <div class="videos-container">
                @foreach($videos as $video)
                    <div class="video-card">
                        <!-- Preview -->
                        <div class="video-preview">
                            <iframe src="{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                        </div>

                        <!-- Info and Buttons -->
                        <div class="video-info-with-buttons">
                            <div class="video-info">
                                <h6 class="title text-truncate" title="{{ $video->title }}">{{ $video->title }}</h6>
                                <p class="creator text-muted text-truncate" title="{{ $video->description }}">{{ $video->description }}</p>
                                <p class="date text-muted">{{ $video->created_at->format('Y-m-d') }}</p>
                                <p class="series text-muted">
                                    Serie: {{ $video->series ? $video->series->title : 'N/A' }}
                                </p>
                            </div>
                            <div class="video-action-buttons">
                                <a href="{{ route('videos.manage.edit', $video) }}" class="btn video-btn-edit" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('videos.manage.destroy', $video) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn video-btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    .container {
        padding: 2rem;
    }

    .custom-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        border: none;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        font-size: 1rem;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
    }

    .custom-create-btn i {
        margin-right: 8px;
    }

    .custom-create-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .videos-container {
        display: flex;
        flex-wrap: nowrap;
        gap: 1rem;
        overflow-x: auto;
        padding-bottom: 1rem;
        margin-top: 1rem;
    }

    .video-card {
        flex: 0 0 300px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .video-preview {
        width: 100%;
        position: relative;
        padding-bottom: 56.25%;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        overflow: hidden;
    }

    .video-preview iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .video-info-with-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
    }

    .video-info .title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .video-info .creator,
    .video-info .date {
        font-size: 0.875rem;
        margin-bottom: 0;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .video-action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .video-btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background-color: #ffc107; /* Yellow for edit */
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
    }

    .video-btn-edit:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }

    .video-btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background-color: #dc3545; /* Red for delete */
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
    }

    .video-btn-delete:hover {
        background-color: #c82333;
        transform: scale(1.1);
    }

    .videos-container::-webkit-scrollbar {
        height: 8px;
    }

    .videos-container::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 4px;
    }

    .videos-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
</style>
