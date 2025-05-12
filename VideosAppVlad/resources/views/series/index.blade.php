@extends('layouts.videos-app-layout')

@section('content')
    <h1>All Series</h1>
{{--    //@can('view series')--}}
        <!-- Search Form -->
        <form action="{{ route('series.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search series by title" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Series Table -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Published At</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($series as $index => $serie)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <a href="{{ route('series.show', $serie->id) }}" class="text-decoration-none">
                            {{ $serie->title }}
                        </a>
                    </td>
                    <td>{{ $serie->description }}</td>
                    <td>{{ $serie->published_at ? $serie->published_at->format('Y-m-d') : 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No series found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $series->links() }}
        </div>
{{--    @else--}}
{{--        <p>You do not have permission to view this page.</p>--}}
{{--    @endcan--}}
@endsection
