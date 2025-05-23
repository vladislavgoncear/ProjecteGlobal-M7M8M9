@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <div class="card create-card shadow-sm border-0">
            <div class="card-header bg-transparent text-center">
                <h1 class="text-dark" style="font-size: 1.8em; margin-bottom: 20px;">Crear video</h1>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('videos.manage.store') }}" method="POST" style="max-width: 600px; margin: 0 auto;" data-qa="form-create-video">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label for="title" style="display: block; font-weight: bold; margin-bottom: 5px;">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required
                               style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="description" style="display: block; font-weight: bold; margin-bottom: 5px;">Description</label>
                        <textarea name="description" id="description" rows="4" required
                                  style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;"></textarea>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="url" style="display: block; font-weight: bold; margin-bottom: 5px;">Video URL</label>
                        <input type="url" name="url" id="url" class="form-control" required
                               style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="published_at" style="display: block; font-weight: bold; margin-bottom: 5px;">Published At</label>
                        <input type="date" name="published_at" id="published_at" class="form-control" required
                               style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="series" style="display: block; font-weight: bold; margin-bottom: 5px;">Series</label>
                        <select name="series_id" id="series" class="form-control" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc; background-color: #f5f5f5;">
                            <option value="">Select Series</option>
                            @foreach($series as $serie)
                                <option value="{{ $serie->id }}" {{ old('series_id') == $serie->id ? 'selected' : '' }}>
                                    {{ $serie->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 20px;">
                        Crear video
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
