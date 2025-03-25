@extends('layouts.videos-app-layout')

@section('content')
    @can('delete', $user)
        <h1>Delete User</h1>
        <p>Are you sure you want to delete {{ $user->name }}?</p>
        <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
