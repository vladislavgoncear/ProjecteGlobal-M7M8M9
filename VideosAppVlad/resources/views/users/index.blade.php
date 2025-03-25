@extends('layouts.videos-app-layout')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Users</h1>
        <div class="row">
            @foreach($users as $user)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card user-card" onclick="window.location='{{ route('users.show', $user->id) }}'">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .user-card {
        cursor: pointer;
        transition: transform 0.2s;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .user-card:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>
