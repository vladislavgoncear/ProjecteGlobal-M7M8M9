@extends('layouts.videos-app-layout')

@section('content')
    <h1 class="text-center mb-4">Llista de usuaris</h1>

    <form method="GET" action="{{ route('users.manage.index') }}" class="search-form">
        <input type="text" name="search" placeholder="Buscar usuari..." value="{{ request('search') }}" class="search-input">
        <button type="submit" class="btn btn-primary search-button">Buscar</button>
    </form>

    <a href="{{ route('users.manage.create') }}" class="btn custom-create-btn mb-4">➕ Crear usuario</a>

    <div class="user-cards-container">
        @foreach($users as $user)
            <div class="user-card">
                <div class="user-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h5 class="user-name">{{ $user->name }}</h5>
                <p class="user-email">{{ $user->email }}</p>

                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('users.manage.edit', ['user' => $user->id]) }}">Edit</a></li>
                        <li>
                            <form action="{{ route('users.manage.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection

<style>
    .search-form {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 300px;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }

    .search-button {
        padding: 8px 15px;
        border-radius: 8px;
    }

    .custom-create-btn {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        color: #333;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.2s ease-in-out;
        text-decoration: none;
    }

    .custom-create-btn:hover {
        background-color: #e0e0e0;
        color: #000;
    }

    .create-button {
        display: inline-block;
        margin-bottom: 1.5rem;
        border-radius: 8px;
    }

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
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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

    .dropdown {
        margin-top: 10px;
    }

    .dropdown-menu {
        border-radius: 8px;
    }
</style>
