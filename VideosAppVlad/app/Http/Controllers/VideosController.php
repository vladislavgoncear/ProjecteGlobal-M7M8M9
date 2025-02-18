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

        $previousVideo = Video::where('id', '<', $video->id)->orderBy('id', 'desc')->first();
        $nextVideo = Video::where('id', '>', $video->id)->orderBy('id', 'asc')->first();

        return view('videos.show', compact('video', 'previousVideo', 'nextVideo'));
    }


//    public function testedBy($userId)
//    {
//        $videos = Video::where('tested_by', $userId)->get();
//        return view('videos.tested_by', compact('videos'));
//    }

    public function index(): View
    {
        // Add your logic to manage videos here
        return view('videos.index');
    }
}
