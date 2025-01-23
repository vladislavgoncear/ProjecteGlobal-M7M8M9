@extends('layouts.videos-app-layout')

@section('content')
    <h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
    <video controls>
        <source src="{{ $video->url }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@endsection
