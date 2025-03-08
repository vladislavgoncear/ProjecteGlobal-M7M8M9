@extends('layouts.app')

@section('content')
{{--    @can('create videos')--}}
        <h1>Create Video</h1>
        <form action="{{ route('videos.store') }}" method="POST" data-qa="form-create-video">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required data-qa="input-title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required data-qa="input-description"></textarea>
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" name="url" id="url" class="form-control" required data-qa="input-url">
            </div>
            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="date" name="published_at" id="published_at" class="form-control" required data-qa="input-published-at">
            </div>
            <button type="submit" class="btn btn-primary" data-qa="button-submit">Create</button>
        </form>
    @else
        <p>You do not have permission to create videos.</p>
{{--    @endcan--}}
@endsection
