@extends('layouts.videos-app-layout')

@section('content')
    <h1>Delete Series</h1>
    @can('delete series')
        <p>Are you sure you want to delete the series "{{ $serie->title }}"?</p>
        <form action="{{ route('series.destroy', $serie->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-check">
                <input type="checkbox" name="delete_videos" id="delete_videos" class="form-check-input" value="1">
                <label for="delete_videos" class="form-check-label">
                    Also delete all videos associated with this series
                </label>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
            <a href="{{ route('series.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    @else
        <p>You do not have permission to delete this series.</p>
    @endcan
@endsection
