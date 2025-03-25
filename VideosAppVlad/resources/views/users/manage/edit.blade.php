@extends('layouts.videos-app-layout')

@section('content')
    @can('edit users', $user)
        <h1>Edit User</h1>
        <form action="{{ route('users.manage.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button type="submit">Update</button>
        </form>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
