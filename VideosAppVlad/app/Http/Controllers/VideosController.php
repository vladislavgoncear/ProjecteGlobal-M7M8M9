<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class VideosController extends Controller
{

    public function create()
    {
        return view('videos.create');
    }

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

        $video = Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'published_at' => $request->input('published_at'),
            'user_id' => auth()->id(),
        ]);

        // Disparar l'event VideoCreated
//        event(new VideoCreated($video));


    session()->flash('message', "S’ha creat el vídeo “{$video->title}”!");
        session()->flash('type', 'success');

        return redirect()->route('videos.index');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'published_at' => 'required|date',
        ]);

        $video->update($request->all());

        session()->flash('message', "S’ha editat el vídeo “{$video->title}”!");
        session()->flash('type', 'success');

        return redirect()->route('videos.index');
    }

    public function edit(Video $video)
    {
        return view('videos.manage.edit', compact('video'));
    }

    public function destroy(Video $video): RedirectResponse
    {
        $videoTitle = $video->title;
        $video->delete();

        session()->flash('message', "S’ha eliminat el vídeo “{$videoTitle}”!");
        session()->flash('type', 'success');

        return redirect()->route('videos.index');
    }
}
