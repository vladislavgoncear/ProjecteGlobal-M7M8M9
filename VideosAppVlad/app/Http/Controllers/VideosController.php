<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\View\View;


class VideosController extends Controller
{

    // VideoController.php

    public function show($id)
    {
        $video = Video::findOrFail($id);
        $otherVideos = Video::where('id', '!=', $id)->get();

        return view('videos.show', compact('video', 'otherVideos'));
    }


//    public function testedBy($userId)
//    {
//        $videos = Video::where('tested_by', $userId)->get();
//        return view('videos.tested_by', compact('videos'));
//    }

    public function index(): View
    {
        $videos = Video::all(); // Retrieve all videos from the database
        return view('videos.index', compact('videos')); // Pass the videos to the view
    }

    // VideoController.php

    // En `app/Http/Controllers/VideoController.php`
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
        ]);

        Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'published_at' => $request->input('published_at'),
            'user_id' => auth()->id(), // Asigna el ID del usuario autenticado
        ]);

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
        ]);

        $video->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'published_at' => $request->input('published_at'),
        ]);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function edit(Video $video)
    {
        return view('videos.manage.edit', compact('video'));
    }
}
