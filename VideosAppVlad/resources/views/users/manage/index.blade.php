@extends('layouts.videos-app-layout')
@section('content')
    <h1>Users List</h1>
    <form method="GET" action="{{ route('users.manage.index') }}">
        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('users.manage.create') }}" class="btn btn-primary">Create User</a>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('users.manage.edit', ['user' => $user->id]) }}">Edit</a>
                    <form action="{{ route('users.manage.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
