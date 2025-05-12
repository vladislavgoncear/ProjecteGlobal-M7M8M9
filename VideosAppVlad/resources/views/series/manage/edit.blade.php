@extends('layouts.videos-app-layout')

@section('content')
    <h1>Edit Series</h1>
{{--    @can('edit series')--}}
    <form action="{{ route('series.update', $series->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $series->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $series->description }}</textarea>
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
        @forelse ($allSeries as $index => $serieItem)
            <tr>
                <td>{{ $index }}</td>
                <td>{{ $serieItem->title }}</td>
                <td>{{ $serieItem->description }}</td>
                <td>{{ $serieItem->published_at ? \Carbon\Carbon::parse($serieItem->published_at)->format('Y-m-d') : 'N/A' }}</td>
                <td>
                    <a href="{{ route('series.edit', $serieItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('series.destroy', $serieItem->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No series found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
{{--    @else--}}
{{--        <p>You do not have permission to edit this series.</p>--}}
{{--    @endcan--}}
@endsection
