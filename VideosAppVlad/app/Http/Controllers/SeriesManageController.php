<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Video;
use Illuminate\Http\Request;

class SeriesManageController extends Controller
{
    /**
     * Display a listing of the series.
     */
    public function index()
    {
        $series = Series::all();
        return view('series.manage.index', compact('series'));
    }

    /**
     * Show the form for creating a new series.
     */
    public function create()
    {
        $videos = Video::all(); // Obtener todos los videos
        return view('series.manage.create', compact('videos')); // Pasar los videos a la vista
    }

    /**
     * Store a newly created series in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);

        $series = Series::create($validated);

        if ($request->has('videos')) {
            $series->videos()->sync($request->videos); // Associate selected videos with the series
        }

        return redirect()->route('series.manage.index')->with('success', 'Series created successfully.');
    }

    /**
     * Show the form for editing the specified series.
     */
    public function edit($id)
    {
        $series = \App\Models\Series::findOrFail($id); // Fetch the series by ID
        $allSeries = \App\Models\Series::all(); // Fetch all series for the list
        return view('series.manage.edit', compact('series', 'allSeries'));
    }

    /**
     * Update the specified series in storage.
     */
    public function update(Request $request, Series $series)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);

        $series->update($validated);

        return redirect()->route('series.manage.index')->with('success', 'Series updated successfully.');
    }

    /**
     * Remove the specified series from storage.
     */
    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('series.manage.index')->with('success', 'Series deleted successfully.');
    }

    /**
     * Show the form for adding videos to a series.
     */
    public function addVideos(Series $series)
    {
        $videos = Video::all();
        return view('series.manage.add-videos', compact('series', 'videos'));
    }
}
