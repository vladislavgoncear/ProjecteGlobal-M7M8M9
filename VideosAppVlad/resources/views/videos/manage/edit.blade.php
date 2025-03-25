@extends('layouts.videos-app-layout')

@section('content')
    @can('edit videos', $video)
        <h1>Edit Video</h1>
        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $video->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $video->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" name="url" id="url" class="form-control" value="{{ $video->url }}" required>
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="date" name="published_at" id="published_at" class="form-control" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @else
        <p>You do not have permission to edit videos.</p>
    @endcan
@endsection
