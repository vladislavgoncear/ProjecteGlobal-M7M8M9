<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Support\Facades\Mail;

class SendVideoCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\VideoCreated  $event
     * @return void
     */
    public function handle(VideoCreated $event)
    {
        // Get the video from the event
        $video = $event->video;

        // Retrieve all admin users
//        $admins = User::where('role', 'admin')->get();

        // Send email to each admin
        Mail::to("jordivega@iesebre.com")->send(new VideoCreated($video));
//        foreach ($admins as $admin) {
//            Mail::to($admin->email)->send(new VideoCreated($video));
//        }

        // Send notification to admins
//        foreach ($admins as $admin) {
//            $admin->notify(new VideoCreatedNotification($video));
        }

        // Broadcast the event via Pusher
//        broadcast(new VideoCreated($video));
    //}
}
