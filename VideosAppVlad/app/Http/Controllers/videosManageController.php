<?php

namespace App\Http\Controllers;

use App\Models\Video;
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
        return view('videos.manage.create');
    }

    /**
     * Store a newly created video in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
        ]);

        Video::create($request->all());

        return redirect()->route('videos.manage.index')->with('success', 'Video created successfully.');
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
    public function edit(Video $video)
    {
        return view('videos.manage.edit', compact('video'));
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
