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
        <form action="{{ route('series.index') }}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Buscar series per titol" value="{{ request('search') }}">
            <button type="submit" class="search-button">Buscar</button>
        </form>

        <!-- Series Table -->
        <table class="table table-bordered custom-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titol</th>
                <th>Descripcio</th>
                <th>Image</th>
                <th>Data publicacio</th>
                <th>Creador</th>
                <th>Perfil</th>
                <th>Data cracio</th>
                <th>Data actualitzacio</th>
                <th>Accions</th>
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
                    <td>
                        <a href="{{ route('series.manage.edit', $serie->id) }}" class="btn action-btn edit-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('series.manage.destroy', $serie->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn action-btn delete-btn" title="Delete" onclick="return confirm('Estas segur que vols eliminar aquesta serie?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Cards for Mobile -->
        <div class="cards-container">
            @foreach($series as $serie)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $serie->title }}</h5>
                        <p class="card-text">{{ $serie->description }}</p>
                        <p class="card-text"><strong>Publicat:</strong> {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'N/A' }}</p>
                        <p class="card-text"><strong>Creador:</strong> {{ $serie->user_name }}</p>
                        <div class="card-actions">
                            <a href="{{ route('series.manage.edit', $serie->id) }}" class="btn action-btn edit-btn" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('series.manage.destroy', $serie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn action-btn delete-btn" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            @if ($series instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $series->links() }}
            @endif
        </div>
    @endif
@endsection

<style>
    /* Search Form */
    .search-form {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .search-input {
        flex: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        border-color: #007bff;
        outline: none;
    }

    .search-button {
        padding: 0.5rem 1rem;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .search-button:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    /* Table */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
    }

    .custom-table th, .custom-table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .custom-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .custom-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .custom-table tr:hover {
        background-color: #f1f1f1;
    }

    /* Cards */
    .cards-container {
        display: none;
        gap: 1rem;
    }

    .card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .card-text {
        margin-bottom: 0.5rem;
        color: #555;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        font-size: 1rem;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .edit-btn {
        background-color: #ffc107;
    }

    .edit-btn:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }

    .delete-btn {
        background-color: #dc3545;
    }

    .delete-btn:hover {
        background-color: #c82333;
        transform: scale(1.1);
    }

    /* Responsive: Show cards on mobile */
    @media (max-width: 768px) {
        .custom-table {
            display: none;
        }

        .cards-container {
            display: flex;
            flex-direction: column;
        }
    }
</style>
