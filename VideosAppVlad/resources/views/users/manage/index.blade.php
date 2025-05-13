@extends('layouts.videos-app-layout')

@section('content')
    <h1 class="text-center mb-4">Llista de usuaris</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('users.manage.index') }}" class="search-form">
        <input type="text" name="search" placeholder="Buscar usuari..." value="{{ request('search') }}" class="search-input">
        <button type="submit" class="search-button">Buscar</button>
    </form>

    <!-- Create User Button -->
    <a href="{{ route('users.manage.create') }}" class="btn custom-create-btn mb-4">
        <i class="fas fa-user-plus"></i> Crear usuario
    </a>

    <!-- User Cards -->
    <div class="user-cards-container">
        @foreach($users as $user)
            <div class="user-card">
                <div class="user-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h5 class="user-name">{{ $user->name }}</h5>
                <p class="user-email">{{ $user->email }}</p>

                <div class="card-actions">
                    <a href="{{ route('users.manage.edit', ['user' => $user->id]) }}" class="btn action-btn edit-btn" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('users.manage.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn action-btn delete-btn" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<style>
    /* Search Form */
    .search-form {
        text-align: center;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .search-input {
        width: 300px;
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

    /* Create User Button */
    .custom-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #007bff;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        font-size: 1rem;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .custom-create-btn i {
        margin-right: 8px;
    }

    .custom-create-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    /* User Cards */
    .user-cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 1.5rem;
    }

    .user-card {
        flex: 1 1 calc(33.333% - 20px);
        max-width: calc(33.333% - 20px);
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .user-card {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }

    .user-icon i {
        font-size: 50px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .user-name {
        font-size: 1.1em;
        font-weight: bold;
    }

    .user-email {
        font-size: 0.9em;
        color: #555;
    }

    /* Action Buttons */
    .card-actions {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 10px;
    }

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
</style>
