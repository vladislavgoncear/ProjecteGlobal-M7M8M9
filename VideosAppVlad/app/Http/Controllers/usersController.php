<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class usersController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all();
        return view( 'users.index', compact('users') );
    }

    // Display the specified user
    public function show(User $user): View
    {
        $videoOfUser = Video::find($user->id);
        //$videoCount = $user->videos()->count(); // Count the number of videos created by the user
        return view('users.show', compact('user', 'videoOfUser')); // Pass the user and video count to the view
    }
}
