@extends('layouts.app')

@section('content')
    @can('delete videos')
        <h1>Delete Video</h1>
        <p>Are you sure you want to delete the video titled "{{ $video->title }}"?</p>
        <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    @else
        <p>You do not have permission to delete videos.</p>
    @endcan
@endsection
