@extends('layouts.videos-app-layout')

@section('content')
    <h1>Videos</h1>
    <a href="{{ route('videos.manage.create') }}" class="btn custom-create-btn mb-3">
        <i class="fas fa-plus"></i> Crear Nuevo Video
    </a>

    <!-- Tabla para pantallas grandes -->
    <table class="table custom-table">
        <thead>
        <tr>
            <th>Titol</th>
            <th>Descripcio</th>
            <th>URL</th>
            <th>Data de publicacio</th>
            <th>Accions</th>
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
                    <a href="{{ route('videos.show', $video->id) }}" class="btn action-btn view-btn" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn action-btn edit-btn" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn action-btn delete-btn" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Cards para pantallas pequeñas -->
    <div class="cards-container">
        @foreach($videos as $video)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                    <p class="card-text">{{ $video->description }}</p>
                    <p class="card-text"><strong>URL:</strong> <a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></p>
                    <p class="card-text"><strong>Data de publicacio:</strong> {{ $video->published_at }}</p>
                    <div class="card-actions">
                        <a href="{{ route('videos.show', $video->id) }}" class="btn action-btn view-btn" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn action-btn edit-btn" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" style="display:inline;">
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
@endsection

<style>
    /* Tabla */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
    }
    .custom-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #1982e8;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        font-size: 1rem;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-bottom: 1rem;
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

    /* Botones de acción */
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

    .view-btn {
        background-color: #17a2b8;
    }

    .view-btn:hover {
        background-color: #138496;
        transform: scale(1.1);
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

    /* Responsive: Mostrar cards en móviles */
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
