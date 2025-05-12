@extends('layouts.videos-app-layout')

@section('content')
    @can('edit videos', $video)
        <h1 style="font-size: 1.8em; margin-bottom: 20px;">Editar video</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST" style="max-width: 600px;">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Title</label>
                <input type="text" name="title" id="title" value="{{ $video->title }}" required
                       style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="description" style="display: block; font-weight: bold; margin-bottom: 5px;">Description</label>
                <textarea name="description" id="description" rows="4" required
                          style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">{{ $video->description }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="url" style="display: block; font-weight: bold; margin-bottom: 5px;">Video URL</label>
                <input type="url" name="url" id="url" value="{{ $video->url }}" required
                       style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="published_at" style="display: block; font-weight: bold; margin-bottom: 5px;">Published At</label>
                <input type="date" name="published_at" id="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required
                       style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="series_id" style="display: block; font-weight: bold; margin-bottom: 5px;">Series</label>
                <input type="text" name="series_title" id="series_title" value="{{ $video->series->title }}" readonly
                       style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
            </div>

            <button type="submit"
                    style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                Actualizar Video
            </button>
        </form>
    @else
        <p style="color: red; font-weight: bold;">You do not have permission to edit videos.</p>
    @endcan
@endsection
