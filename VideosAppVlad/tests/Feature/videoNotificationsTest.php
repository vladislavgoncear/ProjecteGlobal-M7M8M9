<?php

namespace Tests\Feature;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class videoNotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_created_event_is_dispatched()
    {
        // Fake the event
        Event::fake();

        // Create a video
        $videoData = [
            'title' => 'Test Video',
            'description' => 'Test Description',
        ];
        $this->post(route('videos.manage.store'), $videoData);

        // Assert the VideoCreated event was dispatched
        Event::assertDispatched(VideoCreated::class, function ($event) use ($videoData) {
            return $event->video->title === $videoData['title'];
        });
    }

    public function test_push_notification_is_sent_when_video_is_created()
    {
        // Fake notifications
        Notification::fake();

        // Create a user to receive the notification
        $user = User::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Create a video
        $videoData = [
            'title' => 'Test Video',
            'description' => 'Test Description',
        ];
        $this->post(route('videos.manage.store'), $videoData);

        // Assert a notification was sent
        Notification::assertSentTo(
            [$user],
            VideoCreatedNotification::class,
            function ($notification, $channels) use ($videoData) {
                return $notification->video->title === $videoData['title'];
            }
        );
    }
}
