@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent text-center">
                <h1 class="text-dark" style="font-size: 1.8em; margin-bottom: 20px;">Añadir Videos a la Serie: {{ $series->title }}</h1>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('series.store-videos', $series) }}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach($videos as $video)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        <p class="card-text">{{ $video->description }}</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="videos[]" value="{{ $video->id }}" id="video-{{ $video->id }}">
                                            <label class="form-check-label" for="video-{{ $video->id }}">
                                                Seleccionar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Guardar Videos en la Serie</button>
                </form>
            </div>
        </div>
    </div>
@endsection
