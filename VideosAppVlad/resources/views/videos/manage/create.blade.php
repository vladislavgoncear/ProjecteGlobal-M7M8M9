@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <div class="card create-card">
            <div class="card-header bg-primary text-white">
                <h1>Create Video</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('videos.manage.store') }}" method="POST" data-qa="form-create-video">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control rounded-input" required data-qa="input-title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control rounded-input" required data-qa="input-description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" name="url" id="url" class="form-control rounded-input" required data-qa="input-url">
                    </div>
                    <div class="form-group">
                        <label for="published_at">Published At</label>
                        <input type="date" name="published_at" id="published_at" class="form-control rounded-input" required data-qa="input-published-at">
                    </div>
                    <button type="submit" class="btn btn-primary" data-qa="button-submit">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
