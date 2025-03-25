@extends('layouts.videos-app-layout')

@section('content')
{{--    @can('view videos')--}}
        <h1>Videos</h1>
        <a href="{{ route('videos.manage.create') }}" class="btn btn-primary mb-3">Create New Video</a>
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
                        <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{--    @else--}}
        <p>You do not have permission to view videos.</p>
{{--    @endcan--}}
@endsection
