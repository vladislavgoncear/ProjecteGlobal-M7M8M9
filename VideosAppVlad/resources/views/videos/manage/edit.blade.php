@extends('layouts.videos-app-layout')

@section('content')
    @can('edit videos', $video)
        <h1>Edit Video</h1>
        <form action="{{ route('videos.update', $video->id) }}" method="POST">
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
                <input type="date" name="published_at" id="published_at" class="form-control" value="{{ $video->published_at->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <h2>Videos</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>URL</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->description }}</td>
                    <td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
                    <td>{{ $video->published_at }}</td>
                    <td>
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>You do not have permission to edit videos.</p>
    @endcan
@endsection
