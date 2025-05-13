<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Series;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class videosManageController extends Controller
{
    /**
     * Display a listing of the videos.
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.manage.index', compact('videos'));
    }

    /**
     * Show the form for creating a new video.
     */
    public function create()
    {
        $series = Series::all();
        return view('videos.manage.create', compact('series'));
    }

    /**
     * Store a newly created video in storage.
     */
    // VideoController.php

    // VideoController.php

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
            'series_id' => 'nullable|exists:series,id',
        ]);

        $validate['user_id'] = auth()->id();

         $video = Video::create($validate);

        // Disparar l'event VideoCreated
        event(new VideoCreated($video));

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified video.
     */
    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified video.
     */
    public function edit($id)
    {
        $video = \App\Models\Video::findOrFail($id);
        $series = \App\Models\Series::all(); // Obtiene todas las series
        return view('videos.manage.edit', compact('video', 'series'));
    }

    /**
     * Update the specified video in storage.
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
        ]);

        $video->update($request->all());

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified video from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }

    /**
     * Test function for the controller.
     */
    public function testedby()
    {
        return response()->json(['message' => 'This is a test function.']);
    }
}
