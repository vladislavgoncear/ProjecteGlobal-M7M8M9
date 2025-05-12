@extends('layouts.videos-app-layout')

@section('content')
    <h1>Series</h1>

    @if ($series->isEmpty())
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 50vh; color: gray; font-size: 1.5rem;">
            <p>No hi ha cap serie creada per el moment.</p>
            <a href="{{ route('series.manage.create') }}" class="btn btn-primary mt-3 create-series-btn">
                <i class="fas fa-plus"></i> Crear Serie
            </a>
        </div>
    @else
        <!-- Search Form -->
        <form action="{{ route('series.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search series by title" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Series Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Published At</th>
                <th>Created By</th>
                <th>User Photo</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($series as $serie)
                <tr>
                    <td>{{ $serie->id }}</td>
                    <td>{{ $serie->title }}</td>
                    <td>{{ $serie->description }}</td>
                    <td>
                        @if ($serie->image)
                            <img src="{{ asset('storage/' . $serie->image) }}" alt="Series Image" style="width: 100px; height: auto;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $serie->user_name }}</td>
                    <td>
                        @if ($serie->user_photo_url)
                            <img src="{{ $serie->user_photo_url }}" alt="User Photo" style="width: 50px; height: 50px; border-radius: 50%;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $serie->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $serie->updated_at->format('d/m/Y H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            @if ($series instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $series->links() }}
            @endif
        </div>
    @endif
@endsection

<style>
    .create-series-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 25px; /* Bordes redondos */
        font-size: 1rem;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .create-series-btn i {
        margin-right: 8px; /* Espacio entre el icono y el texto */
    }

    .create-series-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05); /* Efecto de zoom al pasar el ratón */
    }
</style>
