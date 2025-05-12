@extends('layouts.videos-app-layout')

@section('content')
    <h1>Edit Series</h1>
    @can('edit series')
        <form action="{{ route('series.update', $serie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $serie->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $serie->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

        <h2 class="mt-5">Series List</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($series as $index => $serieItem)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $serieItem->title }}</td>
                    <td>{{ $serieItem->description }}</td>
                    <td>{{ $serieItem->published_at ? $serieItem->published_at->format('Y-m-d') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('series.edit', $serieItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('series.delete', $serieItem->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No series found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    @else
        <p>You do not have permission to edit this series.</p>
    @endcan
@endsection
