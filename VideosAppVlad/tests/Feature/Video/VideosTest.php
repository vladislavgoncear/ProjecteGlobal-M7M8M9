<?php

namespace Tests\Feature\Video;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_videos()
    {
        $video = Video::create([
            'title' => 'Sample Video',
            'description' => 'This is a sample video.',
            'url' => 'https://example.com/video.mp4',
            'published_at' => now(),
        ]);

        $response = $this->get(route('videos.show', $video->id));

        $response->assertStatus(200);
        $response->assertSee($video->title);
        $response->assertSee($video->description);
    }

    public function test_users_cannot_view_not_existing_videos()
    {
        $response = $this->get(route('videos.show', 999));

        $response->assertStatus(404);
    }
}
