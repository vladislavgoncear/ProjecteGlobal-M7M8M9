@extends('layouts.videos-app-layout')

@section('content')
    <h1 class="text-center mb-4">Crear Usuario</h1>

    <form method="POST" action="{{ route('users.manage.store') }}" class="custom-form">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control custom-input" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control custom-input" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control custom-input" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control custom-input" required autocomplete="off">
        </div>
        <button type="submit" class="btn custom-submit-btn">Crear</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

<style>
    .custom-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 1.5rem;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-form .form-group {
        margin-bottom: 1rem;
    }

    .custom-form label {
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    .custom-input {
        width: 100%;
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .custom-input:focus {
        border-color: #007bff;
        outline: none;
    }

    .custom-submit-btn {
        display: inline-block;
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .custom-submit-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .alert {
        padding: 1rem;
        border-radius: 10px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
